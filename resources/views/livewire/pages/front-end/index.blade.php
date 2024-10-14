<?php

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Deal;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {


    public $best_seller_products;
    public $trending_products;
    public $special_offer_products;
    public $categories;
    public $carousel;
    public $deals;

    public function mount()
    {
        $products = Product::query();
        $this->best_seller_products = $this->getProductsByTag($products, 'best_seller');
        $this->trending_products = $this->getProductsByTag($products, 'trending');
        $this->special_offer_products = $this->getProductsByTag($products, 'special_offer');
        $this->categories = Category::inRandomOrder()->get();
        $this->carousel = Carousel::first();
        $this->deals = Deal::all();
    }

    public function getProductsByTag($products, $tag)
    {
        return $products->whereHas('tags', function ($q) use ($tag) {
            $q->where('slug', 'like', $tag);
        })->inRandomOrder()->get();
    }


}; ?>
@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Tangerine:wght@700&family=Poppins:wght@300;600&display=swap"
          rel="stylesheet">

    <style>                                                                                                                                                     /* Improved gradient with subtle blending and animation */
        .image-gradient {
            position: absolute;
            top: 0;
            left: 0;
            width: 80%; /* Match the image width */
            height: 100%;
            z-index: 1;
            border-radius: 10px;
            pointer-events: none;
        }
    </style>
