<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {
}; ?>

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
                    <li class="text-decoration-none active mx-1" aria-current="page">Page Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->


    <!--start product details-->
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-xl-7">
                    <div class="product-images">
                        <div class="product-zoom-images">
                            <div class="row row-cols-2 g-3">
                                <div class="col">
                                    <div class="img-thumb-container overflow-hidden position-relative"
                                         data-fancybox="gallery"
                                         data-src="front-end-assets/images/product-images/01.jpg">
                                        <img src="front-end-assets/images/product-images/01.jpg" class="img-fluid"
                                             alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="img-thumb-container overflow-hidden position-relative"
                                         data-fancybox="gallery"
                                         data-src="front-end-assets/images/product-images/02.jpg">
                                        <img src="front-end-assets/images/product-images/02.jpg" class="img-fluid"
                                             alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="img-thumb-container overflow-hidden position-relative"
                                         data-fancybox="gallery"
                                         data-src="front-end-assets/images/product-images/03.jpg">
                                        <img src="front-end-assets/images/product-images/03.jpg" class="img-fluid"
                                             alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="img-thumb-container overflow-hidden position-relative"
                                         data-fancybox="gallery"
                                         data-src="front-end-assets/images/product-images/04.jpg">
                                        <img src="front-end-assets/images/product-images/04.jpg" class="img-fluid"
                                             alt="">
                                    </div>
                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5">
                    <div class="product-info">
                        <h4 class="product-title fw-bold mb-1">Check Pink Kurta</h4>
                        <p class="mb-0">Women Pink & Off-White Printed Kurta with Palazzos</p>
                        <div class="product-rating">
                            <div class="hstack gap-2 border p-1 mt-3 width-content">
                                <div><span class="rating-number">4.8</span><i
                                        class="bi bi-star-fill ms-1 text-warning"></i></div>
                                <div class="vr"></div>
                                <div>162 Ratings</div>
                            </div>
                        </div>
                        <hr>
                        <div class="product-price d-flex align-items-center gap-3">
                            <div class="h4 fw-bold">$458</div>
                            <div class="h5 fw-light text-muted text-decoration-line-through">$2089</div>
                            <div class="h4 fw-bold text-danger">(70% off)</div>
                        </div>
                        <p class="fw-bold mb-0 mt-1 text-success">inclusive of all taxes</p>
                        <hr class="my-3">
                        <div class="product-info">
                            <h6 class="fw-bold mb-3">Product Details</h6>
                            <p style="font-size:14px;" class="mb-1">There are many variations of passages of Lorem
                                Ipsum</p>
                        </div>
                        <hr class="my-3">
                        <div class="customer-ratings">
                            <h6 class="fw-bold mb-3">Customer Ratings</h6>
                            <div class="d-flex align-items-center gap-4 gap-lg-5 flex-wrap flex-lg-nowrap">
                                <div class="">
                                    <h1 class="mb-2 fw-bold">4.8<span class="fs-5 ms-2 text-warning"><i
                                                class="bi bi-star-fill"></i></span></h1>
                                    <p class="mb-0">3.8k Verified Buyers</p>
                                </div>
                                <div class="vr d-none d-lg-block"></div>
                                <div class="w-100">
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">5</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: 75%"></div>
                                        </div>
                                        <p class="mb-0">1528</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">4</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: 65%"></div>
                                        </div>
                                        <p class="mb-0">253</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">3</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                 style="width: 45%"></div>
                                        </div>
                                        <p class="mb-0">258</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">2</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                 style="width: 35%"></div>
                                        </div>
                                        <p class="mb-0">78</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">1</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                 style="width: 25%"></div>
                                        </div>
                                        <p class="mb-0">27</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5 shadow-none mb-3 mb-lg-0 border-3 border-success">
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a style="font-weight:bold;" href="account-dashboard.html"
                                   class="list-group-item d-flex  text-success  justify-content-between align-items-center bg-orange">WhatsApp
                                    <i class='bx bxl-whatsapp fs-5'></i></a>
                                <a style="font-weight:bold;" href="account-orders.html"
                                   class="list-group-item text-success d-flex justify-content-between align-items-center bg-transparent">Call
                                    - 0798692688 <i class='bx bx-phone-call fs-5'></i></a>
                                <a style="font-weight:bold;" href="account-downloads.html"
                                   class="list-group-item d-flex text-success justify-content-between align-items-center bg-transparent">Request
                                    CallBack
                                    <i class='bx bx-phone-incoming fs-5'></i></a>
                                <a style="font-weight:bold;" href="account-downloads.html"
                                   class="list-group-item d-flex text-success justify-content-between align-items-center bg-transparent">Send Email<i
                                        class='bx bx-mail-send fs-5'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </section>
    <!--start product details-->

    <section class="py-4">
        <div class="container">
            <div class="product-more-info">
                <ul class="nav nav-tabs mb-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#discription">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">Description</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#more-info">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">More Info</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tags">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">Tags</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#reviews">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">(3) Reviews</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane fade" id="discription">
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                            aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan
                            helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh
                            mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan
                            aliquip quis cardigan american apparel, butcher voluptate nisi.</p>
                        <ul>
                            <li>Not just for commute</li>
                            <li>Branded tongue and cuff</li>
                            <li>Super fast and amazing</li>
                            <li>Lorem sed do eiusmod tempor</li>
                        </ul>
                        <p class="mb-1">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat
                            salvia cillum iphone.</p>
                        <p class="mb-1">Seitan aliquip quis cardigan american apparel, butcher voluptate nisi.</p>
                    </div>
                    <div class="tab-pane fade" id="more-info">
                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
                            Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan
                            four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft
                            beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda
                            labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit
                            sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean
                            shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown,
                            tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                    </div>
                    <div class="tab-pane fade" id="tags">
                        <div class="tags-box d-flex flex-wrap gap-2">
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Cloths</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Electronis</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Furniture</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Sports</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Men Wear</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Women Wear</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Laptops</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Formal Shirts</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Topwear</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Headphones</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Bottom Wear</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Bags</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Sofa</a>
                            <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">Shoes</a>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="reviews">
                        <div class="row">
                            <div class="col col-lg-8">
                                <div class="product-review">
                                    <h5 class="mb-4">3 Reviews For The Product</h5>
                                    <div class="review-list">
                                        <div class="d-flex align-items-start">
                                            <div class="review-user">
                                                <img src="assets/images/avatars/avatar-1.png" width="65" height="65"
                                                     class="rounded-circle" alt=""/>
                                            </div>
                                            <div class="review-content ms-3">
                                                <div class="rates cursor-pointer fs-6">
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <h6 class="mb-0">James Caviness</h6>
                                                    <p class="mb-0 ms-auto">February 16, 2021</p>
                                                </div>
                                                <p>Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                                                    cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                                    butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                                    qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                                                    iphone. Seitan aliquip quis cardigan</p>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="d-flex align-items-start">
                                            <div class="review-user">
                                                <img src="assets/images/avatars/avatar-2.png" width="65" height="65"
                                                     class="rounded-circle" alt=""/>
                                            </div>
                                            <div class="review-content ms-3">
                                                <div class="rates cursor-pointer fs-6">
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <h6 class="mb-0">David Buckley</h6>
                                                    <p class="mb-0 ms-auto">February 22, 2021</p>
                                                </div>
                                                <p>Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                                                    cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                                    butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                                    qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                                                    iphone. Seitan aliquip quis cardigan</p>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="d-flex align-items-start">
                                            <div class="review-user">
                                                <img src="assets/images/avatars/avatar-3.png" width="65" height="65"
                                                     class="rounded-circle" alt=""/>
                                            </div>
                                            <div class="review-content ms-3">
                                                <div class="rates cursor-pointer fs-6">
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <h6 class="mb-0">Peter Costanzo</h6>
                                                    <p class="mb-0 ms-auto">February 26, 2021</p>
                                                </div>
                                                <p>Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                                                    cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                                    butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                                    qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                                                    iphone. Seitan aliquip quis cardigan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <div class="add-review border">
                                    <div class="form-body p-3">
                                        <h4 class="mb-4">Write a Review</h4>
                                        <div class="mb-3">
                                            <label class="form-label">Your Name</label>
                                            <input type="text" class="form-control rounded-0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Your Email</label>
                                            <input type="text" class="form-control rounded-0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Rating</label>
                                            <select class="form-select rounded-0">
                                                <option selected>Choose Rating</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="3">4</option>
                                                <option value="3">5</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Example textarea</label>
                                            <textarea class="form-control rounded-0" rows="3"></textarea>
                                        </div>
                                        <div class="d-grid">
                                            <button type="button" class="btn btn-dark btn-ecomm">Submit a Review
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--start product details-->
    <section class="section-padding">
        <div class="container">
            <div class="separator pb-3">
                <div class="line"></div>
                <h3 class="mb-0 h3 fw-bold">Similar Products</h3>
                <div class="line"></div>
            </div>
            <div class="similar-products">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4">
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/best-sellar/03.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/new-arrival/02.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/best-sellar/02.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/new-arrival/04.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/new-arrival/05.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/trending-product/03.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/featured-products/05.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/trending-product/05.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/trending-product/01.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="javascript:;">
                            <div class="card rounded-0">
                                <img src="front-end-assets/images/trending-product/02.webp" alt=""
                                     class="card-img-top rounded-0">
                                <div class="card-body border-top">
                                    <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                                    <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                    <div class="product-price d-flex align-items-center gap-3 mt-2">
                                        <div class="h6 fw-bold">$458</div>
                                        <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                        <div class="h6 fw-bold text-danger">(70% off)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--end product details-->


</div>
<!--end page content-->
