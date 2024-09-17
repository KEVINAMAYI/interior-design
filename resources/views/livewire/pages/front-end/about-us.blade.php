<?php

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public function with()
    {
        return [
            'products' => Product::all()
        ];
    }


}; ?>

<!--start page content-->
<div class="page-content">

    <!--start breadcrumb-->
    <div class="py-4 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class=""><a class="text-decoration-none" href="javascript:;">Home<i
                                class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class=""><a class="text-decoration-none" href="javascript:;">Pages<i
                                class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class="text-decoration-none mx-1 active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->


    <!--start product details-->
    <section class="section-padding">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <h3 class="fw-bold">About Us</h3>
                    <p>GSM Interiors Ltd is an interior design company dealing with a wide range of Flooring solutions,
                        Home & office decor, artificial flowers and artificial plants.</p>
                    <p>Our Quality products and excellent customer service ensure a glorious experience that is centered
                        around excellence and attention to details.</p>
                    <p>GSM Interiors Ltd specializes in both commercial and residential projects to create that desired,
                        conducive and elegant spaces to work and live.</p>
                    <p>Right from understanding the client's requirements, planning, designing, product sourcing and
                        manpower, everything will be expertly managed by our professional team.</p>
                    <p>GSM Interiors ltd major focus is on the quality of the products we source, supply and use for our
                        clients. We match the products used to leading industrial standards while also keeping pace with
                        current trends of products in interior design</p>
                    <p>Our strategic location at the heart of Nairobi CBD make our operations and customer service
                        efficient and also delivery of products countrywide depending on the location of our
                        customers.</p>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="row">
                        <div class="col-6">
                            <img src="front-end-assets/images/sliders/s_3.png" class="card-img-top"
                                 alt="...">
                        </div>
                        <div class="col-6">
                            <img src="front-end-assets/images/sliders/s_5.png" class="card-img-top"
                                 alt="...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <img src="front-end-assets/images/sliders/s_1.png" class="card-img-top"
                                 alt="...">
                        </div>
                        <div class="col-6">
                            <img src="front-end-assets/images/sliders/s_6.png" class="card-img-top"
                                 alt="...">
                        </div>
                    </div>
                </div>
            </div><!--end row-->

            <div style="margin-top:20px;" class="separator section-padding">
                <div class="line"></div>
                <h3 class="mb-0 h3 fw-bold">Why Choose Us</h3>
                <div class="line"></div>
            </div>

            <div class="row row-cols-1 row-cols-xl-2 g-4 why-choose">
                <div class="col d-flex">
                    <div class="card rounded-0 shadow-none w-100">
                        <div class="card-body">
                            <img src="front-end-assets/images/icons/delivery.webp" width="60" alt="">
                            <h5 class="my-3 fw-bold">Delivery</h5>
                            <p class="mb-0">Delivery times are just estimates. GSM Interiors Ltd, however, places great
                                attention to fast, efficient and convenient delivery of our products and services to
                                match client's expectations.</p>
                        </div>
                    </div>
                </div>

                <div class="col d-flex">
                    <div class="card rounded-0 shadow-none w-100">
                        <div class="card-body">
                            <img src="front-end-assets/images/icons/support.webp" width="60" alt="">
                            <h5 class="my-3 fw-bold">Online Support</h5>
                            <p class="mb-0">We support our customers Online 24/7.</p>
                            <p style="margin-top:5px;">
                                <span style="color:green; font-weight:bold;" class="mb-0">0798692688/</span>
                                <span style="color:green; font-weight:bold;"  class="mb-0"> 0796052958</span>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col d-flex">
                    <div class="card rounded-0 shadow-none w-100">
                        <div class="card-body">
                            <img src="front-end-assets/images/icons/guarantee.png" width="60" alt="">
                            <h5 class="my-3 fw-bold">Guarantee</h5>
                            <p class="mb-0">At GSM Interiors Ltd, our products and services are at the risk of the
                                customer at the point of delivery/installation. The customer, upon receiving the
                                product/service should inspect the condition and notify GSM Interiors Ltd of any defect
                                within 3-5 working days against which an action shall be taken. Beyond this period, the
                                company shall deem the product/service to have been in perfect condition at the time of
                                delivery/installation.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top:20px;" class="separator section-padding">
                <div class="line"></div>
                <h3 class="mb-0 h3 fw-bold">Location</h3>
                <div class="line"></div>
            </div>

            <div class="row row-cols-1 row-cols-xl-2 g-4 why-choose">
                <div class="col d-flex">
                    <div class="card rounded-0 shadow-none w-100">
                        <div class="card-body">
                            <iframe class="w-100"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.817857299221!2d36.82293997358516!3d-1.2831300356197837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f112a045dad53%3A0xdb8d1c72f1ec4f4a!2sTaveta%20Court!5e0!3m2!1sen!2ske!4v1723110427984!5m2!1sen!2ske"
                                    height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

                <div class="col d-flex">
                    <div class="card rounded-0 shadow-none w-100">
                        <div class="card-body">
                            <div class="p-3 border">
                                <div class="address mb-3">
                                    <h5 class="mb-0 fw-bold">Address</h5>
                                    <p class="mb-0 font-12">Nairobi CBD Odeon, along Taveta Road, Taveta Court Building
                                        shop 305/306</p>
                                </div>
                                <hr>
                                <div class="phone mb-3">
                                    <h5 class="mb-0 fw-bold">Phone</h5>
                                    <p class="mb-0 font-13">0798692688</p>
                                </div><hr>
                                <div class="email mb-3">
                                    <h5 class="mb-0 fw-bold">Email</h5>
                                    <p class="mb-0 font-13">info@gsminteriors.co.ke</p>
                                </div>
                                <hr>
                                <div class="working-days mb-0">
                                    <h5 class="mb-0 fw-bold">Working Days</h5>
                                    <p class="mb-0 font-13">Mon - FRI / 8:00 AM - 7:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--start product details-->

</div>
<!--end page content-->