@endpush
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

                @if(!empty($deals))
                    @foreach($deals as $deal)
                        <div style="position: relative; height: 100vh;" class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row d-flex align-items-center">
                                <!-- Text Section with Floating Content -->
                                <div class="col d-none d-lg-flex justify-content-start">
                                    <div style="padding: 150px 40px; z-index: 2; position: relative;">
                                        <!-- H1 styled with Tangerine -->
                                        <h1 class="h1  fw-bold" style="font-family: 'Tangerine', cursive;
                                             font-size: 5rem;
                                             color: orange; /* Deep Navy Blue */
                                             text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                                             letter-spacing: 1.5px;
                                             line-height: 1.2;">
                                            {{ strtoupper($deal->name) }}
                                        </h1>
                                        <!-- H3 styled with Poppins -->
                                        <h2 class="h3 fw-light  fw-bold" style="font-family: 'Poppins', sans-serif;
                                                      font-size: 3.4rem;
                                                      font-weight: 300;
                                                      color: orange; /* Soft Gray */
                                                      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
                                                      letter-spacing: 1px;">
                                            UPTO {{ $deal->discount_off }} % OFF
                                        </h2>
                                        <!-- Button -->
                                        <div>
                                            <a style="background-color: rgb(237,126,39);
                  font-family: 'Poppins', sans-serif;
                  font-weight: 600;
                  font-size: 1.2rem;
                  padding: 12px 30px;
                  letter-spacing: 1px;
                  border-radius: 50px;
                  text-transform: uppercase;
                  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);"
                                               class="btn btn-lg text-white mt-3 btn-ecomm"
                                               href="{{ route('front-end.shop-grid', ['category_id' => 1, 'product_id' => 0]) }}">
                                                Shop Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fullscreen Image Section -->
                                <div
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; overflow: hidden;">
                                    <img id="carousel-image"
                                         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"
                                         src="{{ asset('storage/' .$deal->banner_url) }}"
                                         class="img-fluid"
                                         alt="...">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


                <div style="position: relative; height: 100vh;" class="carousel-item">
                    <div class="row d-flex align-items-center">
                        <!-- Text Section with Floating Content -->
                        <div class="col d-none d-lg-flex justify-content-start">
                            <div style="padding: 150px 40px; z-index: 2; position: relative;">
                                <!-- H1 styled with Tangerine -->
                                <h1 class="h1  fw-bold" style="font-family: 'Tangerine', cursive;
                                             font-size: 5rem;
                                             color: orange; /* Deep Navy Blue */
                                             text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                                             letter-spacing: 1.5px;
                                             line-height: 1.2;">
                                    Carpets
                                </h1>
                                <!-- H3 styled with Poppins -->
                                <h3 class="h3 fw-light  fw-bold" style="font-family: 'Poppins', sans-serif;
                                                      font-size: 1.8rem;
                                                      font-weight: 300;
                                                      color: orange; /* Soft Gray */
                                                      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
                                                      letter-spacing: 1px;">
                                    Wall to Wall & Artificial
                                </h3>
                                <!-- Button -->
                                <div>
                                    <a style="background-color: rgb(237,126,39);
                  font-family: 'Poppins', sans-serif;
                  font-weight: 600;
                  font-size: 1.2rem;
                  padding: 12px 30px;
                  letter-spacing: 1px;
                  border-radius: 50px;
                  text-transform: uppercase;
                  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);"
                                       class="btn btn-lg text-white mt-3 btn-ecomm"
                                       href="{{ route('front-end.shop-grid', ['category_id' => 1, 'product_id' => 0]) }}">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Fullscreen Image Section -->
                        <div
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; overflow: hidden;">
                            <img id="carousel-image"
                                 style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"
                                 src="{{ asset('storage/' .$carousel->image_url_1) }}"
                                 class="img-fluid"
                                 alt="...">
                        </div>
                    </div>
                </div>
                <div style="position: relative; height: 100vh;" class="carousel-item">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-start">
                            <div style="padding: 150px 40px; z-index: 2; position: relative;">
                                <!-- H1 styled with Tangerine -->
                                <h1 class="h1  fw-bold" style="font-family: 'Tangerine', cursive;
                                             font-size: 5rem;
                                             color: orange; /* Deep Navy Blue */
                                             text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                                             letter-spacing: 1.5px;
                                             line-height: 1.2;">
                                    Curtain Features
                                </h1>
                                <!-- H3 styled with Poppins -->
                                <h3 class="h3 fw-light  fw-bold" style="font-family: 'Poppins', sans-serif;
                                                      font-size: 1.8rem;
                                                      font-weight: 300;
                                                      color: orange; /* Soft Gray */
                                                      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
                                                      letter-spacing: 1px;">
                                    Rods and Rails
                                </h3>
                                <!-- Button -->
                                <div>
                                    <a style="background-color: rgb(237,126,39);
                  font-family: 'Poppins', sans-serif;
                  font-weight: 600;
                  font-size: 1.2rem;
                  padding: 12px 30px;
                  letter-spacing: 1px;
                  border-radius: 50px;
                  text-transform: uppercase;
                  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);"
                                       class="btn btn-lg text-white mt-3 btn-ecomm"
                                       href="{{ route('front-end.shop-grid',['category_id' => 7,'product_id' => 0]) }}">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Fullscreen Image Section -->
                        <div
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; overflow: hidden;">
                            <img id="carousel-image"
                                 style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"
                                 src="{{ asset('storage/' .$carousel->image_url_2) }}"
                                 class="img-fluid"
                                 alt="...">
                        </div>
                    </div>
                </div>

                <div style="position: relative; height: 100vh;" class="carousel-item">
                    <div class="row d-flex align-items-center">

                        <div class="col d-none d-lg-flex justify-content-start">
                            <div style="padding: 150px 40px; z-index: 2; position: relative;">
                                <!-- H1 styled with Tangerine -->
                                <h1 class="h1  fw-bold" style="font-family: 'Tangerine', cursive;
                                             font-size: 5rem;
                                             color: orange; /* Deep Navy Blue */
                                             text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                                             letter-spacing: 1.5px;
                                             line-height: 1.2;">
                                    Wall Decor
                                </h1>
                                <div>
                                    <a style="background-color: rgb(237,126,39);
                  font-family: 'Poppins', sans-serif;
                  font-weight: 600;
                  font-size: 1.2rem;
                  padding: 12px 30px;
                  letter-spacing: 1px;
                  border-radius: 50px;
                  text-transform: uppercase;
                  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);"
                                       class="btn btn-lg text-white mt-3 btn-ecomm"
                                       href="{{ route('front-end.shop-grid',['category_id' => 4,'product_id' => 0]) }}">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; overflow: hidden;">
                            <img id="carousel-image"
                                 style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"
                                 src="{{ asset('storage/' .$carousel->image_url_3) }}"
                                 class="img-fluid"
                                 alt="...">
                        </div>
                    </div>
                </div>

                <div style="position: relative; height: 100vh;" class="carousel-item">
                    <div class="row d-flex align-items-center">
                        <div class="col d-none d-lg-flex justify-content-center">
                            <div class="col d-none d-lg-flex justify-content-start">
                                <div style="padding: 150px 40px; z-index: 2; position: relative;">
                                    <!-- H1 styled with Tangerine -->
                                    <h1 class="h1  fw-bold" style="font-family: 'Tangerine', cursive;
                                             font-size: 5rem;
                                             color: orange; /* Deep Navy Blue */
                                             text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                                             letter-spacing: 1.5px;
                                             line-height: 1.2;">
                                        Artificial Flowers
                                    </h1>
                                    <!-- Button -->
                                    <div>
                                        <a style="background-color: rgb(237,126,39);
                  font-family: 'Poppins', sans-serif;
                  font-weight: 600;
                  font-size: 1.2rem;
                  padding: 12px 30px;
                  letter-spacing: 1px;
                  border-radius: 50px;
                  text-transform: uppercase;
                  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);"
                                           class="btn btn-lg text-white mt-3 btn-ecomm"
                                           href="{{ route('front-end.shop-grid',['category_id' => 4,'product_id' => 0]) }}">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="">
                                <h1 class="h1 text-white fw-bold">Artificial Flowers</h1>
                                <a style="background-color: rgb(237,126,39); font-weight:bold;"
                                   class="btn btn-lg text-white  mt-2 btn-ecomm"
                                   href="{{ route('front-end.shop-grid',['category_id' => 5,'product_id' => 0]) }}">Shop
                                    Now</a>
                            </div>
                        </div>

                        <div
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; overflow: hidden;">
                            <img id="carousel-image"
                                 style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"
                                 src="{{ asset('storage/' .$carousel->image_url_4) }}"
                                 class="img-fluid"
                                 alt="...">
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
                            <h6 class="mb-0 fw-bold">DELIVERY</h6>
                            <p class="mb-0">Fast, Efficient and Convenient.</p>
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
                <div class="col">
                    <div class="d-flex align-items-center justify-content-center p-3 border">
                        <div class="fs-1 text-content"><i class='bx bx-network-chart'></i>
                        </div>
                        <div class="info-box-content ps-3">
                            <h6 class="mb-0 fw-bold">QUALITY</h6>
                            <p class="mb-0">Great Quality guaranteed.</p>
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
                                    @if( !empty($category->image_url) )
                                        <img
                                            src="{{ asset('storage/' .$category->image_url) }}"
                                            class="card-img-top"
                                            alt="...">
                                    @else
                                        <img
                                            src="front-end-assets/images/categories/artificial_grass_carpets.png"
                                            class="card-img-top"
                                            alt="...">
                                    @endif
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
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#trending"
                                        type="button">Trending
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#best-seller"
                                        type="button">Best
                                    Seller
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
                <div class="tab-pane fade show active" id="trending">
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
                                            <a style="text-decoration:none;"
                                               href="{{ route('front-end.product-details',$product_variation->id) }}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="">
                                                        <p style="font-weight:bold; color:black;"
                                                           class="mb-1 product-short-name">{{ strtoupper( $product->name) }}</p>
                                                        @if(!empty($product_variation->variation()))
                                                            @if($product_variation->variation()->name == 'other')
                                                                <h6 class="mb-1"> {{ $product_variation->custom_variation }}</h6>
                                                            @else
                                                                <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                            @endif
                                                        @endif
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
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2">
                                                    <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
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
                                                           style="background-color:green; border-radius: 30px !important; font-size:13px; font-weight:bold;"
                                                           @if(($product->category_id == '4') || ($product->category_id == '5'))
                                                           href="https://api.whatsapp.com/send?phone=254796052958&text={{ urlencode($whatsappMessage) }}"
                                                           @else
                                                           href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                           @endif
                                                           class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                            <i class='bx bxl-whatsapp fs-5'></i> Buy on WhatsApp
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade show" id="best-seller">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-4">
                        @foreach($best_seller_products as $product)
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
                                            <a style="text-decoration:none;"
                                               href="{{ route('front-end.product-details',$product_variation->id) }}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="">
                                                        <p style="font-weight:bold; color:black;"
                                                           class="mb-1 product-short-name">{{ strtoupper( $product->name) }}</p>
                                                        @if(!empty($product_variation->variation()))
                                                            @if($product_variation->variation()->name == 'other')
                                                                <h6 class="mb-1"> {{ $product_variation->custom_variation }}</h6>
                                                            @else
                                                                <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                            @endif
                                                        @endif
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
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                    <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
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
                                                           style="font-size:13px;  background-color:green; border-radius: 30px !important; font-weight:bold;"
                                                           @if(($product->category_id == '4') || ($product->category_id == '5'))
                                                           href="https://api.whatsapp.com/send?phone=254796052958&text={{ urlencode($whatsappMessage) }}"
                                                           @else
                                                           href="https://api.whatsapp.com/send?phone=254798692688&text={{ urlencode($whatsappMessage) }}"
                                                           @endif                                                       class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                            <i class='bx bxl-whatsapp fs-5'></i>Buy on WhatsApp
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
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
                                            <a style="text-decoration:none;"
                                               href="{{ route('front-end.product-details',$product_variation->id) }}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="">
                                                        <p style="font-weight:bold; color:black;"
                                                           class="mb-1  product-short-name">{{ strtoupper( $product->name) }}</p>
                                                        @if(!empty($product_variation->variation()))
                                                            @if($product_variation->variation()->name == 'other')
                                                                <h6 class="mb-1"> {{ $product_variation->custom_variation }}</h6>
                                                            @else
                                                                <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
                                                            @endif
                                                        @endif
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
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                    <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
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
                                                           @endif                                                       class="d-flex text-white  justify-content-between align-items-center btn btn-success">
                                                            <i class='bx bxl-whatsapp fs-5'></i>Buy on WhatsApp
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
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
                                <a href="{{ route('front-end.shop-grid',['category_id' => 3,'product_id' => 0]) }}"
                                   class="btn btn-dark btn-ecomm">SHOP NOW</a>
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
                                <a href="{{ route('front-end.shop-grid',['category_id' => 1,'product_id' => 0]) }}"
                                   class="btn btn-dark btn-ecomm">SHOP NOW</a>
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
                                        href="{{ route('front-end.shop-grid',['category_id' => 0,'product_id' => 0]) }}"
                                        style="color:white;" class="btn btn-white btn-ecomm">SHOP BY
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
                                <a href="{{ route('front-end.shop-grid',['category_id' => 4,'product_id' => 0]) }}"
                                   class="btn btn-dark btn-ecomm">HURRY UP!</a>
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
            </div>
            <div class="container py-4">
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    <div class="col">
                        <div class="d-flex align-items-center justify-content-center p-3 border">
                            <div class="fs-1 text-content"><i class='bx bx-taxi'></i>
                            </div>
                            <div class="info-box-content ps-3">
                                <h6 class="mb-0 fw-bold">DELIVERY</h6>
                                <p class="mb-0">Fast, Efficient and Convenient.</p>
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
                    <div class="col">
                        <div class="d-flex align-items-center justify-content-center p-3 border">
                            <div class="fs-1 text-content"><i class='bx bx-network-chart'></i>
                            </div>
                            <div class="info-box-content ps-3">
                                <h6 class="mb-0 fw-bold">QUALITY</h6>
                                <p class="mb-0">Great Quality guaranteed.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
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
                                    @if( !empty($category->image_url) )
                                        <img
                                            src="{{ asset('storage/' .$category->image_url) }}"
                                            class="card-img-top"
                                            alt="...">
                                    @else
                                        <img
                                            src="front-end-assets/images/categories/artificial_grass_carpets.png"
                                            class="card-img-top"
                                            alt="...">
                                    @endif

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



