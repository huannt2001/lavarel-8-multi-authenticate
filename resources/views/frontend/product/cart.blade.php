@extends('frontend.main_master')
@section('content')
    @include('frontend.body.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            {{-- <ul class="cart_list">
                                @if (isset($carts) && count($carts) > 0)
                                    @foreach ($carts as $item)
                                        <li class="cart_item clearfix">
                                            <div class="cart_item_image text-center"><img
                                                    src="{{ asset($item->options->image) }}"
                                                    style="width:70px;height:70px;" alt=""></div>
                                            <div
                                                class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                <div class="cart_item_name cart_info_col">
                                                    <div class="cart_item_title">Name</div>
                                                    <div class="cart_item_text">{{ $item->name }}</div>
                                                </div>
                                                @if ($item->options->size)
                                                    <div class="cart_item_color cart_info_col">
                                                        <div class="cart_item_title">Color</div>
                                                        <div class="cart_item_text">{{ $item->options->color }}</div>>
                                                    </div>
                                                @else
                                                @endif

                                                @if ($item->options->size)
                                                    <div class="cart_item_color cart_info_col">
                                                        <div class="cart_item_title">Size</div>
                                                        <div class="cart_item_text">{{ $item->options->size }}</div>>
                                                    </div>
                                                @else
                                                @endif

                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Quantity</div>
                                                    <div class="cart_item_text">{{ $item->qty }}</div>
                                                </div>
                                                <div class="cart_item_price cart_info_col">
                                                    <div class="cart_item_title">Price</div>
                                                    <div class="cart_item_text">${{ $item->price }}</div>
                                                </div>
                                                <div class="cart_item_total cart_info_col">
                                                    <div class="cart_item_title">Total</div>
                                                    <div class="cart_item_text">${{ $item->price * $item->qty }}</div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                @endif
                            </ul> --}}

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
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">${{ Cart::subtotal() }}</div>
                            </div>
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
