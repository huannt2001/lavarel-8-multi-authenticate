<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;

class BrandController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function BrandView() {
        $brands = Brand::all();
        return view('admin.brand.brand_view', compact('brands'));
    }

    public function StoreBrand(Request $request) {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);

        $image = $request->file('brand_logo');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            Brand::insert([
                'brand_name' => $request->brand_name,
                'brand_logo' => $image_url,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Brand Inserted Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } else {
            Brand::insert([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Its Done',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function BrandDelete($id) {
        if (isset($id)) {
            $brand = Brand::findOrFail($id);
            $image = $brand->brand_logo;
            unlink($image);

            Brand::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Brand Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        } else {
            $notification = array(
                'message' => 'Missing Required Parameter',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function BrandEdit($id) {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request, $id) {
        $old_logo = $request->old_logo;
        
        $image = $request->file('brand_logo');
        if ($image) {
            unlink($old_logo);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            Brand::findOrFail($id)->update([
                'brand_name' => $request->brand_name,
                'brand_logo' => $image_url,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.brand')->with($notification);
        } else {
            Brand::findOrFail($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Update Without Image',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }
    }
}
