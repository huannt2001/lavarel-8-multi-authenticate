<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;
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

    public function ProductSubCate($subId) {
        $subcate = SubCategory::where('id', $subId)->first();
        $products = Product::where('subcategory_id', $subId)->paginate(5);
        $categories = Category::all();
        $brandIds = Product::where('subcategory_id', $subId)->select('brand_id')->groupBy('brand_id')->get(); //group by gộp các phần tử trùng nhau lại
        // return response()->json($brands);
        return view('frontend.product.all_sub_product', compact('products', 'categories', 'brandIds', 'subcate'));
    }

    public function ProductCate($cateId) {
        $category = Category::where('id', $cateId)->first();
        $categories = Category::all();
        $brandIds = Product::where('subcategory_id', $cateId)->select('brand_id')->groupBy('brand_id')->get(); //group by gộp các phần tử trùng nhau lại
        $category_all = Product::where('category_id', $cateId)->paginate(5);
        return view('frontend.product.all_cate_product', compact('category_all', 'categories', 'brandIds', 'category'));
    } 
}
