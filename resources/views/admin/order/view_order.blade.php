@extends('admin.admin_master')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Pending Order</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    Order Details
                </h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><strong>Order</strong> Details</div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th scope="col">Name: </th>
                                        <th scope="col">{{ $order->user->name }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Phone: </th>
                                        <th scope="col">{{ $order->user->phone }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Payment Type: </th>
                                        <th scope="col">{{ $order->payment_type }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Payment Id: </th>
                                        <th scope="col">{{ $order->payment_id }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Total: </th>
                                        <th scope="col">${{ $order->total }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Month: </th>
                                        <th scope="col">{{ $order->month }}</th>
                                    </tr>

                                    <tr>
                                        <th scope="col">Date: </th>
                                        <th scope="col">{{ $order->date }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><strong>Shipping</strong> Details</div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th scope="col">Name: </th>
                                        <th scope="col">{{ $shipping->ship_name }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Phone: </th>
                                        <th scope="col">{{ $shipping->ship_phone }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Email: </th>
                                        <th scope="col">{{ $shipping->ship_email }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Address: </th>
                                        <th scope="col">{{ $shipping->ship_address }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">City: </th>
                                        <th scope="col">{{ $shipping->ship_city }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Status: </th>
                                        <th scope="col">
                                            @if ($order->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif ($order->status == 1)
                                                <span class="badge badge-info">Payment Accept</span>
                                            @elseif ($order->status == 2)
                                                <span class="badge badge-primary">Progress</span>
                                            @elseif ($order->status == 3)
                                                <span class="badge badge-success">Delivered</span>
                                            @else
                                                <span class="badge badge-danger">Cancle</span>
                                            @endif
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="sl-pagebody">
                            <div class="card pd-20 pd-sm-40">
                                <h6 class="card-body-title">
                                    Product Details
                                </h6>

                                <div class="table-wrapper">

                                    <table class="table display responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p">Product ID</th>
                                                <th class="wd-15p">Product Name</th>
                                                <th class="wd-15p">Image</th>
                                                <th class="wd-15p">Color</th>
                                                <th class="wd-15p">Size</th>
                                                <th class="wd-15p">Quantity</th>
                                                <th class="wd-15p">Unit Price</th>
                                                <th class="wd-20p">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_details as $key => $item)
                                                <tr>
                                                    <td>{{ $item->product->product_code }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>
                                                        <img src="{{ asset($item->product->image_one) }}" alt=""
                                                            style="width:50px;height:50px">
                                                    </td>
                                                    <td>{{ $item->color }}</td>
                                                    <td>{{ $item->size }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->singleprice }}</td>>
                                                    <td>{{ $item->totalprice }}</td>>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($order->status == 0)
                    <a href="{{ route('admin.payment.accept', $order->id) }}" class="btn btn-info">Payment Accept</a>
                    <a href="{{ route('admin.payment.cancel', $order->id) }}" class="btn btn-danger">Payment cancel</a>
                @elseif ($order->status == 1)
                    <a href="{{ route('admin.process.delivery', $order->id) }}" class="btn btn-info">
                        Process Delivery
                    </a>
                @elseif ($order->status == 2)
                    <a href="{{ route('admin.delivery.done', $order->id) }}" class="btn btn-info">Delivery Done</a>
                @elseif ($order->status == 4)
                    <strong class="text-danger text-center">The order are not valid</strong>
                @else
                    <strong class="text-success text-center">This product are succefully delivered</strong>
                @endif
            </div>
        </div>
    </div>
@endsection
