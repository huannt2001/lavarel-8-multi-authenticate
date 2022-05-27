<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Admin\Coupon;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;
use Cart;

class CartController extends Controller
{
    public function AddToCart($id) {
        $product = Product::where('id', $id)->first();

        if (!$product->discount_price) {
            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name,
                'qty' => 1,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->image_one,
                    'color' => '',
                    'size' => '',
                ]
            ]);

            return response()->json([
                'success' => 'Product Added on Your Cart'
            ]);

        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name,
                'qty' => 1,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->image_one,
                    'color' => '',
                    'size' => '',
                ]
            ]);

            return response()->json([
                'success' => 'Product Added on Your Cart'
           ]);
        }
    }

    public function Check() {
        $content = Cart::content();

        return response()->json($content);
    }

    public function ShowCart() {
        $carts = Cart::content();
        return view('frontend.product.cart', compact('carts'));
    }

    public function RemoveCart($rowId) {
        Cart::remove($rowId);
        $notification = array(
            'message' => 'Product Remove from Cart Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function UpdateCart(Request $request, $rowId) {
        $qty = $request->qty;
        Cart::update($rowId, $qty);

        $notification = array(
            'message' => 'Product Quantity Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function Viewproduct($id) {
        $product = Product::where('id', $id)->first();

        $category_name = $product->category->category_name;
        $subcategory_name = $product->subcategory->subcategory_name;
        $brand_name = $product->brand->brand_name;


        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);
        
        return response()->json([
            'product' => $product,
            'size' => $product_size,
            'color' => $product_color,
            'category_name' => $category_name,
            'subcategory_name' => $subcategory_name,
            'brand_name' => $brand_name,
        ]);
    }

    public function InsertCart(Request $request) {
        $id = $request->product_id;
        $product = Product::where('id', $id)->first();

        if (!$product->discount_price) {
            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name,
                'qty' => $request->qty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->image_one,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);

            $notification = array(
                'message' => 'Product Added Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name,
                'qty' => $request->qty,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->image_one,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);

            $notification = array(
                'message' => 'Product Added Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function Checkout() {
        if (Auth::check()) {
            $setting = Setting::first();
            $carts = Cart::content();
            return view('frontend.checkout.checkout', compact('carts', 'setting'));
        } else {
            $notification = array(
                'message' => 'At First Login Your Account',
                'alert-type' => 'error',
            );
            return redirect()->route('login')->with($notification);
        }
    }

    public function CouponApply(Request $request) {
        $coupon = Coupon::where('coupon', $request->coupon)->first();
        
        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon,
                'discount' => $coupon->discount,
                'discount_amount' => round(Cart::subtotal() * $coupon->discount / 100),
                'total_amount' => round(Cart::subtotal() - Cart::subtotal() * $coupon->discount / 100)
            ]);
            $notification = array(
                'message' => 'Successfully coupon applied',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Invalid Coupon',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function CouponRemove() {
        Session::forget('coupon');
        $notification = array(
            'message' => 'Coupon Removed Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function PaymentPage() {
        $setting = Setting::first();
        $carts = Cart::content();
        return view('frontend.payment.payment', compact('carts', 'setting'));
    }
    
}
