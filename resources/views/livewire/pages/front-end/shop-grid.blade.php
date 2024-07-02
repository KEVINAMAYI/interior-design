<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Variation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $category_id = 'all';
    public $sub_category_id = 'all';
    public $subcategories = [];
    public $variations = [];
    public $products;
    public $categories;
    public $lower_price;
    public $upper_price;

    /**
     * On Mount initialize categories and products,
     * if a specific category and product are set
     * filter the products using the category_id and product_id
     */
    public function mount($category_id, $product_id)
    {
        $this->categories = Category::all();
        $this->products = Product::all();

        if ($category_id != 0) {
            $this->category_id = $category_id;
            if ($product_id != 0) {
                $this->sub_category_id = $product_id;
            }
            $this->filter();
        }
    }


    /**
     * Gets Subcategories for the selected category  if any
     * and filters products
     */
    public function getSubCategories()
    {
        $this->reset('subcategories', 'variations', 'sub_category_id');

        if ($this->category_id != 'all') {

            $category = Category::where('id', $this->category_id)->first();
            $subcategories = Product::where('category_id', $category->id);

            $subcategories->count() < 2 ?
                $this->reset('subcategories') :
                $this->subcategories = $subcategories->get();

            $this->getVariations($category->slug);
        }

        $this->filter();
    }


    /**
     * Get Variations for the products if  any
     */
    public function getVariations($slug)
    {
        $this->reset('variations');

        if ($slug == 'wall_carpet') {
            $this->variations = Variation::where('name', 'color_shade')->get();
        }

        if ($slug == 'grass_carpet') {
            $this->variations = Variation::where('name', 'height')->get();
        }

        if ($slug == 'curtain_rods') {
            $this->variations = Variation::where('name', 'durability')->orWhere('name', 'origin')->get();
        }
    }


    /**
     * Filters displayed products base on category
     * subcategory, color, price etc...
     */
    public function filter()
    {
        $products = Product::orderBy('created_at', 'desc');

        if (!empty($this->category_id) && $this->category_id != 'all') {
            $products->where('category_id', $this->category_id);
        }

        if (!empty($this->sub_category_id) && $this->sub_category_id != 'all') {
            $products->where('id', $this->sub_category_id);
        }

        if (!empty($this->lower_price)) {
            $products->WhereHas('product_variations', function ($q) {
                $q->where('price', '>=', $this->lower_price);
            })->get();
        }

        if (!empty($this->upper_price)) {
            $products->WhereHas('product_variations', function ($q) {
                $q->where('price', '<=', $this->upper_price);
            })->get();
        }

        if (!empty($this->lower_price) && !empty($this->upper_price)) {
            $products->WhereHas('product_variations', function ($q) {
                $q->where('price', '>=', $this->lower_price)
                    ->where('price', '<=', $this->upper_price);
            })->get();
        }

        $this->products = $products->get();

    }

    #[On('update-category-id')]
    public function updateCategoryId($category_id)
    {
        $this->category_id = $category_id;
        $this->getSubCategories();
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
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop With Grid</li>
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
                                                            <span>All</span><span
                                                                class="product-number">(1548)</span>
                                                        </label>
                                                    </div>
                                                    @foreach($categories as $category)
                                                        <div class="form-check">
                                                            <input class="form-check-input category" type="checkbox"
                                                                   value="{{ $category->id }}"
                                                                   id="{{ $category->slug }}">
                                                            <label class="form-check-label" for="{{ $category->slug }}">
                                                                <span>{{ $category->name }}</span><span
                                                                    class="product-number">(1548)</span>
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
                                                                value=""
                                                                id="">
                                                            <label class="form-check-label"
                                                                   for="">
                                                                <span>{{ $subcategory->name }}</span><span
                                                                    class="product-number">(1548)</span>
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
                                                                   value=""
                                                                   id="chekColor1">
                                                            <label class="form-check-label" for="chekColor1">
                                                                <span>{{ $variation->value }}</span><span
                                                                    class="product-number">(1548)</span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <div wire:loading.remove>
                                                            <p>No Variation</p>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="discount">
                                                <h6 class="p-1 fw-bold bg-light">Discount Range</h6>
                                                <div class="discount-wrapper p-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option1" id="chekDisc1">
                                                        <label class="form-check-label" for="chekDisc1">
                                                            10% and Above
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option2" id="chekDisc2">
                                                        <label class="form-check-label" for="chekDisc2">
                                                            20% and Above
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option3" id="chekDisc3">
                                                        <label class="form-check-label" for="chekDisc3">
                                                            30% and Above
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option4" id="chekDisc4">
                                                        <label class="form-check-label" for="chekDisc4">
                                                            40% and Above
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option5" id="chekDisc5">
                                                        <label class="form-check-label" for="chekDisc5">
                                                            50% and Above
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option6" id="chekDisc6">
                                                        <label class="form-check-label" for="chekDisc6">
                                                            60% and Above
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option7" id="chekDisc7">
                                                        <label class="form-check-label" for="chekDisc7">
                                                            70% and Above
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="exampleRadios"
                                                               type="radio" value="option8" id="chekDisc8">
                                                        <label class="form-check-label" for="chekDisc8">
                                                            80% and Above
                                                        </label>
                                                    </div>
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
                                    <div class="product-count">657 Items Found</div>
                                    <div class="view-type hstack gap-2 d-none d-xl-flex">
                                        <p class="mb-0">Grid</p>
                                        <div>
                                            <a href="shop-grid.html" class="grid-type-3 d-flex gap-1 active">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </a>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="input-group">
                                            <span
                                                class="input-group-text bg-transparent rounded-0 border-0">Sort By</span>
                                            <select class="form-select rounded-0">
                                                <option selected>Whats'New</option>
                                                <option value="1">Popularity</option>
                                                <option value="2">Better Discount</option>
                                                <option value="3">Price : Hight to Low</option>
                                                <option value="4">Price : Low to Hight</option>
                                                <option value="5">Custom Rating</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="product-grid mt-4">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @forelse($products as $product)
                                    @foreach($product->product_variations as $product_variation)
                                        <div class="col">
                                            <div class="card border shadow-none">
                                                <div class="position-relative overflow-hidden">
                                                    <div
                                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                                        <a href="javascript:;"><i class="bi bi-zoom-in"></i></a>
                                                    </div>
                                                    <a href="{{ route('front-end.product-details') }}">
                                                        <img src="front-end-assets/images/trending-product/01.webp"
                                                             class="card-img-top" alt="...">
                                                    </a>
                                                </div>
                                                <div class="card-body border-top">
                                                    <h5 class="mb-0 fw-bold product-short-title">{{ $product->name }} </h5>
                                                    <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                    {{--                                                    <p class="mb-0 product-short-name">{{ $product->description }}</p>--}}
                                                    <div class="product-price d-flex align-items-center gap-2 mt-2">
                                                        <div class="h6 fw-bold">
                                                            KES {{ $product_variation->price }}</div>
                                                        <div
                                                            class="h6 fw-light text-muted text-decoration-line-through">
                                                            $2089
                                                        </div>
                                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @empty
                                    <div class="col-lg-12">
                                        <p> No Available Products</p>
                                    </div>
                                @endforelse
                            </div><!--end row-->
                        </div>

                        <hr class="my-4">

                        <div class="product-pagination">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:;">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

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
                console.log('test');
                $('.category').on('click', function () {
                    if ($(this).prop('checked')) {
                        $('.category').not(this).prop('checked', false);
                        Livewire.dispatch('update-category-id', {category_id: $(this).val()});
                    }
                });
            });
        });
    </script>
@endpush

