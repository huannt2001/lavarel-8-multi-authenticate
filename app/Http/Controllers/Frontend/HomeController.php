<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newslater;
use App\Models\Order;

class HomeController extends Controller
{
    public function StoreNewslater(Request $request)
    {
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

    public function OrderTracking(Request $request)
    {
        $code = $request->code;

        $track = Order::where('status_code', $code)->first();

        if ($track) {
            return view('frontend.tracking.tracking', compact('track'));
        } else {
            $notification = array(
                'message' => 'Status Code Invalid',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
