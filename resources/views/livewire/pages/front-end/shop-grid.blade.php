<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Variation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $category_id = 'all';
    public $sub_category_id = 'all';
    public $variation_id = 'all';
    public $subcategories = [];
    public $variations = [];
    public $products;
    public $categories;
    public $lower_price;
    public $upper_price;
    public $useSpecificVariations = false;
    public $specific_variations;
    public $totalVariations;
    public $filterBy = '';


    /**
     * On mount, initialize categories and products,
     * and filter products using the category_id and product_id if set.
     */
    public function mount($category_id, $product_id)
    {
        $this->categories = Category::inRandomOrder()->get();
        $this->products = Product::with('product_variations')->inRandomOrder()->get();

        if ($category_id != 0) {
            $this->category_id = $category_id;
            if ($product_id != 0) {
                $this->sub_category_id = $product_id;
            }
            $this->filter();
        }

        $this->totalVariations = ProductVariation::whereIn('product_id', $this->products->pluck('id'))->count();

    }

    /**
     * Gets subcategories for the selected category, if any,
     * and filters products.
     */
    public function getSubCategories()
    {
        $this->reset('subcategories', 'variations', 'sub_category_id');

        if ($this->category_id != 'all') {
            $category = Category::find($this->category_id);
            $subcategories = Product::where('category_id', $category->id);

            $this->subcategories = $subcategories->count() < 2 ? [] : $subcategories->get();
            $this->getVariations($category->slug);
        }

        $this->filter();
    }

    /**
     * Get variations for the products if any.
     */
    public function getVariations($slug)
    {
        $this->reset('variations');

        switch ($slug) {
            case 'wall_carpet':
                $this->variations = Variation::where('name', 'color_shade')->get();
                break;
            case 'grass_carpet':
                $this->variations = Variation::where('name', 'height')->get();
                break;
            case 'curtain_rods':
                $this->variations = Variation::whereIn('name', ['durability', 'origin'])->get();
                break;
        }
    }


    /**
     * Filters displayed products based on category, subcategory, variation, price, etc.
     */
    public function filter()
    {
        $productsQuery = Product::query();
        $productsQuery = $this->applyCategoryFilter($productsQuery);
        $productsQuery = $this->applySubCategoryFilter($productsQuery);
        $productsQuery = $this->applyVariationFilter($productsQuery);
        $productsQuery = $this->applyPriceFilter($productsQuery);

        // Apply random order only if filterBy is not 'asc_price' or 'desc_price'
        if ($this->filterBy !== 'asc_price' && $this->filterBy !== 'desc_price') {
            $productsQuery->inRandomOrder();
        }

        if ($this->filterBy === 'new') {
            if ($this->filterBy === 'new') {
                $productsQuery->join('product_variations', 'products.id', '=', 'product_variations.product_id')
                    ->where('product_variations.created_at', '>=', now()->subHours(24))
                    ->select('products.*')
                    ->distinct();
            }
        }

        // Get the products and their IDs
        $products = $productsQuery->get();
        $productIds = $products->pluck('id');

        $this->totalVariations = ProductVariation::whereIn('product_id', $productIds)->count();


        if ($this->filterBy === 'discounted') {
            $this->totalVariations = ProductVariation::where('discount_percentage', '!=', 0)->count();
        }

        $this->products = $products;
    }


    /**
     * Apply category filter.
     */
    private function applyCategoryFilter($query)
    {
        if (($this->category_id != 'all') && ($this->category_id != 0)) {
            $query->where('category_id', $this->category_id);
        }

        return $query;
    }

    /**
     * Apply subcategory filter.
     */
    private function applySubCategoryFilter($query)
    {
        if (($this->sub_category_id != 'all') && ($this->sub_category_id != 0)) {
            $query->where('id', $this->sub_category_id);
        }

        return $query;
    }

    /**
     * Apply variation filter.
     */
    private function applyVariationFilter($query)
    {
        if ($this->variation_id != 'all') {
            $this->useSpecificVariations = true;

            $query->whereHas('product_variations', function ($q) {
                $q->where('variation_id', $this->variation_id);
            });

            $this->specific_variations = ProductVariation::where('id', $this->variation_id)->inRandomOrder()->get();
        }

        return $query;
    }

    /**
     * Apply price filter.
     */
    private function applyPriceFilter($query)
    {
        if ($this->lower_price || $this->upper_price) {
            $query->whereHas('product_variations', function ($q) {
                if ($this->lower_price) {
                    $q->where('price', '>=', $this->lower_price);
                }
                if ($this->upper_price) {
                    $q->where('price', '<=', $this->upper_price);
                }
            });
        }

        if ($this->filterBy == 'asc_price') {
            $query->with(['product_variations' => function ($q) {
                $q->orderBy('price', 'asc');
            }]);
        }

        if ($this->filterBy == 'desc_price') {
            $query->with(['product_variations' => function ($q) {
                $q->orderBy('price', 'desc');
            }]);
        }

        if ($this->filterBy == 'discounted') {
            $query->with(['product_variations' => function ($q) {
                $q->where('discount_percentage', '!=', 0);
            }]);
        }

        return $query;
    }

    /**
     * Update category ID and get subcategories.
     */
    #[On('update-category-id')]
    public function updateCategoryId($category_id)
    {
        $this->category_id = $category_id;
        $this->getSubCategories();
    }

    /**
     * Update subcategory ID and filter products.
     */
    #[On('update-sub-category-id')]
    public function updateSubCategoryId($sub_category_id)
    {
        $this->reset('variation_id');
        $this->sub_category_id = $sub_category_id;
        $this->filter();
    }

    /**
     * Update variation ID and filter products.
     */
    #[On('update-variation-id')]
    public function updateVariationId($variation_id)
    {
        $this->variation_id = $variation_id;
        $this->filter();
    }


}; ?>

