@extends('frontend.main_master')
@section('content')
    @include('frontend.body.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">

    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        <li data-image="{{ asset($product->image_one) }}"><img src="{{ asset($product->image_one) }}"
                                alt="">
                        </li>
                        <li data-image="{{ asset($product->image_two) }}"><img src="{{ asset($product->image_two) }}"
                                alt="">
                        </li>
                        <li data-image="{{ asset($product->image_three) }}"><img
                                src="{{ asset($product->image_three) }}" alt="">
                        </li>
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-5 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset($product->image_one) }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-5 order-3">
                    <div class="product_description">
                        <div class="product_category">{{ $product->category->category_name }} >
                            {{ $product->subcategory->subcategory_name }}</div>
                        <div class="product_name">{{ $product->product_name }}</div>
                        <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                        <div class="product_text">
                            <p>{!! \Illuminate\Support\Str::limit($product->product_details, $limit = 600) !!}
                            </p>
                        </div>
                        <div class="order_info d-flex flex-row">
                            <form action="{{ route('store.product.cart', $product->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect">Color</label>
                                            <select name="color" id="exampleFormControlSelect"
                                                class="form-control input-lg">
                                                @if (isset($product_color) && count($product_color) > 0)
                                                    @foreach ($product_color as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    @if (!$product->product_size)
                                    @else
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect">Size</label>
                                                <select name="size" id="exampleFormControlSelect"
                                                    class="form-control input-lg">
                                                    @foreach ($product_size as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect">Quantity</label>
                                            <input type="number" class="form-control" name="qty" value="1"
                                                pattern="[0-9]*">
                                        </div>
                                    </div>
                                </div>


                                <div class="product_price">
                                    <div class="product_price discount">
                                        @if ($product->discount_price)
                                            ${{ $product->discount_price }}<span>${{ $product->selling_price }}</span>
                                        @else
                                            ${{ $product->selling_price }}
                                        @endif
                                    </div>
                                </div>
                                <div class="button_container">
                                    <button type="submit" class="button cart_button">Add to Cart</button>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Product Detail</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Product Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Video link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Product Review</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>{!! $product->product_details !!}
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <br>{{ $product->video_link }}
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <br>
                            Lorem ipsum
                            dolor sit amet consectetur adipisicing elit. Eum cum, in tempore aliquid quibusdam fugiat ullam
                            ratione rerum a exercitationem. Dolorum, magnam. Vel tenetur fugit ipsa facilis, molestiae
                            deserunt consequuntur.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">

                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_1.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_2.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_3.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_4.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_5.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_6.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_7.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="/frontend/images/brands_8.jpg" alt=""></div>
                            </div>

                        </div>

                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->

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
@endsection
