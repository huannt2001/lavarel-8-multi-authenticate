<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Coupon;
use App\Models\Admin\Newslater;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function CouponView()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon_view', compact('coupons'));
    }

    public function StoreCoupon(Request $request)
    {
        $validateData = $request->validate([
            'coupon' => 'required',
            'discount' => 'required'
        ]);

        Coupon::insert([
            'coupon' => $request->coupon,
            'discount' => $request->discount,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteCoupon($id)
    {
        if (isset($id)) {
            Coupon::findOrFail($id)->delete($id);
            $notification = array(
                'message' => 'Coupon Deleted Successfully',
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

    public function EditCoupon($id)
    {
        if (isset($id)) {
            $coupon = Coupon::findOrFail($id);
            return view('admin.coupon.coupon_edit', compact('coupon'));
        } else {
            $notification = array(
                'message' => 'Missing Required Parameter',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function UpdateCoupon(Request $request, $id)
    {
        $validateData = $request->validate([
            'coupon' => 'required',
            'discount' => 'required',
        ]);

        $coupon = [];
        $coupon['coupon'] = $request->coupon;
        $coupon['discount'] = $request->discount;
        $update = DB::table('coupons')->where('id', $id)->update($coupon);

        if ($update) {
            $notification = array(
                'message' => 'Coupon Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.coupon')->with($notification);
        } else {
            $notification = array(
                'message' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('all.coupon')->with($notification);
        }
    }

    public function NewslaterView()
    {
        $subcribers = Newslater::all();
        return view('admin.coupon.newslater_view', compact('subcribers'));
    }

    public function DeleteNewslater($id)
    {
        if (isset($id)) {
            Newslater::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Subcriber Deleted Successfully',
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
}
