<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Post;

class BlogController extends Controller
{
    public function Blog() {
        $posts = Post::all();
        return view('frontend.blog.view_blog', compact('posts'));
    }

    public function English() {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang', 'english');
        return redirect()->back();
    }

    public function Vietnam() {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang', 'vietnam');
        return redirect()->back();
    }

    public function BlogSingle($id) {
        $post = Post::find($id);
        $anotherPosts = Post::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();   
        return view('frontend.blog.blog_single', compact('post', 'anotherPosts'));
    }
}
