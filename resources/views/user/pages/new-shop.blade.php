@extends('user.inc.master')
@section('title')
    Shop
@endsection
@section('description')
    Shop, all-products, discount-products, offer-products, offer, new-year-offer
@endsection
@section('keywords')
    Shop, all-products, discount-products, offer-products, offer, new-year-offer
@endsection
@section('content')
    <style>
        .price-filter {
            width: 300px;
        }

        .price-filter h4 {
            font-size: 16px;
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .price-filter h4::after {
            content: "";
            width: 60px;
            height: 2px;
            background: #000;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        /* Range Container */
        .range-container {
            position: relative;
            height: 30px;
        }

        /* Base Track */
        .range-container::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 4px;
            background: #ccc;
            transform: translateY(-50%);
            border-radius: 5px;
        }

        /* Filled Range */
        .range-fill {
            position: absolute;
            top: 50%;
            height: 4px;
            background: #444;
            transform: translateY(-50%);
            border-radius: 5px;
        }

        /* Sliders */
        input[type=range] {
            position: absolute;
            width: 100%;
            pointer-events: none;
            -webkit-appearance: none;
            background: none;
            height: 30px;
        }

        input[type=range]::-webkit-slider-thumb {
            pointer-events: all;
            -webkit-appearance: none;
            width: 14px;
            height: 14px;
            background: #444;
            border-radius: 50%;
            cursor: pointer;
        }

        input[type=range]::-moz-range-thumb {
            pointer-events: all;
            width: 14px;
            height: 14px;
            background: #444;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Bottom Section */
        .filter-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }

        .filter-bottom button {
            background: #000;
            color: #fff;
            border: none;
            padding: 6px 14px;
            font-size: 13px;
            cursor: pointer;
            border-radius: 3px;
        }

        .filter-bottom span {
            font-size: 13px;
            color: #666;
        }

        .icon-plus svg {
            transition: transform 0.3s ease;
        }

        .icon-plus.rotate svg {
            transform: rotate(45deg);
            /* rotates plus to look like a minus */
        }

        /* Target all checkboxes */
        input[type="checkbox"] {
            width: 10px;
            height: 10px;
            appearance: none;
            /* Remove default browser style */
            -webkit-appearance: none;
            /* For Safari/Chrome */
            border: 2px solid #ccc;
            border-radius: 50%;
            /* Makes it round */
            outline: none;
            cursor: pointer;
            position: relative;
            background-color: #fff;
        }

        /* Checked state */
        input[type="checkbox"]:checked {
            background-color: #000;
            border-color: #000;
        }

      
    </style>

    <div class="offcanvas__filter--sidebar widget__area">
        <button type="button" class="offcanvas__filter--close m-2" data-offcanvas="">
            <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
            </svg> <span class="offcanvas__filter--close__text">Close</span>
        </button>
        <div class="offcanvas__filter--sidebar__inner" id="mobile_filterStop">
            <div style="position:sticky; top:20px;">
                <div class="single__widget price__filter widget__bg p-3">
                    <div class="text-end"><a href="{{ route('products') }}"
                            class="btn btn-sm btn-secondary rounded">clear</a></div>
                    <h2 class="widget__title h5 mb-3">Filter Products</h2>

                    <form class="price__filter--form" action="{{ route('products') }}" method="GET">
                        <span class="fw-bold">Price Filter</span>
                        <div class="filter-bottom mb-3">
                            <div class="d-flex justify-content-between gap-2">
                                <div class="">
                                    <label for="" class="small">Min</label>
                                    <input type="number" name="min" class="form-control" id="m-min-price"
                                        placeholder="Min" value="{{ request('min') }}">
                                </div>
                                <div class="">
                                    <label for="" class="small">Max</label>
                                    <input type="number" name="max" class="form-control" id="m-max-price"
                                        placeholder="Max" value="{{ request('max') }}">
                                </div>
                            </div>
                        </div>

                        <div class="range-container">
                            <input type="range" id="m-minRange" min="0" max="10000"
                                value="{{ request('min', 0) }}">
                            <input type="range" id="m-maxRange" min="0" max="10000"
                                value="{{ request('max', 10000) }}">
                        </div>
                        @include('user.inc.filter')

                        <button class="btn btn-dark w-100 mt-2" type="submit">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="shop__section py-3">
        <div class="container-fluid">
            <div class="shop__header bg__gray--color d-flex align-items-center justify-content-between p-2 mb-10">
                <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas="">
                    <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80">
                        </path>
                        <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="28"></circle>
                        <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="28"></circle>
                        <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="28"></circle>
                    </svg>
                    <span class="widget__filter--btn__text">Filter</span>
                </button>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="shop__sidebar--widget widget__area d-none d-lg-block" id="desktop_filterStop">
                        <div style="position:sticky; top:20px;">
                            <div class="single__widget price__filter widget__bg p-3">
                                <div class="text-end"><a href="{{ route('products') }}"
                                        class="btn btn-sm btn-secondary rounded">clear</a></div>
                                <h2 class="widget__title h5 mb-3">Filter Products</h2>
                                <form class="price__filter--form" action="{{ route('products') }}" method="GET">
                                    <span class="fw-bold">Price Filter</span>
                                    <div class="filter-bottom">
                                        <div class="d-flex justify-content-between gap-2">
                                            <div class="">
                                                <label for="" class="small">Min</label>
                                                <input type="number" name="min" class="form-control" id="min-price"
                                                    placeholder="Min" value="{{ request('min') }}">
                                            </div>
                                            <div class="">
                                                <label for="" class="small">Max</label>
                                                <input type="number" name="max" class="form-control" id="max-price"
                                                    placeholder="Max" value="{{ request('max') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="range-container">
                                        <input type="range" id="minRange" min="0" max="10000"
                                            value="{{ request('min', 0) }}">
                                        <input type="range" id="maxRange" min="0" max="10000"
                                            value="{{ request('max', 10000) }}">
                                    </div>
                                    @include('user.inc.filter')

                                    <button class="btn btn-dark w-100 mt-2" type="submit">Apply Filters</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    {{-- <div class="text-end">
                        <span class="">Sort by : </span>
                        <select onchange="order_ready()" id="sort_filter" class="form-select w-auto d-inline-block"
                            aria-label="Default select example" name="sort_by">
                            <option value="ASC" selected>Price (Low &gt; High)</option>
                            <option value="DESC">Price (High &gt; Low)</option>
                        </select>

                    </div>
                    <hr> --}}
                    <div class="shop__product--wrapper">
                        <div class="tab_content">
                            <div id="product_grid" class="tab_pane active show">
                                <div class="product__section--inner product__grid--inner">
                                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-2 mb--n30">
                                        @forelse ($products as $product)
                                            @include('user.partials.product')

                                        @empty
                                            <div class="col-12">
                                                <p class="text-center py-4">No product found</p>
                                            </div>
                                        @endforelse
                                    </div>

                                    <!-- Pagination links (only if products exist) -->
                                    @if ($products->count())
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $products->links() }}
                                        </div>
                                    @endif

                                    <div class="row mt-3" id="loading_div"></div>
                                    <div class="row mb-5 text-center mt-3" id="load_more_div" style="display: none;">
                                        <div class="cart-action mb-6 pt-3 pb-3">
                                            <a href="javascript:void(0)" type="button" onclick="load_more()"
                                                class="continue__shipping--btn primary__btn border-radius-5"><i
                                                    class="w-icon-long-arrow-left"></i>Load More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const minInput = document.getElementById('min-price');
            const maxInput = document.getElementById('max-price');
            const minRange = document.getElementById('minRange');
            const maxRange = document.getElementById('maxRange');

            const minValue = parseInt(minRange.min);
            const maxValue = parseInt(maxRange.max);

            // Initialize inputs
            minInput.value = minRange.value;
            maxInput.value = maxRange.value;

            // Range → Number input sync
            minRange.addEventListener('input', () => {
                if (parseInt(minRange.value) > parseInt(maxRange.value)) {
                    minRange.value = maxRange.value;
                }
                minInput.value = minRange.value;
            });

            maxRange.addEventListener('input', () => {
                if (parseInt(maxRange.value) < parseInt(minRange.value)) {
                    maxRange.value = minRange.value;
                }
                maxInput.value = maxRange.value;
            });

            // Number input → Range sync
            minInput.addEventListener('input', () => {
                let value = parseInt(minInput.value) || minValue;

                if (value < minValue) value = minValue;
                if (value > parseInt(maxRange.value)) value = maxRange.value;

                minRange.value = value;
                minInput.value = value;
            });

            maxInput.addEventListener('input', () => {
                let value = parseInt(maxInput.value) || maxValue;

                if (value > maxValue) value = maxValue;
                if (value < parseInt(minRange.value)) value = minRange.value;

                maxRange.value = value;
                maxInput.value = value;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const minInput = document.getElementById('m-min-price');
            const maxInput = document.getElementById('m-max-price');
            const minRange = document.getElementById('m-minRange');
            const maxRange = document.getElementById('m-maxRange');

            const minValue = parseInt(minRange.min);
            const maxValue = parseInt(maxRange.max);

            // Initialize inputs
            minInput.value = minRange.value;
            maxInput.value = maxRange.value;

            // Range → Number input sync
            minRange.addEventListener('input', () => {
                if (parseInt(minRange.value) > parseInt(maxRange.value)) {
                    minRange.value = maxRange.value;
                }
                minInput.value = minRange.value;
            });

            maxRange.addEventListener('input', () => {
                if (parseInt(maxRange.value) < parseInt(minRange.value)) {
                    maxRange.value = minRange.value;
                }
                maxInput.value = maxRange.value;
            });

            // Number input → Range sync
            minInput.addEventListener('input', () => {
                let value = parseInt(minInput.value) || minValue;

                if (value < minValue) value = minValue;
                if (value > parseInt(maxRange.value)) value = maxRange.value;

                minRange.value = value;
                minInput.value = value;
            });

            maxInput.addEventListener('input', () => {
                let value = parseInt(maxInput.value) || maxValue;

                if (value > maxValue) value = maxValue;
                if (value < parseInt(minRange.value)) value = minRange.value;

                maxRange.value = value;
                maxInput.value = value;
            });
        });
    </script>
    <script>
        document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(function(el) {
            var target = document.querySelector(el.getAttribute('href'));

            target.addEventListener('show.bs.collapse', function() {
                el.querySelector('.icon-plus').classList.add('rotate');
            });

            target.addEventListener('hide.bs.collapse', function() {
                el.querySelector('.icon-plus').classList.remove('rotate');
            });
        });
    </script>
@endsection
