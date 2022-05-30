@extends('frontend.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <div class="col-md-7 col-sm-7 sign-in border border-dark rounded p-3">
                        <h3 class="">Cart Product</h3>
                        <div class="cart_items">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($carts) && count($carts) > 0)
                                        @foreach ($carts as $item)
                                            <tr>
                                                <th scope="row">
                                                    <img src="{{ asset($item->options->image) }}"
                                                        style="width:80px;height:80px;" alt="">
                                                </th>
                                                <td class="align-middle">{{ $item->name }}</td>
                                                <td class="align-middle">{{ $item->options->color }}</td>
                                                <td class="align-middle">{{ $item->options->size }}</td>
                                                <td class="align-middle">{{ $item->qty }}</td>
                                                <td class="align-middle">${{ $item->price }}</td>
                                                <td class="align-middle">${{ $item->price * $item->qty }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No Data</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>

                            <ul class="list-group col-lg-8 mr-2" style="float: right">
                                @if (Session::has('coupon'))
                                    <li class=" list-group-item">Subtotal: <span
                                            style="float: right">${{ Cart::subtotal() }}</span>
                                    </li>
                                    <li class="list-group-item">Coupon:
                                        ({{ Session::get('coupon')['coupon_name'] }} -
                                        {{ Session::get('coupon')['discount'] }}%)
                                        <span
                                            style="float: right">-${{ Session::get('coupon')['discount_amount'] }}</span>
                                    </li>
                                    <li class="list-group-item">Shipping Charge: <span
                                            style="float: right">${{ $setting->shipping_charnge }}</span></li>
                                    <li class="list-group-item">Vat: <span
                                            style="float: right">${{ $setting->vat }}</span>
                                    </li>
                                    <li class="list-group-item active">Total: <span style="float: right">
                                            ${{ Session::get('coupon')['total_amount'] + $setting->shipping_charnge + $setting->vat }}
                                        </span>
                                    </li>
                                @else
                                    <li class=" list-group-item">Subtotal: <span
                                            style="float: right">${{ Cart::subtotal() }}</span>
                                    </li>
                                    <li class="list-group-item">Coupon: <span style="float: right">-$0</span>
                                    </li>
                                    <li class="list-group-item">Shipping Charge: <span
                                            style="float: right">${{ $setting->shipping_charnge }}</span></li>
                                    <li class="list-group-item">Vat: <span
                                            style="float: right">${{ $setting->vat }}</span>
                                    </li>
                                    <li class="list-group-item active">Total: <span style="float: right">
                                            ${{ Cart::subtotal() + $setting->shipping_charnge + $setting->vat }}
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-5 create-new-account border border-dark rounded p-3">
                        <h4 class="checkout-subtitle">Shipping Address</h4>
                        <form method="POST" action="{{ route('payment.process') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                <input type="text" id="name" name="name" value=""
                                    class="form-control unicase-form-control text-input">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                                <input type="text" id="phone" name="phone" value=""
                                    class="form-control unicase-form-control text-input">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                                <input type="email" id="email" name="email" value=""
                                    class="form-control unicase-form-control text-input">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Address <span>*</span></label>
                                <input type="text" id="address" name="address" value=""
                                    class="form-control unicase-form-control text-input">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">City <span>*</span></label>
                                <input type="text" id="city" name="city" value=""
                                    class="form-control unicase-form-control text-input">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <h4 class="">Payment By</h4>

                            <div class="form-group">
                                <ul class="logos_list">
                                    <li>
                                        <input type="radio" name="payment" value="stripe">
                                        <img src="{{ asset('frontend/images/mastercard.png') }}" alt=""
                                            style="width:80px;">
                                    </li>
                                    <li>
                                        <input type="radio" name="payment" value="paypal">
                                        <img src="{{ asset('frontend/images/paypal.png') }}" alt="" style="height:60px;">
                                    </li>
                                    <li>
                                        <input type="radio" name="payment" value="ideal">
                                        <img src="{{ asset('frontend/images/mollie.png') }}" alt="" style="height:60px;">
                                    </li>
                                </ul>
                            </div>

                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Pay Now</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
