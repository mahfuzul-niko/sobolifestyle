{{-- Start --}}

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
        margin-top: 20px;
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
</style>

@if (request()->query())
    <div class="single__widget widget__bg d-none">
        <h2 class="widget__title h3">Brands</h2>
        <ul class="widget__categories--menu"> {{-- style="overflow-y: scroll; height:200px;" --}}
            <?php
            $category = App\Models\Category::where('id', request()->category_id)->orWhere('parent_id', request()->category_id)->first();
            
            ?>
            @if ($category)
                @if ($category->parent)
                    {{-- $category->parent->title --}}

                    @if (count($category->parent->child) > 0)
                        @foreach ($category->parent->child as $p_category)
                            @if (count($p_category->child) > 0)
                                <li class="widget__categories--menu__list ms-2 me-1">
                                    {{-- sub category with sub sub category  --}}
                                    <label class="widget__categories--menu__label d-flex align-items-center">
                                        <img class="widget__categories--menu__img"
                                            src="{{ asset('images/category/' . $p_category->image) }}"
                                            alt="{{ $p_category->title }}">
                                        <span
                                            class="widget__categories--menu__text text-dark">{{ $p_category->title }}</span>
                                        <svg class="widget__categories--menu__arrowdown--icon"
                                            xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                                            <path
                                                d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                                transform="translate(-6 -8.59)" fill="currentColor"></path>
                                        </svg>
                                    </label>
                                    <ul class="widget__categories--sub__menu" style="display: block;">
                                        @foreach ($p_category->child as $inner_sub_category)
                                            <li class="widget__categories--sub__menu--list ms-2">
                                                <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                                    href="{{ route('products', ['category_id' => $inner_sub_category->id]) }}">
                                                    <img class="widget__categories--sub__menu--img"
                                                        src="{{ asset('images/category/' . $inner_sub_category->image) }}"
                                                        alt="{{ $inner_sub_category->title }}">
                                                    <span
                                                        class="widget__categories--sub__menu--text text-dark">{{ $inner_sub_category->title }}</span>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @else
                                <li class="widget__categories--sub__menu--list">
                                    <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                        href="{{ route('products', ['category_id' => $p_category->id]) }}">
                                        <img class="widget__categories--sub__menu--img rounded shadow"
                                            src="{{ asset('images/category/' . $p_category->image) }}"
                                            alt="{{ $p_category->title }}">
                                        <span
                                            class="widget__categories--sub__menu--text text-dark">{{ $p_category->title }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
        </ul>
        </li>
@endif
@else
@endif
@foreach ($categories as $category)
    @if (count($category->child) > 0)
        @foreach ($category->child as $p_category)
            @if (count($p_category->child) > 0)
                <li class="widget__categories--menu__list ms-2 me-1">
                    {{-- sub category with sub sub category  --}}
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img"
                            src="{{ asset('images/category/' . $p_category->image) }}" alt="{{ $p_category->title }}">
                        <span class="widget__categories--menu__text text-dark">{{ $p_category->title }}</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                            width="12.355" height="8.394">
                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <ul class="widget__categories--sub__menu" style="display: block;">
                        @foreach ($p_category->child as $inner_sub_category)
                            <li class="widget__categories--sub__menu--list ms-2">
                                <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                    href="{{ route('products', ['category_id' => $inner_sub_category->id]) }}">
                                    <img class="widget__categories--sub__menu--img"
                                        src="{{ asset('images/category/' . $inner_sub_category->image) }}"
                                        alt="{{ $inner_sub_category->title }}">
                                    <span
                                        class="widget__categories--sub__menu--text text-dark">{{ $inner_sub_category->title }}</span>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </li>
            @else
                <li class="widget__categories--sub__menu--list">
                    <a class="widget__categories--sub__menu--link d-flex align-items-center"
                        href="{{ route('products', ['category_id' => $p_category->id]) }}">
                        <img class="widget__categories--sub__menu--img rounded shadow"
                            src="{{ asset('images/category/' . $p_category->image) }}" alt="{{ $p_category->title }}">
                        <span class="widget__categories--sub__menu--text text-dark">{{ $p_category->title }}</span>
                    </a>
                </li>
            @endif
        @endforeach
        </ul>
        </li>
    @endif
@endforeach

@endif
</ul>
</div>
@endif
{{-- end --}}

<div style="position:sticky; top:20px;">
    <div class="single__widget price__filter widget__bg p-3">
        <h2 class="widget__title h5 mb-3">Filter Products</h2>
        <form class="price__filter--form" action="#" method="GET">

            {{-- <div class="mb-3">
                <label class="form-label">Price Range</label>
                <div id="price-slider" class="my-2"></div>

                <div class="d-flex justify-content-between mt-2">
                    <input type="number" id="min-price" name="min_price" class="form-control" placeholder="Min"
                        style="width:48%;">
                    <input type="number" id="max-price" name="max_price" class="form-control" placeholder="Max"
                        style="width:48%;">
                </div>

            </div> --}}
            <div class="filter-bottom">
                <span id="priceText">৳0 - ৳10000</span>
            </div>
            <div class="range-container">
                <input type="range" id="minRange" name="min" min="0" max="10000" value="0">
                <input type="range" id="maxRange" name="max" min="0" max="10000" value="10000">
            </div>



            <!-- Category -->
            <div class="mb-3">
                <a class="border rounded w-100 text-dark ps-3 py-2 d-block" data-bs-toggle="collapse"
                    href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseCategory">
                    Category
                </a>
                <div class="collapse mt-2" id="collapseCategory">
                    <div class="card card-body">
                        <ul class="list-unstyled">
                            <li>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" id="cat1" name="category[]" value="Men">
                                    <label for="cat1" class="ms-2">Men</label>
                                </div>
                                <ul class="list-unstyled ms-3">
                                    <li class="d-flex align-items-center "><input type="checkbox" id="cat1_sub1"
                                            name="category[]" value="Shirts"><label for="cat1_sub1"
                                            class="ms-2">Shirts</label></li>
                                    <li class="d-flex align-items-center "><input type="checkbox" id="cat1_sub2"
                                            name="category[]" value="Pants"><label for="cat1_sub2"
                                            class="ms-2">Pants</label></li>
                                </ul>
                            </li>
                            <li class="d-flex align-items-center ">
                                <input type="checkbox" id="cat2" name="category[]" value="Women">
                                <label for="cat2" class="ms-2">Women</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Size -->
            <div class="mb-3">
                <a class="border rounded w-100 text-dark ps-3 py-2 d-block" data-bs-toggle="collapse"
                    href="#collapseSize" role="button" aria-expanded="false" aria-controls="collapseSize">
                    Size
                </a>
                <div class="collapse mt-2" id="collapseSize">
                    <div class="card card-body">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center "><input type="checkbox" name="size[]"
                                    id="size_s" value="S"><label for="size_s" class="ms-2">S</label>
                            </li>
                            <li class="d-flex align-items-center "><input type="checkbox" name="size[]"
                                    id="size_m" value="M"><label for="size_m" class="ms-2">M</label>
                            </li>
                            <li class="d-flex align-items-center "><input type="checkbox" name="size[]"
                                    id="size_l" value="L"><label for="size_l" class="ms-2">L</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Color -->
            <div class="mb-3">
                <a class="border rounded w-100 text-dark ps-3 py-2 d-block" data-bs-toggle="collapse"
                    href="#collapseColor" role="button" aria-expanded="false" aria-controls="collapseColor">
                    Color
                </a>
                <div class="collapse mt-2" id="collapseColor">
                    <div class="card card-body">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center "><input type="checkbox" name="color[]"
                                    id="color_red" value="Red"><label for="color_red" class="ms-2">Red</label>
                            </li>
                            <li class="d-flex align-items-center "><input type="checkbox" name="color[]"
                                    id="color_blue" value="Blue"><label for="color_blue"
                                    class="ms-2">Blue</label></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Brand -->
            <div class="mb-3">
                <a class="border rounded w-100 text-dark ps-3 py-2 d-block" data-bs-toggle="collapse"
                    href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                    Brand
                </a>
                <div class="collapse mt-2" id="collapseBrand">
                    <div class="card card-body">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center "><input type="checkbox" name="brand[]"
                                    id="brand1" value="Brand A"><label for="brand1" class="ms-2">Brand
                                    A</label></li>
                            <li class="d-flex align-items-center "><input type="checkbox" name="brand[]"
                                    id="brand2" value="Brand B"><label for="brand2" class="ms-2">Brand
                                    B</label></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Fits -->
            <div class="mb-3">
                <a class="border rounded w-100 text-dark ps-3 py-2 d-block" data-bs-toggle="collapse"
                    href="#collapseFits" role="button" aria-expanded="false" aria-controls="collapseFits">
                    Fits
                </a>
                <div class="collapse mt-2" id="collapseFits">
                    <div class="card card-body">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center "><input type="checkbox" name="fits[]"
                                    id="fit_regular" value="Regular"><label for="fit_regular"
                                    class="ms-2">Regular</label></li>
                            <li class="d-flex align-items-center "><input type="checkbox" name="fits[]"
                                    id="fit_slim" value="Slim"><label for="fit_slim" class="ms-2">Slim</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Fabrication -->
            <div class="mb-3">
                <a class="border rounded w-100 text-dark ps-3 py-2 d-block" data-bs-toggle="collapse"
                    href="#collapseFabric" role="button" aria-expanded="false" aria-controls="collapseFabric">
                    Fabrication
                </a>
                <div class="collapse mt-2" id="collapseFabric">
                    <div class="card card-body">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center "><input type="checkbox" name="fabrication[]"
                                    id="fab_cotton" value="Cotton"><label for="fab_cotton"
                                    class="ms-2">Cotton</label></li>
                            <li class="d-flex align-items-center "><input type="checkbox" name="fabrication[]"
                                    id="fab_poly" value="Polyester"><label for="fab_poly"
                                    class="ms-2">Polyester</label></li>
                        </ul>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary w-100 mt-2" type="submit">Apply Filters</button>
        </form>
    </div>
</div>

{{-- <script>
    var slider = document.getElementById('price-slider');

    noUiSlider.create(slider, {
        start: [0, 5000], // initial min & max
        connect: true, // shows the range between handles
        range: {
            'min': 0,
            'max': 10000
        },
        step: 100, // increment
        tooltips: [true, true],
    });

    var minInput = document.getElementById('min-price');
    var maxInput = document.getElementById('max-price');

    slider.noUiSlider.on('update', function(values, handle) {
        if (handle === 0) {
            minInput.value = Math.round(values[0]);
        } else {
            maxInput.value = Math.round(values[1]);
        }
    });

    minInput.addEventListener('change', function() {
        slider.noUiSlider.set([this.value, null]);
    });

    maxInput.addEventListener('change', function() {
        slider.noUiSlider.set([null, this.value]);
    });
</script> --}}

<script>
    const minRange = document.getElementById("minRange");
    const maxRange = document.getElementById("maxRange");
    const priceText = document.getElementById("priceText");

    const maxValue = 10000;
    const minGap = 500;

    function updateRange(event) {
        let min = parseInt(minRange.value);
        let max = parseInt(maxRange.value);

        if (event.target === minRange && min > max - minGap) {
            min = max - minGap;
            minRange.value = min;
        }

        if (event.target === maxRange && max < min + minGap) {
            max = min + minGap;
            maxRange.value = max;
        }

        priceText.textContent = `৳${min} - ৳${max}`;
    }

    minRange.addEventListener("input", updateRange);
    maxRange.addEventListener("input", updateRange);

    // Initialize text
    updateRange({ target: minRange });
</script>