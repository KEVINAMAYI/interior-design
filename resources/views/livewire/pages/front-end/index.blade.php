<?php

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {


    public $featured_products;
    public $new_arrival_products;
    public $latest_products;
    public $best_seller_products;
    public $trending_products;
    public $special_offer_products;
    public $categories;

    public function mount()
    {
        $products = Product::query();
        $this->featured_products = $this->getProductsByTag($products, 'featured_products');
        $this->new_arrival_products = $this->getProductsByTag($products, 'new_arrivals');
        $this->latest_products = $this->getProductsByTag($products, 'latest_products');
        $this->best_seller_products = $this->getProductsByTag($products, 'best_seller');
        $this->trending_products = $this->getProductsByTag($products, 'trending');
        $this->special_offer_products = $this->getProductsByTag($products, 'special_offer');
        $this->categories = Category::all();
    }

    public function getProductsByTag($products, $tag)
    {

        return $products->whereHas('tags', function ($q) use ($tag) {
            $q->where('slug', 'like', $tag);
        })->get();
    }

}; ?>

<!--start page content-->
<div class="page-content">

    <!--start carousel-->
    <section class="slider-section">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active bg-primary">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="">
                                <h1 class="h1 text-white fw-bold">GSM Interior LTD</h1>
                                <h3 class="h3 fw-light text-white fw-bold">Quality and Perfection</h3>
                                <div class=""><a style="background-color: rgb(237,126,39); font-weight:bold;"
                                                 class="btn btn-lg text-white  mt-3 btn-ecomm" href="shop-grid.html">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_1.png" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
                <div class="carousel-item bg-purple">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="px-3">
                                <h1 class="h1 text-white fw-bold">Carpets</h1>
                                <h3 class="h3 text-white fw-bold">Wall to Wall & Artificial</h3>
                                <a style="background-color: rgb(237,126,39); font-weight:bold;"
                                   class="btn btn-lg text-white   mt-2 btn-ecomm" href="shop-grid.html">Shop Now</a>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_5.png" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
                <div class="carousel-item bg-yellow">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="">
                                <h1 class="h1 text-white fw-bold">Curtain Rods</h1>
                                <a style="background-color: rgb(237,126,39); font-weight:bold;"
                                   class="btn btn-lg text-white  mt-2 btn-ecomm" href="shop-grid.html">Shop Now</a>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_3.png" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!--end carousel-->

    <!--start information-->
    <section class="py-4 mt-2">
        <div class="container py-4">
            <div class="row row-cols-1 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="d-flex align-items-center justify-content-center p-3 border">
                        <div class="fs-1 text-content"><i class='bx bx-taxi'></i>
                        </div>
                        <div class="info-box-content ps-3">
                            <h6 class="mb-0 fw-bold">FREE SHIPPING &amp; RETURN</h6>
                            <p class="mb-0">Free shipping on all orders over $49</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center justify-content-center p-3 border">
                        <div class="fs-1 text-content"><i class='bx bx-dollar-circle'></i>
                        </div>
                        <div class="info-box-content ps-3">
                            <h6 class="mb-0 fw-bold">MONEY BACK GUARANTEE</h6>
                            <p class="mb-0">100% money back guarantee</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center justify-content-center p-3 border">
                        <div class="fs-1 text-content"><i class='bx bx-support'></i>
                        </div>
                        <div class="info-box-content ps-3">
                            <h6 class="mb-0 fw-bold">ONLINE SUPPORT 24/7</h6>
                            <p class="mb-0">Awesome Support for 24/7 Days</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end information-->

    <!--start pramotion-->
    <section class="py-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4">
                @foreach($categories as $category)
                    <div class="col">
                        <div
                            class="card rounded-0 shadow-none {{ $category->id % 2 == 0 ? 'bg-primary' : 'bg-warning' }} bg-opacity-25">
                            <div class="row g-0 align-items-center">
                                <div class="col">
                                    <img src="{{ $category->image_url }}" class="img-fluid" alt=""/>
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase fw-bold">{{ $category->name }}</h5>
                                        <a href="{{ route('front-end.shop-grid',['category_id' => $category->id,'product_id' => 0]) }}"
                                           class="btn btn-outline-dark btn-ecomm">SHOP NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end promotion-->

    <!--start tabular product-->
    <section class="product-tab-section section-padding bg-light">
        <div class="container">
            <div class="text-center pb-3">
                <h3 class="mb-0 h3 fw-bold">Shop By Tags</h3>
            </div>
            <div class="row">
                <div class="col-auto mx-auto">
                    <div class="product-tab-menu table-responsive">
                        <ul class="nav nav-pills flex-nowrap" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#featured"
                                        type="button">Featured
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#new-arrival"
                                        type="button">New
                                    Arrival
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#best-sellar"
                                        type="button">Best
                                    Seller
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#trending-product"
                                        type="button">Trending
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#special-offer"
                                        type="button">Special
                                    Offer
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="tab-content tabular-product">
                <div class="tab-pane fade show active" id="featured">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        @foreach($featured_products as $product)
                            @foreach($product->product_variations as $product_variation)
                                <div class="col">
                                    <div class="card">
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
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p style="font-weight:bold; color:black;"  class="mb-1 product-short-name">{{ strtoupper( $product->name) }}</p>
                                                    <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                </div>
                                                <div class="icon-wishlist">
                                                    <a href="{{ route('front-end.product-details',$product_variation->id) }}"><i
                                                            class="bx bx-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="cursor-pointer rating mt-2">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </div>
                                            <div
                                                class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                <div  style="width:60%;">
                                                    @php
                                                        $variationText = empty($product_variation->variation())
                                                            ? ''
                                                            : str_replace('_', ' ', $product_variation->variation()->name) . '-' . $product_variation->variation()->value;

                                                        $fullProductName = $product->name.' '.$variationText;
                                                        $productDetailsUrl = route('front-end.product-details', $product_variation->id);

                                                        // Message text with product name and line break
                                                        $whatsappMessage = 'Hello, I want to purchase: *' . $fullProductName . '*';
                                                        // Append URL on a new line using %0A
                                                        $whatsappMessage .= '. Here is the product link: ' . $productDetailsUrl;
                                                    @endphp

                                                    <a target="_blank"
                                                       style="background-color:green; border-radius: 20px !important; font-weight:bold;"
                                                       href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                       class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                        <i class='bx bxl-whatsapp fs-5'></i> Quick Buy
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade show" id="new-arrival">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        @foreach($new_arrival_products as $product)
                            @foreach($product->product_variations as $product_variation)
                                <div class="col">
                                    <div class="card">
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
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p  style="font-weight:bold; color:black;" class="mb-1 product-short-name">{{ strtoupper( $product->name) }}</p>
                                                    <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                </div>
                                                <div class="icon-wishlist">
                                                    <a href="{{ route('front-end.product-details',$product_variation->id) }}"><i
                                                            class="bx bx-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="cursor-pointer rating mt-2">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </div>
                                            <div
                                                class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                    <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                    <div  style="width:60%;">
                                                        @php
                                                            $variationText = empty($product_variation->variation())
                                                                ? ''
                                                                : str_replace('_', ' ', $product_variation->variation()->name) . '-' . $product_variation->variation()->value;

                                                            $fullProductName = $product->name.' '.$variationText;
                                                            $productDetailsUrl = route('front-end.product-details', $product_variation->id);

                                                            // Message text with product name and line break
                                                            $whatsappMessage = 'Hello, I want to purchase: *' . $fullProductName . '*';
                                                            // Append URL on a new line using %0A
                                                            $whatsappMessage .= '. Here is the product link: ' . $productDetailsUrl;
                                                        @endphp

                                                        <a target="_blank"
                                                           style="background-color:green; border-radius: 20px !important; font-weight:bold;"
                                                           href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                           class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                            <i class='bx bxl-whatsapp fs-5'></i> Quick Buy
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="best-sellar">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        @foreach($best_seller_products as $product)
                            @foreach($product->product_variations as $product_variation)
                                <div class="col">
                                    <div class="card">
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
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p style="font-weight:bold; color:black;"  class="mb-1 product-short-name">{{ strtoupper( $product->name) }}</p>
                                                    <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                </div>
                                                <div class="icon-wishlist">
                                                    <a href="{{ route('front-end.product-details',$product_variation->id) }}"><i
                                                            class="bx bx-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="cursor-pointer rating mt-2">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </div>
                                            <div
                                                class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                    <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                    <div  style="width:60%;">
                                                        @php
                                                            $variationText = empty($product_variation->variation())
                                                                ? ''
                                                                : str_replace('_', ' ', $product_variation->variation()->name) . '-' . $product_variation->variation()->value;

                                                            $fullProductName = $product->name.' '.$variationText;
                                                            $productDetailsUrl = route('front-end.product-details', $product_variation->id);

                                                            // Message text with product name and line break
                                                            $whatsappMessage = 'Hello, I want to purchase: *' . $fullProductName . '*';
                                                            // Append URL on a new line using %0A
                                                            $whatsappMessage .= '. Here is the product link: ' . $productDetailsUrl;
                                                        @endphp

                                                        <a target="_blank"
                                                           style="background-color:green; border-radius: 20px !important; font-weight:bold;"
                                                           href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                           class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                            <i class='bx bxl-whatsapp fs-5'></i> Quick Buy
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="trending-product">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        @foreach($trending_products as $product)
                            @foreach($product->product_variations as $product_variation)
                                <div class="col">
                                    <div class="card">
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
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p style="font-weight:bold; color:black;"  class="mb-1 product-short-name">{{ strtoupper( $product->name) }}</p>
                                                    <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                </div>
                                                <div class="icon-wishlist">
                                                    <a href="{{ route('front-end.product-details',$product_variation->id) }}"><i
                                                            class="bx bx-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="cursor-pointer rating mt-2">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </div>
                                            <div
                                                class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                    <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                    <div  style="width:60%;">
                                                        @php
                                                            $variationText = empty($product_variation->variation())
                                                                ? ''
                                                                : str_replace('_', ' ', $product_variation->variation()->name) . '-' . $product_variation->variation()->value;

                                                            $fullProductName = $product->name.' '.$variationText;
                                                            $productDetailsUrl = route('front-end.product-details', $product_variation->id);

                                                            // Message text with product name and line break
                                                            $whatsappMessage = 'Hello, I want to purchase: *' . $fullProductName . '*';
                                                            // Append URL on a new line using %0A
                                                            $whatsappMessage .= '. Here is the product link: ' . $productDetailsUrl;
                                                        @endphp

                                                        <a target="_blank"
                                                           style="background-color:green; border-radius: 20px !important; font-weight:bold;"
                                                           href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                           class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                            <i class='bx bxl-whatsapp fs-5'></i> Quick Buy
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="special-offer">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        @foreach($special_offer_products as $product)
                            @foreach($product->product_variations as $product_variation)
                                <div class="col">
                                    <div class="card">
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
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p style="font-weight:bold; color:black;"  class="mb-1  product-short-name">{{ strtoupper( $product->name) }}</p>
                                                    <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                </div>
                                                <div class="icon-wishlist">
                                                    <a href="{{ route('front-end.product-details',$product_variation->id) }}"><i
                                                            class="bx bx-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="cursor-pointer rating mt-2">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </div>
                                            <div
                                                class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                    <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                                    <div  style="width:60%;">
                                                        @php
                                                            $variationText = empty($product_variation->variation())
                                                                ? ''
                                                                : str_replace('_', ' ', $product_variation->variation()->name) . '-' . $product_variation->variation()->value;

                                                            $fullProductName = $product->name.' '.$variationText;
                                                            $productDetailsUrl = route('front-end.product-details', $product_variation->id);

                                                            // Message text with product name and line break
                                                            $whatsappMessage = 'Hello, I want to purchase: *' . $fullProductName . '*';
                                                            // Append URL on a new line using %0A
                                                            $whatsappMessage .= '. Here is the product link: ' . $productDetailsUrl;
                                                        @endphp

                                                        <a target="_blank"
                                                           style="background-color:green; border-radius: 20px !important; font-weight:bold;"
                                                           href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                           class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                            <i class='bx bxl-whatsapp fs-5'></i> Quick Buy
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end tabular product-->

    <!--start Advertise banners-->
    <section class="py-4 bg-dark">
        <div class="container">
            <div class="add-banner">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-4">
                    <div class="col d-flex">
                        <div style="padding-left: 10px; padding-right:10px;"
                             class="card rounded-0 w-100 border-0 shadow-none">
                            <img src="front-end-assets/images/sliders/s_3.png" class="img-fluid" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Curtain Rods</h5>
                                <p class="card-text">Get Wonderful offers and make your house shine</p>
                                <a href="javascript:;" class="btn btn-dark btn-ecomm">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div style="padding-left: 10px;"
                             class="card rounded-0 w-100 bg-yellow border-0 shadow-none">
                            <img src="front-end-assets/images/sliders/s_5.png" class="img-fluid" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Carpets</h5>
                                <p class="card-text">Wall to Wall Carpets and Artifical Carpets at wonderful prices on
                                    sale</p>
                                <a href="javascript:;" class="btn btn-dark btn-ecomm">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card bg-black rounded-0 w-100 border-0 shadow-none">
                            <div class="card-img-overlay text-center top-20">
                                <div class="border border-white border-2 py-3 bg-dark-3">
                                    <h5 class="card-title text-white">Summer Sale</h5>
                                    <p class="card-text text-uppercase fs-1 lh-1 mt-3 mb-2 text-white">Up to 30% off</p>
                                    <p class="card-text fs-5 text-white">On Top Interior Design Brands</p><a
                                        href="javascript:;" style="color:white;" class="btn btn-white btn-ecomm">SHOP BY
                                        CATEGORY</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card rounded-0 w-100 border-0 shadow-none">
                            <img src="front-end-assets/images/categories/wall_decor.png" class="img-fluid" alt="...">
                            <div style="padding-top:40px;" class="card-body text-center">
                                <h5 class="card-title fs-2 fw-bold text-uppercase">Wall Decor</h5>
                                <a href="javascript:;" class="btn btn-dark btn-ecomm">HURRY UP!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--end Advertise banners-->

    <!--start features-->
    <section class="product-thumb-slider my-5 section-padding">
        <div class="container">
            <div class="text-center pb-3">
                <h3 class="mb-0 h3 fw-bold">What We Offer!</h3>
                <p class="mb-0 text-capitalize">The purpose of lorem ipsum</p>
            </div>
            <div class="row row-cols-1 row-cols-lg-4 g-4">
                <div class="col d-flex">
                    <div class="card depth border-0 rounded-0 border-bottom border-primary border-3 w-100">
                        <div class="card-body text-center">
                            <div class="h1 fw-bold my-2 text-primary">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h5 class="fw-bold">Free Delivery</h5>
                            <p class="mb-0">Nor again is there anyone who loves or pursues or desires to obtain pain of
                                itself.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card depth border-0 rounded-0 border-bottom border-danger border-3 w-100">
                        <div class="card-body text-center">
                            <div class="h1 fw-bold my-2 text-danger">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <h5 class="fw-bold">Secure Payment</h5>
                            <p class="mb-0">Nor again is there anyone who loves or pursues or desires to obtain pain of
                                itself.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card depth border-0 rounded-0 border-bottom border-success border-3 w-100">
                        <div class="card-body text-center">
                            <div class="h1 fw-bold my-2 text-success">
                                <i class="bi bi-minecart-loaded"></i>
                            </div>
                            <h5 class="fw-bold">Free Returns</h5>
                            <p class="mb-0">Nor again is there anyone who loves or pursues or desires to obtain pain of
                                itself.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card depth border-0 rounded-0 border-bottom border-warning border-3 w-100">
                        <div class="card-body text-center">
                            <div class="h1 fw-bold my-2 text-warning">
                                <i class="bi bi-headset"></i>
                            </div>
                            <h5 class="fw-bold">24/7 Support</h5>
                            <p class="mb-0">Nor again is there anyone who loves or pursues or desires to obtain pain of
                                itself.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end features-->


    <!--start cartegory slider-->
    <section class="cartegory-slider my-5 py-4 bg-section-2">
        <div class="container">
            <div class="separator pb-2">
                <div class="line"></div>
                <h3 class="my-4 h3 fw-bold">Browse Categories</h3>
                <div class="line"></div>
            </div>
            <div class="row row-cols-2 py-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                @foreach($categories as $category)
                    <div class="col">
                        <div class="card">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('front-end.shop-grid',['category_id' => $category->id,'product_id' => 0]) }}">
                                    <img src="{{ $category->image_url }}" class="card-img-top"
                                         alt="...">
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="">
                                        <p class="mb-1 product-short-name">{{ $category->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--end cartegory slider-->

</div>
<!--end page content-->



