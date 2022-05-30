@extends('frontend.main_master')
@section('content')
    @include('frontend.body.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">

    {{-- Blog --}}
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog_posts d-flex flex-row align-items-start justify-content-between">

                        @foreach ($posts as $item)
                            <!-- Blog post -->
                            <div class="blog_post">
                                <div class="blog_image" style="background-image:url({{ asset($item->post_image) }})">
                                </div>
                                <div class="blog_text">
                                    @if (Session::get('lang') == 'english')
                                        {{ $item->post_title_en }}
                                    @else
                                        {{ $item->post_title_vn }}
                                    @endif
                                </div>
                                <div class="blog_button"><a href="{{ route('blog.single', $item->id) }}">
                                        @if (Session::get('lang') == 'english')
                                            Continue Reading
                                        @else
                                            Đọc tiếp
                                        @endif

                                    </a></div>
                            </div>
                        @endforeach

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
                            <div class="newsletter_icon"><img src="images/send.png" alt=""></div>
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

    <script src="{{ asset('frontend/js/blog_custom.js') }}"></script>
@endsection
