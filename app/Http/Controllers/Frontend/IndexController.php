<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
	public function index()
	{
		return view('frontend.index');
	}

	public function UserLogout()
	{
		Auth::logout();
		return Redirect()->route('login');
	}


	public function UserProfile()
	{
		$id = Auth::user()->id;
		$user = User::find($id);

		return view('frontend.profile.user_profile', compact('user'));
	}

	public function UserOrder()
	{
		$id = Auth::user()->id;
		$user = User::find($id);
		$orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->limit(10)->get();
		return view('frontend.profile.user_order', compact('user', 'orders'));
	}

	public function UserProfileStore(Request $request)
	{
		$data = User::find(Auth::user()->id);
		$data->name = $request->name;
		$data->email = $request->email;
		$data->phone = $request->phone;


		if ($request->file('profile_photo_path')) {
			$file = $request->file('profile_photo_path');
			@unlink(public_path('upload/user_images/' . $data->profile_photo_path));
			$filename = date('YmdHi') . $file->getClientOriginalName();
			$file->move(public_path('upload/user_images'), $filename);
			$data['profile_photo_path'] = $filename;
		}
		$data->save();

		$notification = array(
			'message' => 'User Profile Updated Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('user.home')->with($notification);
	} // end method 


	public function UserChangePassword()
	{
		$id = Auth::user()->id;
		$user = User::find($id);
		return view('frontend.profile.change_password', compact('user'));
	}


	public function UserPasswordUpdate(Request $request)
	{

		$validateData = $request->validate([
			'oldpassword' => 'required',
			'password' => 'required|confirmed',
		]);

		$hashedPassword = Auth::user()->password;
		if (Hash::check($request->oldpassword, $hashedPassword)) {
			if ($request->password === $request->password_confirmation) {
				$user = User::find(Auth::id());
				$user->password = Hash::make($request->password);
				$user->save();
				Auth::logout();
				$notification = array(
					'message' => 'Password Changed Successfully ! Now Login With Your New Password',
					'alert-type' => 'success',
				);
				return redirect()->route('user.logout')->with($notification);
			} else {
				$notification = array(
					'message' => 'New Password and Confirm Password not matched',
					'alert-type' => 'error',
				);
				return redirect()->back()->with($notification);
			}
		} else {
			$notification = array(
				'message' => 'Old Password not matched! Please try again',
				'alert-type' => 'error',
			);
			return redirect()->back()->with($notification);
		}
	} // end method

	public function DetailOrder($id)
	{
		$order = Order::where('id', $id)->first();

		$shipping = Shipping::where('order_id', $id)->first();

		$order_details = OrderDetail::where('order_id', $id)->get();

		return view('frontend.order.detail_order', compact('order', 'shipping', 'order_details'));
	}
}
