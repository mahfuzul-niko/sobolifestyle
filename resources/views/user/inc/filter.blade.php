<!-- Category -->
<div class="mb-3">
    <a class="border rounded w-100 text-dark px-3 py-2 d-flex justify-content-between align-items-center"
        data-bs-toggle="collapse" href="#collapseCategory" role="button"
        aria-expanded="{{ request('category_id') ? 'true' : 'false' }}" aria-controls="collapseCategory">
        Category
        <span class="icon-plus">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </span>
    </a>
    <div class="collapse mt-2 {{ request('category_id') ? 'show' : '' }}" id="collapseCategory">
        <div class="card card-body">
            <ul class="list-unstyled">
                @foreach ($categories as $category)
                    <li>
                        <label class="d-flex align-items-center mb-2 cursor-pointer">
                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                {{ in_array($category->id, (array) request('category_id')) ? 'checked' : '' }}>
                            <span class="ms-2">{{ $category->title }}</span>
                        </label>


                        @if ($category->child->count() > 0)
                            <ul class="list-unstyled ms-3">
                                @foreach ($category->child as $child)
                                    <li>
                                        <label class="d-flex align-items-center mb-2 cursor-pointer">
                                            <input type="checkbox" id="cat{{ $child->id }}" name="category_id[]"
                                                value="{{ $child->id }}"
                                                {{ in_array($child->id, (array) request('category_id')) ? 'checked' : '' }}>
                                            <span class="ms-2">{{ $child->title }}</span>
                                        </label>

                                        @if ($child->child->count() > 0)
                                            @include('partials.category-children', [
                                                'children' => $child->child,
                                                'selected' => request('category_id', []),
                                            ])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

</div>
<!-- Size -->
<div class="mb-3">
    <a class="border rounded w-100 text-dark px-3 py-2 d-flex justify-content-between align-items-center"
        data-bs-toggle="collapse" href="#collapseSize" role="button"
        aria-expanded="{{ request('size') ? 'true' : 'false' }}" aria-controls="collapseSize">
        Size
        <span class="icon-plus">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </span>
    </a>
    <div class="collapse mt-2 {{ request('size') ? 'show' : '' }}" id="collapseSize">

        <div class="card card-body">
            <ul class="list-unstyled">
                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="size[]" value="S"
                            {{ in_array('S', (array) request('size')) ? 'checked' : '' }}>
                        <span class="ms-2">S</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="size[]" value="M"
                            {{ in_array('M', (array) request('size')) ? 'checked' : '' }}>
                        <span class="ms-2">M</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="size[]" value="L"
                            {{ in_array('L', (array) request('size')) ? 'checked' : '' }}>
                        <span class="ms-2">L</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="size[]" value="XL"
                            {{ in_array('XL', (array) request('size')) ? 'checked' : '' }}>
                        <span class="ms-2">XL</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="size[]" value="XXL"
                            {{ in_array('XXL', (array) request('size')) ? 'checked' : '' }}>
                        <span class="ms-2">XXL</span>
                    </label>
                </li>


            </ul>
        </div>
    </div>
</div>
<!-- Color -->
<div class="mb-3">
    <a class="border rounded w-100 text-dark px-3 py-2 d-flex justify-content-between align-items-center"
        data-bs-toggle="collapse" href="#collapseColor" role="button"
        aria-expanded="{{ request('color_id') ? 'true' : 'false' }}" aria-controls="collapseColor">
        Color
        <span class="icon-plus">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </span>
    </a>
    <div class="collapse mt-2 {{ request('color_id') ? 'show' : '' }}" id="collapseColor">

        <div class="card card-body">
            <ul class="list-unstyled">
                @foreach ($colors as $color)
                    <li class="mb-2">
                        <label class="d-flex align-items-center cursor-pointer">
                            <input type="checkbox" name="color_id[]" value="{{ $color->id }}"
                                {{ in_array($color->id, (array) request('color_id')) ? 'checked' : '' }}>
                            <span class="ms-2">{{ $color->name }}</span>
                        </label>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>

<!-- Brand -->
<div class="mb-3">
    <a class="border rounded w-100 text-dark px-3 py-2 d-flex justify-content-between align-items-center"
        data-bs-toggle="collapse" href="#collapseBrand" role="button"
        aria-expanded="{{ request('brand_id') ? 'true' : 'false' }}" aria-controls="collapseBrand">
        Brand
        <span class="icon-plus">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus" viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </span>
    </a>
    <div class="collapse mt-2 {{ request('brand_id') ? 'show' : '' }}" id="collapseBrand">

        <div class="card card-body">
            <ul class="list-unstyled">
                @foreach ($brands as $brand)
                    <li class="mb-2">
                        <label class="d-flex align-items-center cursor-pointer">
                            <input type="checkbox" name="brand_id[]" value="{{ $brand->id }}"
                                {{ in_array($brand->id, (array) request('brand_id')) ? 'checked' : '' }}>
                            <span class="ms-2">{{ $brand->title }}</span>
                        </label>
                    </li>
                @endforeach


            </ul>
        </div>
    </div>
</div>

<!-- Fits -->
<div class="mb-3">
    <a class="border rounded w-100 text-dark px-3 py-2 d-flex justify-content-between align-items-center"
        data-bs-toggle="collapse" href="#collapseFits" role="button"
        aria-expanded="{{ request('fits') ? 'true' : 'false' }}" aria-controls="collapseFits">
        Fits
        <span class="icon-plus">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus" viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </span>
    </a>
    <div class="collapse mt-2 {{ request('fits') ? 'show' : '' }}" id="collapseFits">

        <div class="card card-body">
            <ul class="list-unstyled">
                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="fits[]" value="regular_fit"
                            {{ in_array('regular_fit', (array) request('fits')) ? 'checked' : '' }}>
                        <span class="ms-2">Regular</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="fits[]" value="slim_fit"
                            {{ in_array('slim_fit', (array) request('fits')) ? 'checked' : '' }}>
                        <span class="ms-2">Slim</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="fits[]" value="tapered_fit"
                            {{ in_array('tapered_fit', (array) request('fits')) ? 'checked' : '' }}>
                        <span class="ms-2">Tapered</span>
                    </label>
                </li>


            </ul>
        </div>
    </div>
</div>

<!-- Fabrication -->
<div class="mb-3">
    <a class="border rounded w-100 text-dark px-3 py-2 d-flex justify-content-between align-items-center"
        data-bs-toggle="collapse" href="#collapseFabric" role="button"
        aria-expanded="{{ request('fabrication') ? 'true' : 'false' }}" aria-controls="collapseFabric">
        Fabrication
        <span class="icon-plus">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus" viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </span>
    </a>
    <div class="collapse mt-2 {{ request('fabrication') ? 'show' : '' }}" id="collapseFabric">

        <div class="card card-body">
            <ul class="list-unstyled">
                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="fabrication[]" value="knit"
                            {{ in_array('knit', (array) request('fabrication')) ? 'checked' : '' }}>
                        <span class="ms-2">Knit</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="fabrication[]" value="woven"
                            {{ in_array('woven', (array) request('fabrication')) ? 'checked' : '' }}>
                        <span class="ms-2">Woven</span>
                    </label>
                </li>

                <li class="mb-2">
                    <label class="d-flex align-items-center cursor-pointer">
                        <input type="checkbox" name="fabrication[]" value="jersey"
                            {{ in_array('jersey', (array) request('fabrication')) ? 'checked' : '' }}>
                        <span class="ms-2">Jersey</span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</div>
