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
                    <li class="text-decoration-none active" aria-current="page">Wishlist</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->


    <!--start product wishlist-->
    <section class="section-padding">
        <div class="container">
            <div class="d-flex align-items-center px-3 py-2 border mb-4">
                <div class="text-start">
                    <h4 class="mb-0 h4 fw-bold">Wishlist (10 Items)</h4>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('front-end.shop-grid',['category_id'=>0,'product_id'=>0]) }}"
                       class="btn btn-light btn-ecomm">Continue Shopping</a>
                </div>
            </div>

            <div class="similar-products">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4">
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/best-sellar/01.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/new-arrival/01.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/trending-product/01.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/best-sellar/02.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/new-arrival/02.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/featured-products/05.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/special-offer/03.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/new-arrival/05.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/trending-product/04.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-0">
                            <div class="btn-close wishlist-close position-absolute end-0 top-0"></div>
                            <a href="javascript:;">
                                <img src="front-end-assets/images/special-offer/04.webp" alt=""
                                     class="card-img-top rounded-0">
                            </a>
                            <div class="card-body border-top text-center">
                                <p class="mb-0 product-short-name">Color Printed Kurta</p>
                                <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                                    <div class="h6 fw-bold">$458</div>
                                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                                    <div class="h6 fw-bold text-danger">(70% off)</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="javascript:;" class="btn btn-ecomm w-100">Move to Bag</a>
                            </div>
                        </div>
                    </div>


                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--start product details-->


</div>
<!--end page content-->


