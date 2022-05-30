<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use DB;

class SubCategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function SubCategoryView() {
        $categories = Category::orderBy('category_name','ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.subcategory.subcategory_view', compact('subcategories', 'categories'));
    }

    public function StoreSubCategory(Request $request) {
        $validatedData = $request->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
			'message' => 'Sub Category Inserted Successfully',
			'alert-type' => 'success'
		);

        return redirect()->back()->with($notification);

    }

    public function SubCategoryDelete($id) {
        if (isset($id)) {
            SubCategory::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Sub Category Deleted Successfully',
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

    public function SubCategoryEdit($id) {
        if (isset($id)) {
            $categories = Category::orderBy('category_name','ASC')->get();
            $subcategory = SubCategory::findOrFail($id);
            return view('admin.subcategory.subcategory_edit',  compact('subcategory', 'categories'));
        } else {
            $notification = array(
                'message' => 'Missing Required Parameter',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function SubCategoryUpdate(Request $request, $id) {
        // $category = Category::findOrFail($id);
        // $update = $category->update([
        //     'category_name' => $request->category_name,
        //     'updated_at' => Carbon::now()
        // ]);

        // Dùng cách thứ 2 để có thể biết được nếu người dùng không nhập gì khi update
        $subcategory = [];
        $subcategory['category_id'] = $request->category_id;
        $subcategory['subcategory_name'] = $request->subcategory_name;
        $update = DB::table('sub_categories')->where('id', $id)->update($subcategory);

        if ($update) {
            $notification = array(
                'message' => 'Sub Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('sub.category')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('sub.category')->with($notification);
        }
    }
}

