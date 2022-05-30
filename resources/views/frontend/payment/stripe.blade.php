@extends('frontend.main_master')
@section('content')
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            width: 100%;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>

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
                        <form action="{{ route('stripe.charge') }}" method="post" id="payment-form">
                            @csrf
                            <div class="form-row">
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>

                                <input type="hidden" name="shipping" value="{{ $setting->shipping_charnge }}">
                                <input type="hidden" name="vat" value="{{ $setting->vat }}">
                                <input type="hidden" name="total"
                                    value="{{ Session::get('coupon') ? Session::get('coupon')['total_amount'] + $setting->shipping_charnge + $setting->vat : Cart::subtotal() + $setting->shipping_charnge + $setting->vat }}">

                                <input type="hidden" name="ship_name" value="{{ $data['name'] }}">
                                <input type="hidden" name="ship_phone" value="{{ $data['phone'] }}">
                                <input type="hidden" name="ship_email" value="{{ $data['email'] }}">
                                <input type="hidden" name="ship_address" value="{{ $data['address'] }}">
                                <input type="hidden" name="ship_city" value="{{ $data['city'] }}">

                            </div><br>
                            <button class="btn btn-info mt-3">Payment Now</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Create a Stripe client.
        var stripe = Stripe(
            'pk_test_51L45wOBXg7TO1vQnyvJDZSmi2xAYII1LxSGnQKuOhkCzXhL2BhvOmIcqEjNXOvTQi0rg7lj6xRmHSrDgoHvBDMk300j1VVFkUz'
        );
        // Create an instance of Elements.
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>
@endsection
