<?php

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {


    public $featured_products;
    public $latest_products;
    public $best_seller_products;
    public $trending_products;
    public $categories;

    public function mount()
    {
        $products = Product::query();
        $this->featured_products = $this->getFeaturedProducts($products);
        $this->latest_products = $this->getLatestProducts($products);
        $this->best_seller_products = $this->getBestSellerProducts($products);
        $this->trending_products = $this->getTrendingProducts($products);
        $this->categories = Category::all();

    }


    public function getFeaturedProducts($products)
    {
        return $products->WhereHas('tags', function ($q) {
            $q->where('slug', 'like', "featured_products");
        })->get();

    }

    public function getLatestProducts($products)
    {
        return $products->WhereHas('tags', function ($q) {
            $q->where('slug', 'like', "latest_products");
        })->get();

    }

    public function getBestSellerProducts($products)
    {
        return $products->WhereHas('tags', function ($q) {
            $q->where('slug', 'like', "best_seller");
        })->get();

    }


    public function getTrendingProducts($products)
    {
        return $products->WhereHas('tags', function ($q) {
            $q->where('slug', 'like', "trending");
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
                                <h3 class="h3 fw-light text-white fw-bold">New Arrival</h3>
                                <h1 class="h1 text-white fw-bold">Women Fashion</h1>
                                <p class="text-white fw-bold"><i>Last call for upto 25%</i></p>
                                <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_1.webp" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
                <div class="carousel-item bg-red">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="">
                                <h3 class="h3 fw-light text-white fw-bold">Latest Trending</h3>
                                <h1 class="h1 text-white fw-bold">Fashion Wear</h1>
                                <p class="text-white fw-bold"><i>Last call for upto 35%</i></p>
                                <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_2.webp" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
                <div class="carousel-item bg-purple">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="">
                                <h3 class="h3 fw-light text-white fw-bold">New Trending</h3>
                                <h1 class="h1 text-white fw-bold">Kids Fashion</h1>
                                <p class="text-white fw-bold"><i>Last call for upto 15%</i></p>
                                <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_3.webp" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
                <div class="carousel-item bg-yellow">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="">
                                <h3 class="h3 fw-light text-dark fw-bold">Latest Trending</h3>
                                <h1 class="h1 text-dark fw-bold">Electronics Items</h1>
                                <p class="text-dark fw-bold"><i>Last call for upto 45%</i></p>
                                <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_4.webp" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
                <div class="carousel-item bg-green">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="">
                                <h3 class="h3 fw-light text-white fw-bold">Super Deals</h3>
                                <h1 class="h1 text-white fw-bold">Home Furniture</h1>
                                <p class="text-white fw-bold"><i>Last call for upto 24%</i></p>
                                <div class=""><a class="btn btn-dark btn-ecomm" href="shop-grid.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="front-end-assets/images/sliders/s_5.webp" class="img-fluid" alt="...">
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
                <div class="col">
                    <div class="card rounded-0 shadow-none bg-info bg-opacity-25">
                        <div class="row g-0 align-items-center">
                            <div class="col">
                                <img src="front-end-assets/images/promo/01.png" class="img-fluid" alt=""/>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase fw-bold">Men Wear</h5>
                                    <p class="card-text text-uppercase">Starting at $9</p>
                                    <a href="javascript:;" class="btn btn-outline-dark btn-ecomm">SHOP NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card rounded-0 shadow-none bg-danger bg-opacity-25">
                        <div class="row g-0 align-items-center">
                            <div class="col">
                                <img src="front-end-assets/images/promo/02.png" class="img-fluid" alt=""/>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase fw-bold">Women Wear</h5>
                                    <p class="card-text text-uppercase">Starting at $9</p>    <a href="javascript:;"
                                                                                                 class="btn btn-outline-dark btn-ecomm">SHOP
                                        NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card rounded-0 shadow-none bg-warning bg-opacity-25">
                        <div class="row g-0 align-items-center">
                            <div class="col">
                                <img src="front-end-assets/images/promo/03.png" class="img-fluid" alt=""/>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase fw-bold">Kids Wear</h5>
                                    <p class="card-text text-uppercase">Starting at $9</p><a href="javascript:;"
                                                                                             class="btn btn-outline-dark btn-ecomm">SHOP
                                        NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end pramotion-->


    <!--start Featured Products slider-->
    <section class="section-padding">
        <div class="container">
            @if(!empty($featured_products->toArray()))
                <div class="text-center pb-3">
                    <h3 class="mb-0 h3 fw-bold">Featured Products</h3>
                    <p class="mb-0 text-capitalize">Checkout these featured products </p>
                </div>
            @endif
            <div class="product-thumbs">
                @foreach($featured_products as $product)
                    @foreach($product->product_variations as $product_variation)
                        <div class="card">
                            <div class="position-relative overflow-hidden">
                                <div
                                    class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                    <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                    <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#QuickViewModal"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                                <a href="product-details.html">
                                    <img src="front-end-assets/images/featured-products/01.webp" class="card-img-top"
                                         alt="...">
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="product-info text-center">
                                    <h6 class="mb-1 fw-bold product-name">{{ strtoupper( $product->name) }}</h6>
                                    <h6 class="mb-1 fw-bold product-name">{{ strtoupper( $product_variation->variation()->name.'-'.$product_variation->variation()->value) }}</h6>
                                    <div class="ratings mb-1 h6">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </div>
                                    <p class="mb-0 h6 fw-bold product-price">KES {{ $product_variation->price }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <!--end Featured Products slider-->


    <!--start tabular product-->
    <section class="product-tab-section section-padding bg-light">
        <div class="container">
            <div class="text-center pb-3">
                <h3 class="mb-0 h3 fw-bold">Latest Products</h3>
                <p class="mb-0 text-capitalize">The purpose of lorem ipsum</p>
            </div>
            <div class="row">
                <div class="col-auto mx-auto">
                    <div class="product-tab-menu table-responsive">
                        <ul class="nav nav-pills flex-nowrap" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#new-arrival"
                                        type="button">New
                                    Arrival
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#best-sellar"
                                        type="button">Best
                                    Sellar
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
                <div class="tab-pane fade show active" id="new-arrival">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/01.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="ribban">New Season</div>
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/02.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/03.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/04.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/05.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/06.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/07.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/08.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/new-arrival/09.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="best-sellar">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/best-sellar/01.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/best-sellar/02.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/best-sellar/03.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="ribban bg-primary">New Fashion</div>
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/best-sellar/04.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/best-sellar/05.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">Topwear</p>
                                            <h6 class="mb-0 fw-bold product-short-title">White Polo Shirt</h6>
                                        </div>
                                        <div class="icon-wishlist">
                                            <a href="javascript:;"><i class="bx bx-heart"></i></a>
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
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            $59.00
                                        </div>
                                        <div class="h6 fw-bold">$48.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="trending-product">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/trending-product/01.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/trending-product/02.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="ribban bg-warning text-dark">New Season</div>
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="front-end-assets/images/trending-product/03.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/trending-product/04.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/trending-product/05.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="special-offer">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/special-offer/01.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/special-offer/02.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="ribban">50% Discount</div>
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/special-offer/03.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/special-offer/04.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <div
                                        class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 end-0">
                                        <a href="javascript:;"><i class="bi bi-heart"></i></a>
                                        <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#QuickViewModal"><i
                                                class="bi bi-zoom-in"></i></a>
                                    </div>
                                    <a href="product-details.html">
                                        <img src="front-end-assets/images/special-offer/05.webp" class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-info text-center">
                                        <h6 class="mb-1 fw-bold product-name">Product Name</h6>
                                        <div class="ratings mb-1 h6">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <p class="mb-0 h6 fw-bold product-price">$49</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class="card rounded-0 w-100 border-0 shadow-none">
                            <img src="front-end-assets/images/promo/04.png" class="img-fluid" alt="...">
                            <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Sunglasses Sale</h5>
                                <p class="card-text">See all Sunglasses and get 10% off at all Sunglasses</p> <a
                                    href="javascript:;" class="btn btn-dark btn-ecomm">SHOP BY GLASSES</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card rounded-0 w-100 border-0 shadow-none">
                            <img src="front-end-assets/images/promo/08.png" class="img-fluid" alt="...">
                            <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-80%</span>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Cosmetics Sales</h5>
                                <p class="card-text">Buy Cosmetics products and get 30% off at all Cosmetics</p> <a
                                    href="javascript:;" class="btn btn-dark btn-ecomm">SHOP BY COSMETICS</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card rounded-0 w-100 border-0 shadow-none">
                            <img src="front-end-assets/images/promo/06.png" class="img-fluid h-100" alt="...">
                            <div class="card-img-overlay text-center top-20">
                                <div class="border border-white border-2 py-3 bg-dark-3">
                                    <h5 class="card-title text-white">Fashion Summer Sale</h5>
                                    <p class="card-text text-uppercase fs-1 lh-1 mt-3 mb-2 text-white">Up to 80% off</p>
                                    <p class="card-text fs-5 text-white">On Top Fashion Brands</p>    <a
                                        href="javascript:;" class="btn btn-white btn-ecomm">SHOP BY FASHION</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex">
                        <div class="card rounded-0 w-100 border-0 shadow-none">
                            <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-50%</span>
                            </div>
                            <img src="front-end-assets/images/promo/07.png" class="img-fluid" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title fs-2 fw-bold text-uppercase">Super Sale</h5>
                                <p class="card-text text-uppercase fs-5 lh-1 mb-2">Up to 50% off</p>
                                <p class="card-text">On All Electronic</p> <a href="javascript:;"
                                                                              class="btn btn-dark btn-ecomm">HURRY
                                    UP!</a>
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
                                    <img src="front-end-assets/images/new-arrival/05.webp" class="card-img-top"
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


    <!--start blog-->
    <section class="section-padding mb-4">
        <div class="container">
            <div class="text-center pb-3">
                <h3 class="mb-0 fw-bold">Latest Blog</h3>
                <p class="mb-0 text-capitalize">Check our latest news</p>
            </div>
            <div class="blog-cards">
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    <div class="col">
                        <div class="card">
                            <img src="front-end-assets/images/blog/01.webp" class="card-img-top rounded-0" alt="...">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="posted-by">
                                        <p class="mb-0"><i class="bi bi-person me-2"></i>Virendra</p>
                                    </div>
                                    <div class="posted-date">
                                        <p class="mb-0"><i class="bi bi-calendar me-2"></i>15 Aug, 2022</p>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold mt-3">Blog title here</h5>
                                <p class="mb-0">Some quick example text to build on the card title and make.</p>
                                <a href="blog-read.html" class="btn btn-outline-dark btn-ecomm mt-3">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--end blog-->


</div>
<!--end page content-->



