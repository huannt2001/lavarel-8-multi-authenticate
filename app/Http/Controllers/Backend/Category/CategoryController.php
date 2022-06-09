<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function CategoryView()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }

    public function StoreCategory(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CategoryDelete($id)
    {
        if (isset($id)) {
            Category::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Category Deleted Successfully',
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

    public function CategoryEdit($id)
    {
        if (isset($id)) {
            $category = Category::findOrFail($id);
            return view('admin.category.edit', compact('category'));
        } else {
            $notification = array(
                'message' => 'Missing Required Parameter',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function CategoryUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name' => 'required|max:255',
        ]);
        // $category = Category::findOrFail($id);
        // $update = $category->update([
        //     'category_name' => $request->category_name,
        //     'updated_at' => Carbon::now()
        // ]);

        // Dùng cách thứ 2 để có thể biết được nếu người dùng không nhập gì khi update
        $category = [];
        $category['category_name'] = $request->category_name;
        $update = DB::table('categories')->where('id', $id)->update($category);

        if ($update) {
            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('categories')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('categories')->with($notification);
        }
    }
}
