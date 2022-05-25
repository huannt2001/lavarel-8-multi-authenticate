@extends('frontend.main_master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Checkout</div>
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
                                        <th scope="col">Action</th>
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
                                                <td class="align-middle">
                                                    <form action="{{ route('update.cart', $item->rowId) }}" method="post"
                                                        class="d-flex">
                                                        @csrf
                                                        <input type="number" value="{{ $item->qty }}" name="qty"
                                                            class="form-control" style="width:70px;">
                                                        <button class="btn btn-success btn-sm" type="submit">
                                                            <i class="fas fa-check-square"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="align-middle">${{ $item->price }}</td>
                                                <td class="align-middle">${{ $item->price * $item->qty }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('remove.cart', $item->rowId) }}"
                                                        class="btn btn-danger ">X</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No Data</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>



                        </div>

                        <!-- Order Total -->
                        <div class="row justify-content-between">
                            <div class="order-total-content col-lg-4">
                                <h5>Apply Coupon</h5>
                                <form action="">
                                    <div class="form-group ">
                                        <input type="text" name="" class="form-control" required=""
                                            placeholder="Enter Your Coupon">
                                    </div>
                                    <button type="submit" class="btn btn-danger ml-2">Submit</button>
                                </form>
                            </div>

                            <ul class="list-group col-lg-4 mr-2" style="float: right">
                                <li class="list-group-item">Subtotal: <span style="float: right">$4535</span></li>
                                <li class="list-group-item">Coupon: <span style="float: right">$4535</span></li>
                                <li class="list-group-item">Shipping Charge: <span style="float: right">$4535</span></li>
                                <li class="list-group-item">Vat: <span style="float: right">$4535</span></li>
                                <li class="list-group-item active">Total: <span style="float: right">$4535</span></li>
                            </ul>
                        </div>

                        <div class="cart_buttons">
                            <button type="button" class="button cart_button_clear">All Cancel</button>
                            <a href="{{ route('user.checkout') }}" class="button cart_button_checkout">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div
                        class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="/frontend/images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text">
                                <p>...and receive %20 coupon for first shopping.</p>
                            </div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="#" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required"
                                    placeholder="Enter your email address">
                                <button class="newsletter_button">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
@endsection
