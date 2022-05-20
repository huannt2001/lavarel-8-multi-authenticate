<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;
use App\Models\Product;
use DB;
use Image;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function AllProduct() {
        $products = Product::latest()->get();
        return view('admin.product.product_view', compact('products'));
    }

    public function AddProduct() {
        $categories = Category::latest()->get();
		$brands = Brand::latest()->get();
        return view('admin.product.create_product', compact('categories', 'brands'));
    }

    public function GetSubCategory($category_id) {
        $categories = SubCategory::where('category_id', $category_id)->get();
        return json_encode($categories);
    }

    public function StoreProduct(Request $request) {

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;
        if ($image_one && $image_two && $image_three) {
            $image_one_name = hexdec(uniqid()).'.'. $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300, 300)->save('media/product/'. $image_one_name);
            $image_one_url = 'media/product/'. $image_one_name;

            $image_two_name = hexdec(uniqid()).'.'. $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300, 300)->save('media/product/'. $image_two_name);
            $image_two_url = 'media/product/'. $image_two_name;

            $image_three_name = hexdec(uniqid()).'.'. $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300, 300)->save('media/product/'. $image_three_name);
            $image_three_url = 'media/product/'. $image_three_name;
        }


        Product::insert([
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'product_details' => $request->product_details,
            'video_link' => $request->video_link,
            'main_slider' => $request->main_slider,
            'hot_deal' => $request->hot_deal,
            'best_rated' => $request->best_rated,
            'mid_slider' => $request->mid_slider,
            'hot_new' => $request->hot_new,
            'trend' => $request->trend,
            'status' => 1,
            'image_one' => $image_one_url,
            'image_two' => $image_two_url,
            'image_three' => $image_three_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
			'message' => 'Product Inserted Successfully',
			'alert-type' => 'success'
		);

        return redirect()->back()->with($notification);
    }

    public function InactiveProduct($id) {
        Product::findorFail($id)->update([
            'status' => 0,
        ]);

        $notification = array(
			'message' => 'Product Successfully Inactive',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification);
    }

    public function ActiveProduct($id) {
        Product::findorFail($id)->update([
            'status' => 1                                                                                                                                                                                                                                                                                               ,
        ]);

        $notification = array(
			'message' => 'Product Successfully Active',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id) {
        $product = Product::findorFail($id);

        $image_one = $product->image_one;
        $image_two = $product->image_two;
        $image_three = $product->image_three;

        unlink($image_one);
        unlink($image_two);
        unlink($image_three);

        Product::findorFail($id)->delete();

        $notification = array(
			'message' => 'Product Delelted Successfully',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification);
    }

    public function ViewProduct($id) {
       
        $product = Product::findOrFail($id);
        return view('admin.product.detail_product', compact('product'));
    }

    public function EditProduct($id) {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
		$brands = Brand::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.product.edit_product', compact('product', 'categories', 'subcategories', 'brands'));
    }

    public function UpdateProductWithoutPhoto(Request $request, $id) {
        if(isset($id)) {
            $update = DB::table('products')->where('id', $id)->update([
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_quantity' => $request->product_quantity,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'brand_id' => $request->brand_id,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'product_details' => $request->product_details,
                'video_link' => $request->video_link,
                'main_slider' => $request->main_slider,
                'hot_deal' => $request->hot_deal,
                'best_rated' => $request->best_rated,
                'mid_slider' => $request->mid_slider,
                'hot_new' => $request->hot_new,
                'trend' => $request->trend,
                'status' => 1,
            ]);
            if ($update) {
                $notification = array(
                    'message' => 'Product Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('all.product')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Nothing To Update',
                    'alert-type' => 'error'
                );
                return redirect()->route('all.product')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Missing Required Parameter',
                'alert-type' => 'error'
            );
            return redirect()->route('all.product')->with($notification);
        }
    }

    public function UpdateProductPhoto(Request $request, $id) {
        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;
        
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if ($image_one) {
            unlink($old_one);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_one->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image_one->move($upload_path, $image_full_name);

            Product::findOrFail($id)->update([
                'image_one' => $image_url,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Image One Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.product')->with($notification);
        };

        if ($image_two) {
            unlink($old_two);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_two->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image_two->move($upload_path, $image_full_name);

            Product::findOrFail($id)->update([
                'image_two' => $image_url,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Image Two Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.product')->with($notification);
        };

        if ($image_three) {
            unlink($old_three);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image_three->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image_three->move($upload_path, $image_full_name);

            Product::findOrFail($id)->update([
                'image_three' => $image_url,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Image Three Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.product')->with($notification);
        } 
    }
 
}
