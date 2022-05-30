<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newslater;

class HomeController extends Controller
{
    public function StoreNewslater(Request $request) {
        $validateData = $request->validate([
            'email' => 'required|unique:newslaters|max:55',
        ]);

        Newslater::insert([
            'email' => $request->email,
        ]);

        $notification = array(
            'message' => 'Thanks for Subcribing',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
