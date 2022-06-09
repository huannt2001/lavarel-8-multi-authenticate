<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function NewOrder()
    {
        $orders = Order::where('status', 0)->get();
        return view('admin.order.pending', compact('orders'));
    }

    public function ViewOrder($id)
    {
        $order = Order::where('id', $id)->first();

        $shipping = Shipping::where('order_id', $id)->first();

        $order_details = OrderDetail::where('order_id', $id)->get();

        return view('admin.order.view_order', compact('order', 'shipping', 'order_details'));
    }

    public function PaymentAccept($id)
    {
        Order::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Payment Accept Done',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.new.order')->with($notification);
    }

    public function PaymentCancel($id)
    {
        Order::where('id', $id)->update(['status' => 4]);

        $notification = array(
            'message' => 'Order Cancelled',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.new.order')->with($notification);
    }

    public function ViewAllAcceptPayment()
    {
        $orders = DB::table('orders')->where('status', '1')->get();

        return view('admin.order.pending', compact('orders'));
    }

    public function ViewAllCancelOrder()
    {
        $orders = Order::where('status', 4)->get();
        return view('admin.order.pending', compact('orders'));
    }

    public function ViewAllProcessPayment()
    {
        $orders = Order::where('status', 2)->get();
        return view('admin.order.pending', compact('orders'));
    }

    public function ViewAllSuccessPayment()
    {
        $orders = Order::where('status', 3)->get();
        return view('admin.order.pending', compact('orders'));
    }

    public function ProcessDelivery($id)
    {
        Order::where('id', $id)->update(['status' => 2]);
        $notification = array(
            'message' => 'Send To Delivery',
            'alert-type' => 'success'
        );
        return redirect()->route('view.process.payment')->with($notification);
    }

    public function DeliveryDone($id)
    {
        Order::where('id', $id)->update(['status' => 3]);
        $notification = array(
            'message' => 'Delivery Done',
            'alert-type' => 'success'
        );
        return redirect()->route('view.success.payment')->with($notification);
    }
}
