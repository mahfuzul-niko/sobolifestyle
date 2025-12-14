@extends('user.inc.master')

@php
    $top = $followImages->where('key', 'top_image')->first();
    $left = $followImages->where('key', 'left_image')->first();
    $middle = $followImages->where('key', 'middle_image')->first();
    $right = $followImages->where('key', 'right_image')->first();

    $fallback = asset('images/blank.png');
    $business_info = business_info();
@endphp

{{-- @php($business_info = business_info()) --}}

@section('title')
    Home
@endsection
@section('description')
    {{ optional($business_info)->meta_description }}
@endsection
@section('keywords')
    {{ optional($business_info)->meta_keywords }}
@endsection

@section('content')
    <style>
        uciq.video-slider-wrap {
            display: block;
            padding: 40px 0;
        }

        uciq .swiper-slide {
            width: 280px !important;
        }

        uciq .video-card {
            position: relative;
            height: 420px;
            border-radius: 22px;
            overflow: hidden;
            background: #000;
            box-shadow: 0 16px 40px rgba(0, 0, 0, .25);
            transition: transform .25s ease;
        }

        uciq .video-card:hover {
            transform: translateY(-6px) scale(1.01);
        }

        uciq .video-bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        uciq .video-title {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(8px);
            color: #fff;
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
        }

        uciq .video-play {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            color: #fff;
            opacity: 0;
            transition: .25s ease;
        }

        uciq .video-card:hover .video-play {
            opacity: 1;
        }

        uciq .video-action {
            position: absolute;
            bottom: 14px;
            left: 14px;
            right: 14px;
        }

        uciq .video-action a {
            width: 100%;
            border-radius: 12px;
            background: rgba(255, 255, 255, .18);
            color: #fff;
            backdrop-filter: blur(8px);
        }

        .cat-circle-card {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #fff;
            padding: 2px;
            margin: auto;
            transition: transform 0.3s ease;
            overflow: hidden;
            /* Important */
        }

        .cat-circle-card:hover {
            transform: scale(1.05);
        }

        .cat-image-inside {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Keeps image nice */
            border-radius: 50%;
        }

        .cat-title {
            font-size: 14px;
            font-weight: 600;
            text-align: center;
        }

        /* .product_col {
                                                            opacity: 0;
                                                            transform: translateY(50px) scale(0.95);
                                                            transition: opacity 0.5s ease, transform 0.5s ease;
                                                            
                                                        }

                                                        .product_col.fade-in {
                                                            opacity: 1;
                                                            transform: translateY(0) scale(1);
                                                            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                                                        } */
    </style>
    @include('user.partials.slider')

    {{-- Category --}}
    <section class="team__section py-4 mt-10">
        <div class="container-fluid">

            <div class="swiper categorySlider">
                <div class="swiper-wrapper">

                    @foreach ($featured_categories as $category)
                        <div class="swiper-slide text-center p-2">
                            <a href="{{ route('products', ['category_id[]' => $category->id]) }}"
                                class="text-decoration-none">
                                <div
                                    class="rounded-circle shadow d-flex align-items-center justify-content-center cat-circle-card">
                                    <img class="rounded-circle cat-image-inside"
                                        src="{{ asset('images/category/' . $category->image) }}"
                                        alt="{{ $category->title }}">
                                </div>
                                <p class="cat-title mt-2 text-dark">{{ $category->title }}</p>
                            </a>
                        </div>
                    @endforeach

                </div>


            </div>

            <div class="text-center mt-3">
                <a class="rounded shop_more_btn" href="{{ route('products') }}">
                    See all
                    <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2"
                        viewBox="0 0 6.2 6.2">
                        <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z"
                            transform="translate(-4 -4)" fill="currentColor"></path>
                    </svg>
                </a>
            </div>

        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.categorySlider', {
                slidesPerView: 2,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 2000, // time between slides (ms)
                    disableOnInteraction: false
                },


                breakpoints: {
                    576: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 5
                    },
                    1200: {
                        slidesPerView: 6
                    },
                }
            });
        });
    </script>


    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <uciq class="video-slider-wrap">
        <div class="swiper video-swiper-loop">
            <div class="swiper-wrapper">

                @for ($i = 1; $i <= 4; $i++)
                    <div class="swiper-slide">
                        <div class="video-card">
                            <video src="{{ asset('assets') }}/video/test.mp4"
                                poster="{{ asset('assets') }}/images/thumb.jpg" muted loop preload="metadata"
                                class="video-bg">
                            </video>

                            <div class="video-title">Modern Product {{ $i }}</div>
                            <div class="video-play">▶</div>

                            <div class="video-action">
                                <a href="#" class="btn btn-sm btn-light">View</a>
                            </div>
                        </div>
                    </div>
                @endfor
                @for ($i = 1; $i <= 4; $i++)
                    <div class="swiper-slide">
                        <div class="video-card">
                            <video src="{{ asset('assets') }}/video/test.mp4"
                                poster="{{ asset('assets') }}/images/thumb.jpg" muted loop preload="metadata"
                                class="video-bg">
                            </video>

                            <div class="video-title">Modern Product {{ $i }}</div>
                            <div class="video-play">▶</div>

                            <div class="video-action">
                                <a href="#" class="btn btn-sm btn-light">View</a>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>

            <div class="swiper-pagination"></div>
        </div>
    </uciq> --}}







    {{-- Flash Sale Offer --}}
    <div id="flash_sale_offer"></div>

    {{-- <section class="team__section py-5">
    <div class="container">
        <div class="section__heading text-center mb-50">
            <h2 title="Get your desired product from featured category" class="section__heading--maintitle">Featured Categories</h2>
        </div> 
            <div class="row 
                cat-cols-xxl-8
                cat-cols-xl-8 
                cat-cols-lg-8 
                cat-cols-md-6 
                cat-cols-sm-4 
                cat-cols-4
                ">
                 @foreach ($featured_categories as $category)
                 <div class="p-2">
                     <div class="rounded shadow cat-zoom cat-py-5 cat-box">
                         <a href="{{route('products', ['category_id'=>$category->id])}}">
                            <div class="row text-center">
                                <div class="col-12 mb-2">
                                    <img class="cat-image" style="" src="{{ asset('images/category/'.$category->image ) }}" alt="{{$category->title}}">
                                </div>
                                <div class="col-12 cat-title-box">
                                    <p class="cat-title"> {{$category->title}} </p> 
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</section> --}}
    {{-- Featured Products --}}
    @if ($featured_products)
        <section class="product__section section--padding py-5">
            <div class="container-fluid">
                <div class="section__heading text-center mb-50">
                    <h2 title="Get your desired product from Featured Products" class="section__heading--maintitle">Featured
                        Products</h2>
                    {{-- <div class="btn_custom mb-2 ">
                        <a class=" rounded shop_more_btn"
                            href="{{ route('products.individual.group', ['slug' => 'featured']) }}">Shop More
                            <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2"
                                height="12.2" viewBox="0 0 6.2 6.2">
                                <path
                                    d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z"
                                    transform="translate(-4 -4)" fill="currentColor"></path>
                            </svg>
                        </a>
                    </div> --}}
                </div>
                {{-- <div class="section__heading mb-2 border-bottom d-flex d-none">
            <h2 class="section__heading--style2 flex-grow-1">Featured Products </h2>
            <div class="btn_custom mb-2 ">
                <a class=" rounded shop_more_btn" href="{{route('products.individual.group', ['slug'=>'featured'])}}">Shop More
                    <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                    <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
                    </svg>
                </a>
            </div>
        </div> --}}
                <div class="product__section--inner">
                    <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                        @foreach ($featured_products as $product)
                            @include('user.partials.product')
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    @include('user.partials.home_page_four_banner')
    {{-- Trending Now --}}
    @if ($trending_products)
        <section class="product__section section--padding pt-0" style="padding-bottom: 3rem !important;">
            <div class="container-fluid">
                <div class="section__heading text-center mb-50">
                    <h2 title="Get your desired product from Trending Now" class="section__heading--maintitle">Trending Now
                    </h2>
                    <div class="btn_custom mb-2 ">

                    </div>
                </div>

                <div class="product__section--inner">
                    <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                        @foreach ($trending_products as $product)
                            @include('user.partials.product')
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <div id="featured_products"></div>

    <div id="best_selling_productsStop"></div>


    <section class="product__section section--padding py-5">
        <div class="container-fluid">
            <div class="section__heading text-center mb-50">
                <h2 class="section__heading--maintitle">Follow Us</h2>
            </div>

            <div class="row">

                <!-- TOP IMAGE FULL WIDTH -->
                <div class="col-md-12 mb-4">
                    <a href="{{ $top && $top->link ? $top->link : '#' }}">
                        <img src="{{ $top && $top->image ? asset('images/follow_us/' . $top->image) : $fallback }}"
                            class="img-fluid w-100" alt="">
                    </a>
                </div>

                <!-- LEFT -->
                <div class="col-md-4 mb-4">
                    <a href="{{ $left && $left->link ? $left->link : '#' }}">
                        <img src="{{ $left && $left->image ? asset('images/follow_us/' . $left->image) : $fallback }}"
                            class="img-fluid w-100" alt="">
                    </a>
                </div>

                <!-- MIDDLE -->
                <div class="col-md-4 mb-4">
                    <a href="{{ $middle && $middle->link ? $middle->link : '#' }}">
                        <img src="{{ $middle && $middle->image ? asset('images/follow_us/' . $middle->image) : $fallback }}"
                            class="img-fluid w-100" alt="">
                    </a>
                </div>

                <!-- RIGHT -->
                <div class="col-md-4 mb-4">
                    <a href="{{ $right && $right->link ? $right->link : '#' }}">
                        <img src="{{ $right && $right->image ? asset('images/follow_us/' . $right->image) : $fallback }}"
                            class="img-fluid w-100" alt="">
                    </a>
                </div>

            </div>
        </div>
    </section>


    {{-- featured brands section --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(window).on('load', function() {
            //featured_products();
            best_selling_products();
            flash_sale_offer();
        });
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const swiperLoop = new Swiper('uciq .video-swiper-loop', {
                slidesPerView: 4,
                spaceBetween: 20,
                loop: true,
                loopedSlides: 4,
                loopAdditionalSlides: 4,
                centeredSlides: true,
                speed: 600,

                pagination: {
                    el: 'uciq .swiper-pagination',
                    clickable: true,
                    dynamicBullets: true
                },

                breakpoints: {
                    0: {
                        slidesPerView: 1.1
                    },
                    576: {
                        slidesPerView: 2.2
                    },
                    992: {
                        slidesPerView: 4
                    }
                }
            });

            // Hover to play video
            document.querySelectorAll('uciq .video-card').forEach(card => {
                const video = card.querySelector('video');

                card.addEventListener('mouseenter', () => {
                    video.play();
                });

                card.addEventListener('mouseleave', () => {
                    video.pause();
                    video.currentTime = 0;
                });
            });

        });
    </script>


    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in'); // no delay
                        obs.unobserve(entry.target); // stop observing after fade-in
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observe all existing product cards
            document.querySelectorAll('.product_col').forEach(card => observer.observe(card));

            // Lazy-loaded cards support
            const productContainer = document.getElementById('trending-products');
            if (productContainer) {
                const mutationObserver = new MutationObserver(() => {
                    const newCards = productContainer.querySelectorAll('.product_col:not(.fade-in)');
                    newCards.forEach(card => observer.observe(card));
                });
                mutationObserver.observe(productContainer, {
                    childList: true,
                    subtree: true
                });
            }
        });
    </script> --}}





@endsection
