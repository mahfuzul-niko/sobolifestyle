<!-- Start slider section -->

<style>
    .hero-slider {
        width: 100%;
        max-width: 100%;
    }

    .hero-slider img {
        width: 100%;
        height: auto;
        /* ensures the full image shows */
        display: block;
    }
</style>
<div class="container-fluid">
    <div class="row slider-p pb-0">
        <div class="col-md-12 slider-pb">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

            <section class="hero-slider">
                <div class="swiper mySlider">
                    <div class="swiper-wrapper">
                        @foreach ($sliders as $slider)
                            <div class="swiper-slide">
                                <img src="{{ asset('images/slider/' . $slider->image) }}" alt="slider" />
                            </div>
                        @endforeach
                    </div>

                    {{-- <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div> --}}
                </div>
            </section>

            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                new Swiper(".mySlider", {
                    loop: true,
                    autoplay: {
                        delay: 3000, // change slide every 3 seconds
                        disableOnInteraction: false // keep autoplay even after dragging
                    },
                    speed: 800, // smooth transition
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev"
                    },
                });
            </script>

        </div>

    </div>
</div>
<!-- End slider section -->

<div class="container-fluid" style="overflow:hidden; display:none; margin-top: 15px;" id="desktopSlider">
    <a href="{{ $bottomSlider->link ?? '#' }}">
        <img src="{{ asset('images/slider/' . ($bottomSlider->image ?? 'blank.png')) }}" alt=""
            style="width:100%; height:100%; object-fit:cover; display:block;">
    </a>
</div>

<div class="container-fluid" style="overflow:hidden; display:block;" id="mobileSlider">
    <a href="{{ $bottomSlider->m_link ?? '#' }}">
        <img src="{{ asset('images/slider/' . ($bottomSlider->m_image ?? 'blank.png')) }}" alt=""
            style="width:100%; height:100%; object-fit:cover; display:block;">
    </a>
</div>
<style>
    @media (min-width: 768px) {
        #desktopSlider {
            display: block !important;
        }

        #mobileSlider {
            display: none !important;
        }
    }

    @media (max-width: 767.98px) {
        #desktopSlider {
            display: none !important;
        }

        #mobileSlider {
            display: block !important;
        }
    }
</style>
