@extends('frontend.main_master')
@section('content')
    @include('frontend.body.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">
    {{-- Home --}}
    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll"
            data-image-src="/frontend/images/shop_background.jpg">
        </div>
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">{{ $category->category_name }}</h2>
        </div>
    </div>

    {{-- Shop --}}
    <!-- Shop -->

    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    <!-- Shop Sidebar -->
                    <div class="shop_sidebar">
                        <div class="sidebar_section">
                            <div class="sidebar_title">Categories</div>
                            <ul class="sidebar_categories">
                                @foreach ($categories as $item)
                                    <li class="">
                                        <a href="{{ route('view.category', $item->id) }}"
                                            class="active">{{ $item->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar_section filter_by_section">
                            <div class="sidebar_title">Filter By</div>
                            <div class="sidebar_subtitle">Price</div>
                            <div class="filter_price">
                                <div id="slider-range" class="slider_range"></div>
                                <p>Range: </p>
                                <p><input type="text" id="amount" class="amount" readonly
                                        style="border:0; font-weight:bold;"></p>
                            </div>
                        </div>
                        <div class="sidebar_section">
                            <div class="sidebar_subtitle brands_subtitle">Brands</div>
                            <ul class="brands_list">
                                @foreach ($brandIds as $item)
                                    @php
                                        $brand = DB::table('brands')
                                            ->where('id', $item->brand_id)
                                            ->first();
                                    @endphp
                                    <li class="brand">
                                        <a href="#" class="active">{{ $brand->brand_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-9">

                    <!-- Shop Content -->

                    <div class="shop_content">
                        <div class="shop_bar clearfix">
                            <div class="shop_product_count"><span>{{ $category_all->total() }}</span> products found</div>
                            <div class="shop_sorting">
                                <span>Sort by:</span>
                                <ul>
                                    <li>
                                        <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                        <ul>
                                            <li class="shop_sorting_button"
                                                data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name
                                            </li>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "price" }'>
                                                price</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product_grid row">
                            <div class="product_grid_border"></div>

                            @foreach ($category_all as $item)
                                <!-- Product Item -->
                                <div
                                    class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset($item->image_one) }}" alt="" style="width:100px; ">
                                    </div>
                                    <div class="product_content">
                                        <div class="product_price discount">
                                            @if ($item->discount_price)
                                                ${{ $item->discount_price }}<span>${{ $item->selling_price }}</span>
                                            @else
                                                ${{ $item->selling_price }}
                                            @endif
                                        </div>
                                        <div class="product_name">
                                            <div>
                                                <a
                                                    href="{{ url('product/details/' . $item->id . '/' . Str::slug($item->product_name)) }}">{{ Str::limit($item->product_name, 20) }}</a>
                                            </div>
                                        </div>

                                        <div class="product_extras">
                                            <button id="{{ $item->id }}" class="product_cart_button addcart"
                                                data-toggle="modal" data-target="#cartmodal" onclick="productView(this.id)">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>

                                    <a class="addwishlist" data-id="{{ $item->id }}">
                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                    </a>

                                    {{-- <a href="{{route('add.wishlist', $item->id)}}">
                                                    </a> --}}

                                    <ul class="product_marks">
                                        @if ($item->discount_price)
                                            @php
                                                $amount = $item->selling_price - $item->discount_price;
                                                $discount = ($amount / $item->selling_price) * 100;
                                            @endphp
                                            <li class="product_mark product_discount">
                                                -{{ round($discount, 0) }}%</li>
                                            <li class="product_mark product_new">new</li>
                                        @else
                                            <li class="product_mark product_discount" style="background: blue;">New</li>
                                        @endif

                                    </ul>
                                </div>
                            @endforeach

                        </div>

                        <!-- Shop Page Navigation -->

                        <div class="shop_page_nav d-flex flex-row">
                            {{ $category_all->links() }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Newsletter --}}
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

    <script src="{{ asset('frontend/js/shop_custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.addwishlist').on('click', function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        'url': "{{ url('add-to-wishlist/') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            if ($.isEmptyObject(data.error)) {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                })
                            }
                        }
                    })
                } else {
                    alert('danger');
                }
            })
        })
    </script>
@endsection
