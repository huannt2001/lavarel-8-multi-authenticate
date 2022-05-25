<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Product;
use DB;
use Cart;

class FrontProductController extends Controller
{
    public function ProductView($id, $product_name) {
        $product = Product::where('id', $id)->first();

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);
        return view('frontend.product.product_details', compact('product', 'product_color', 'product_size'));
    }

    public function AddToCart(Request $request, $id) {
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
}
