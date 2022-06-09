<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PostCategory;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function BlogCatList()
    {
        $blogcats = PostCategory::all();
        return view('admin.blog.category.blog_category_view', compact('blogcats'));
    }

    public function StoreBlogCat(Request $request)
    {
        $validateData = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_vn' => 'required|max:255',
        ]);

        PostCategory::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_vn' => $request->category_name_vn,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteBlogCat($id)
    {
        if (isset($id)) {
            PostCategory::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Blog Category Deleted Successfully',
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

    public function EditBlogCat($id)
    {
        if (isset($id)) {
            $blogcate = PostCategory::findOrFail($id);
            return view('admin.blog.category.edit_blog_category', compact('blogcate'));
        } else {
            $notification = array(
                'message' => 'Missing Required Parameter',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function UpdateBlogCat(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_vn' => 'required|max:255',
        ]);

        $update = DB::table('post_categories')->where('id', $id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_vn' => $request->category_name_vn,
            'updated_at' => Carbon::now()
        ]);

        if ($update) {
            $notification = array(
                'message' => 'Blog Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('add.blog.categorylist')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('add.blog.categorylist')->with($notification);
        }
    }

    public function CreateBlogPost()
    {
        $blogcates = PostCategory::latest()->get();
        return view('admin.blog.post.create_blog_post', compact('blogcates'));
    }

    public function StoreBlogPost(Request $request)
    {


        $post_image = $request->file('post_image');
        if ($post_image) {
            $post_image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400, 200)->save('media/post/' . $post_image_name);
            $post_image_url = 'media/post/' . $post_image_name;

            Post::insert([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_vn' => $request->post_title_vn,
                'details_en' => $request->details_en,
                'details_vn' => $request->details_vn,
                'post_image' => $post_image_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Blog Post Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {

            Post::insert([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_vn' => $request->post_title_vn,
                'details_en' => $request->details_en,
                'details_vn' => $request->details_vn,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Blog Post Inserted Without Image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function AllBlogPost()
    {
        $posts = Post::latest()->get();
        return view('admin.blog.post.blog_post_view', compact('posts'));
    }

    public function DeleteBlogPost($id)
    {
        if (isset($id)) {
            $post = Post::findOrFail($id);
            $post_image = $post->post_image;
            unlink($post_image);

            Post::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Blog Post Deleted Successfully',
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

    public function EditBlogPost($id)
    {
        $blogcates = PostCategory::latest()->get();
        $post = Post::findOrFail($id);
        return view('admin.blog.post.edit_blog_post', compact('post', 'blogcates'));
    }

    public function UpdateBlogPost(Request $request, $id)
    {
        $old_image = $request->old_image;
        $post_image = $request->file('post_image');

        $data = [];
        $data['category_id'] = $request->category_id;
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_vn'] = $request->post_title_vn;
        $data['details_en'] = $request->details_en;
        $data['details_vn'] = $request->details_vn;
        $data['updated_at'] = Carbon::now();

        if ($post_image) {
            if ($old_image) {
                unlink($old_image);
            }
            $post_image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400, 200)->save('media/post/' . $post_image_name);
            $data['post_image'] = 'media/post/' . $post_image_name;

            DB::table('posts')->where('id', $id)->update($data);

            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blogpost')->with($notification);
        } else {
            $data['post_image'] = $old_image;
            DB::table('posts')->where('id', $id)->update($data);

            $notification = array(
                'message' => 'Blog Post Updated Without Image',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blogpost')->with($notification);
        }
    }
}