@push('css')
    <style>
        .loader, .loader:before, .loader:after {
            border-radius: 50%;
            width: 2.5em;
            height: 2.5em;
            animation-fill-mode: both;
            animation: bblFadInOut 1.8s infinite ease-in-out;
        }

        .loader {
            color: rgb(40, 50, 60);
            font-size: 3px;
            position: relative;
            text-indent: -9999em;
            transform: translateZ(0);
            animation-delay: -0.16s;
        }

        .loader:before,
        .loader:after {
            content: '';
            position: absolute;
            top: 0;
        }

        .loader:before {
            left: -3.5em;
            animation-delay: -0.32s;
        }

        .loader:after {
            left: 3.5em;
        }

        @keyframes bblFadInOut {
            0%, 80%, 100% {
                box-shadow: 0 2.5em 0 -1.3em
            }
            40% {
                box-shadow: 0 2.5em 0 0
            }
        }
    </style>
@endpush

<!--start page content-->
<div class="page-content">

    <!--start breadcrumb-->
    <div class="py-4 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class=""><a class="text-decoration-none" href="javascript:;">Home <i
                                class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class=""><a class="text-decoration-none" href="javascript:;">Shop <i
                                class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class="text-decoration-none active" aria-current="page">Shop With Grid</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->


    <!--start product grid-->
    <section class="section-padding">
        <h5 class="mb-0 fw-bold d-none">Product Grid</h5>
        <div class="container">
            <div class="btn btn-dark btn-ecomm d-xl-none position-fixed top-50 start-0 translate-middle-y"
                 data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarFilter"><span><i
                        class="bi bi-funnel me-1"></i> Filters</span></div>
            <div class="row">
                <div class="col-12 col-xl-3 filter-column">
                    <nav class="navbar navbar-expand-xl flex-wrap p-0">
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarFilter"
                             aria-labelledby="offcanvasNavbarFilterLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title mb-0 fw-bold" id="offcanvasNavbarFilterLabel">Filters</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="filter-sidebar">
                                    <div class="card rounded-0">
                                        <div class="card-header d-none d-xl-block bg-transparent">
                                            <h5 class="mb-0 fw-bold">Filters</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="p-1 fw-bold bg-light">Categories</h6>
                                            <div class="categories">
                                                <div class="categories-wrapper h-auto p-1">
                                                    <div class="form-check">
                                                        <input wire:click="getSubCategories"
                                                               class="form-check-input category" type="checkbox"
                                                               value="all"
                                                               id="all">
                                                        <label class="form-check-label" for="all}">
                                                            <span>All</span>
                                                        </label>
                                                    </div>
                                                    @foreach($categories as $category)
                                                        <div class="form-check">
                                                            <input class="form-check-input category" type="checkbox"
                                                                   value="{{ $category->id }}"
                                                                   id="{{ $category->slug }}">
                                                            <label class="form-check-label" for="{{ $category->slug }}">
                                                                <span>{{ $category->name }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="subcategories">
                                                <h6 class="p-1 fw-bold bg-light">SubCategories</h6>
                                                <div wire:loading class="form-check">
                                                    <span class="loader"></span>
                                                </div>
                                                <div class="brands-wrapper h-auto p-1">
                                                    @forelse($subcategories as $subcategory)
                                                        <div wire:loading.remove class="form-check">
                                                            <input
                                                                class="form-check-input subcategory" type="checkbox"
                                                                value="{{ $subcategory->id }}"
                                                                id="">
                                                            <label class="form-check-label"
                                                                   for="">
                                                                <span>{{ $subcategory->name }}</span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <div wire:loading.remove>
                                                            <p>No Sub Categories</p>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="Price">
                                                <h6 class="p-1 fw-bold bg-light">Price (KES)</h6>
                                                <div class="Price-wrapper p-1">
                                                    <div class="input-group">
                                                        <input type="number" wire:model="lower_price"
                                                               class="form-control rounded-0"
                                                               placeholder="1000">
                                                        <span class="input-group-text bg-section-1 border-0">-</span>
                                                        <input type="number" wire:model="upper_price"
                                                               class="form-control rounded-0"
                                                               placeholder="10000">
                                                        <button type="button" wire:click="filter"
                                                                class="btn btn-outline-dark rounded-0 ms-2"><i
                                                                class="bi bi-chevron-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="colors">
                                                <h6 class="p-1 fw-bold bg-light">Variations</h6>
                                                <div class="color-wrapper h-auto p-1">
                                                    <div wire:loading class="form-check">
                                                        <span class="loader"></span>
                                                    </div>
                                                    @forelse($variations as $variation)
                                                        <div wire:loading.remove class="form-check">
                                                            <input class="form-check-input variation" type="checkbox"
                                                                   value="{{ $variation->id }}"
                                                                   id="variation">
                                                            <label class="form-check-label" for="variation">
                                                                <span>{{ $variation->value }}</span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <div wire:loading.remove>
                                                            <p>No Variation</p>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-12 col-xl-9">
                    <div class="shop-right-sidebar">
                        <div class="card rounded-0">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center justify-content-between bg-light p-2">
                                    <div class="product-count">{{ $totalVariations }} Items Found</div>
                                    <form>
                                        <div class="input-group">
                                            <span
                                                class="input-group-text bg-transparent rounded-0 border-0">Sort By</span>
                                            <select wire:change="filter" wire:model="filterBy"
                                                    class="form-select rounded-0">
                                                <option selected value="">All Products</option>
                                                <option value="new">New Products</option>
                                                <option value="discounted">Discounted</option>
                                                <option value="desc_price">Price : Hight to Low</option>
                                                <option value="asc_price">Price : Low to Hight</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="product-grid mt-4">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @forelse($products as $product)
                                    @if($useSpecificVariations)
                                        @foreach($specific_variations as $product_variation)
                                            <div class="col">
                                                <div class="card border shadow-none">
                                                    <div class="position-relative overflow-hidden">
                                                        <a href="{{ route('front-end.product-details',$product_variation->id) }}">
                                                            @if($product_variation->images()->isNotEmpty())
                                                                <img
                                                                    src="{{ asset('storage/' . $product_variation->images()[0]->image_url) }}"
                                                                    class="card-img-top"
                                                                    alt="{{ $product_variation->name }}">
                                                            @else
                                                                <img
                                                                    src="{{ asset('front-end-assets/images/categories/wall_to_wall_carpets.png') }}"
                                                                    class="card-img-top" alt="No image available">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="card-body border-top">
                                                        <a style="text-decoration:none;" href="{{ route('front-end.product-details',$product_variation->id) }}">
                                                        <h5 class="mb-0 fw-bold product-short-title">{{ $product->name }} </h5>
                                                        @if(!empty($product_variation->variation()))
                                                            @if($product_variation->variation()->name == 'other')
                                                                <h6 class="mb-1"> {{ $product_variation->custom_variation }}</h6>
                                                            @else
                                                                <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                            @endif
                                                        @endif
                                                        @if($product_variation->discount_percentage != 0)
                                                            @php
                                                                $originalPrice = $product_variation->price / (1 - ($product_variation->discount_percentage / 100));
                                                            @endphp
                                                            <div style="margin-bottom:-2px;"
                                                                 class="d-flex align-items-center gap-3">
                                                                <div
                                                                    class="h6 fw-light text-muted text-decoration-line-through">
                                                                    {{ number_format($originalPrice, 2) }}
                                                                </div>
                                                                <div class="h6 fw-bold text-danger">
                                                                    ({{ $product_variation->discount_percentage }}% off)
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="product-price d-flex align-items-center gap-2">
                                                            <div class="h6 fw-bold">
                                                                KES {{ $product_variation->price }}
                                                            </div>
                                                            <div style="width:60%;">
                                                                @php
                                                                    $variationText = '';

                                                                     if(!empty($product_variation->variation())){
                                                                         $variationText = str_replace('_', ' ', $product_variation->variation()->name) . '-' . $product_variation->variation()->value;
                                                                           if($product_variation->variation() == 'other'){
                                                                             $variationText = $product_variation->custom_variation;
                                                                           }
                                                                      }

                                                                    $fullProductName = $product->name.' '.$variationText;
                                                                    $productDetailsUrl = route('front-end.product-details', $product_variation->id);

                                                                    // Message text with product name and line break
                                                                    $whatsappMessage = 'Hello, I want to purchase: *' . $fullProductName . '*';
                                                                    // Append URL on a new line using %0A
                                                                    $whatsappMessage .= '. Here is the product link: ' . $productDetailsUrl;
                                                                @endphp

                                                                <a target="_blank"
                                                                   style="font-size:13px; background-color:green; border-radius: 30px !important; font-weight:bold;"
                                                                   @if(($product->category_id == '4') || ($product->category_id == '5'))
                                                                   href="https://api.whatsapp.com/send?phone=254796052958&text={{ urlencode($whatsappMessage) }}"
                                                                   @else
                                                                   href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                                   @endif                                                                   class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                                    <i class='bx bxl-whatsapp fs-5'></i> Buy on WhatsApp
                                                                </a>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach($product->product_variations as $product_variation)
                                            <div class="col">
                                                <div class="card border shadow-none">
                                                    <div class="position-relative overflow-hidden">
                                                        <a href="{{ route('front-end.product-details', $product_variation->id) }}">
                                                            @if($product_variation->images()->isNotEmpty())
                                                                <img
                                                                    src="{{ asset('storage/' . $product_variation->images()[0]->image_url) }}"
                                                                    class="card-img-top"
                                                                    alt="{{ $product_variation->name }}">
                                                            @else
                                                                <img
                                                                    src="{{ asset('front-end-assets/images/categories/wall_to_wall_carpets.png') }}"
                                                                    class="card-img-top" alt="No image available">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="card-body border-top">
                                                        <a style="text-decoration:none;" href="{{ route('front-end.product-details',$product_variation->id) }}">

                                                        <h5 class="mb-0 fw-bold product-short-title">{{ $product->name }} </h5>

                                                        @if(!empty($product_variation->variation()))
                                                            @if($product_variation->variation()->name == 'other')
                                                                <h6 class="mb-1"> {{ $product_variation->custom_variation }}</h6>
                                                            @else
                                                                <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                            @endif
                                                        @endif

                                                        @if($product_variation->discount_percentage != 0)
                                                            @php
                                                                $originalPrice = $product_variation->price / (1 - ($product_variation->discount_percentage / 100));
                                                            @endphp
                                                            <div style="margin-bottom:-2px;"
                                                                 class="d-flex align-items-center gap-3">
                                                                <div
                                                                    class="h6 fw-light text-muted text-decoration-line-through">
                                                                    {{ number_format($originalPrice, 2) }}
                                                                </div>
                                                                <div class="h6 fw-bold text-danger">
                                                                    ({{ $product_variation->discount_percentage }}% off)
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="product-price d-flex align-items-center gap-2">
                                                            <div class="h6 fw-bold">
                                                                KES {{ $product_variation->price }}
                                                            </div>
                                                            <div style="width:60%;">
                                                                @php

                                                                    $variationText = '';

                                                                     if(!empty($product_variation->variation())){
                                                                          $variationText = str_replace('_', ' ', $product_variation->variation()->name) . '-' . $product_variation->variation()->value;
                                                                            if($product_variation->variation() == 'other'){
                                                                              $variationText = $product_variation->custom_variation;
                                                                            }
                                                                       }

                                                                    $fullProductName = $product->name.' '.$variationText;
                                                                    $productDetailsUrl = route('front-end.product-details', $product_variation->id);

                                                                    // Message text with product name and line break
                                                                    $whatsappMessage = 'Hello, I want to purchase: *' . $fullProductName . '*';
                                                                    // Append URL on a new line using %0A
                                                                    $whatsappMessage .= '. Here is the product link: ' . $productDetailsUrl;
                                                                @endphp

                                                                <a target="_blank"
                                                                   style="font-size:13px; background-color:green; border-radius: 30px !important; font-weight:bold;"
                                                                   @if(($product->category_id == '4') || ($product->category_id == '5'))
                                                                   href="https://api.whatsapp.com/send?phone=254796052958&text={{ urlencode($whatsappMessage) }}"
                                                                   @else
                                                                   href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                                   @endif                                                                   class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                                    <i class='bx bxl-whatsapp fs-5'></i> Buy on WhatsApp
                                                                </a>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @empty
                                    <div class="col-lg-12">
                                        <p> No Available Products</p>
                                    </div>
                                @endforelse
                            </div><!--end row-->
                        </div>
                        <hr class="my-4">
                        {{--                        <div class="product-pagination">--}}
                        {{--                            <nav>--}}
                        {{--                                <ul class="pagination justify-content-center">--}}
                        {{--                                    <li class="page-item disabled">--}}
                        {{--                                        <a class="page-link">Previous</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>--}}
                        {{--                                    <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>--}}
                        {{--                                    <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>--}}
                        {{--                                    <li class="page-item">--}}
                        {{--                                        <a class="page-link" href="javascript:;">Next</a>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </nav>--}}
                        {{--                        </div>--}}

                    </div>
                </div>
            </div><!--end row-->


        </div>
    </section>
    <!--start product details-->
</div>
<!--end page content-->

@push('js')
    <script data-navigate-once>
        $(document).ready(function () {
            document.addEventListener("livewire:navigated", function () {
                $('.category').on('click', function () {
                    if ($(this).prop('checked')) {
                        $('.category').not(this).prop('checked', false);
                        $('.subcategory').prop('checked', false);
                        $('.variation').prop('checked', false);
                        Livewire.dispatch('update-category-id', {category_id: $(this).val()});
                    }
                });

                $(document).on('click', '.subcategory', function () {
                    if ($(this).prop('checked')) {
                        $('.subcategory').not(this).prop('checked', false);
                        $('.variation').prop('checked', false);
                        Livewire.dispatch('update-sub-category-id', {sub_category_id: $(this).val()});
                    }
                });

                $(document).on('click', '.variation', function () {
                    if ($(this).prop('checked')) {
                        $('.variation').not(this).prop('checked', false);
                        Livewire.dispatch('update-variation-id', {variation_id: $(this).val()});
                    }
                });
            });
        });
    </script>
@endpush

