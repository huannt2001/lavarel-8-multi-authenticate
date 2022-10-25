<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function TodayOrder()
    {
        $today = date('d-m-y');
        $orders = Order::where('status', 0)->where('date', $today)->get();
        return view('admin.report.today_order', compact('orders'));
    }

    public function TodayDelivery()
    {
        $today = date('d-m-y');
        $orders = Order::where('status', 3)->where('date', $today)->get();
        return view('admin.report.today_delivery', compact('orders'));
    }

    public function ThisMonth()
    {
        $this_month = date('F');
        $orders  = Order::where('status', 3)->where('month', $this_month)->get();

        return view('admin.report.this_month', compact('orders'));
    }

    public function SearchReport()
    {
        return view('admin.report.search_report');
    }
}
