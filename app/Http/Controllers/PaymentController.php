<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetail;
use Cart;
use Auth;

class PaymentController extends Controller
{
    public function PaymenProcess(Request $request) {
        $setting = Setting::first();
        $carts = Cart::content();
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'payment' => $request->payment
        ];

        if ($request->payment == 'stripe') {
            return view('frontend.payment.stripe', compact('data', 'setting', 'carts'));
        } else if ($request->payment == 'paypal') {

        } else if ($request->payment == 'ideal') {
            
        } else {
            echo "Cash on Delivery";
        }
    }

    public function StripeCharge(Request $request) {
        $total = $request->total;
        // Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey('sk_test_51L45wOBXg7TO1vQnR4eMR5VqmqQIiYLOdrLhvhIuSX0v91etTBVHWC4iZP8oSAEbXfebZZkCE7ZyAmQcp16qIIl100N9H0fCwD');

		// Token is created using Checkout or Elements!
		// Get the payment token ID submitted by the form:
		$token = $_POST['stripeToken'];

		$charge = \Stripe\Charge::create([
		    'amount' => $total*100,
		    'currency' => 'usd',
		    'description' => 'Udemy Ecommerce Details dsadas',
		    'source' => $token,
		    'metadata' => ['order_id' => uniqid()],
		]);

        // if (Session::has('coupon')) {
        //     $subtotal = Session::get('coupon')[];
        // }

        // insertGetId chèn vào Id và lấy id
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'payment_id' => $charge->payment_method,
            'paying_amount' => $charge->amount,
            'blnc_transection' => $charge->balance_transaction,
            'stripe_order_id' => $charge->metadata->order_id,
            'subtotal' => Cart::subtotal(),
            'shipping' => $request->shipping,
            'vat' => $request->vat,
            'total' => $request->total,
            'status' => 0,
            'date' => date('d-m-y'),
            'month' => date('F'),
            'date' => date('Y'),
        ]);

        // Insert Shipping Table
        Shipping::insert([
            'order_id' => $order_id,
            'ship_name' => $request->ship_name,
            'ship_phone' => $request->ship_phone,
            'ship_email' => $request->ship_email,
            'ship_address' => $request->ship_address,
            'ship_city' => $request->ship_city,
        ]);

        // Insert Order Details Table
        $content = Cart::content();
        foreach ($content as $item) {
            $data = [
                'order_id' => $order_id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'color' => $item->options->color,
                'size' => $item->options->size,
                'qty' => $item->qty,
                'singleprice' => $item->price,
                'totalprice' => $item->price*$item->qty
            ];
            OrderDetail::insert($data);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification = array(
            'message' => 'Order Process Successfully Done',
            'alert-type' => 'success',
        );
        return redirect()->to('/')->with($notification);
    }
}
