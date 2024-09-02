<?php

use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {

    public function with()
    {
        return [
            'categories' => Category::all()
        ];
    }

}; ?>

<!--start footer-->
<section class="footer-section bg-section-2 section-padding">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-4 g-4">
            <div class="col">
                <div class="footer-widget-6">
                    <img class="mb-3" height="60" src="front-end-assets/images/gsm_logo_transparent.png">
                    <h5 class="mb-3 fw-bold">About Us</h5>
                    <p class="mb-2">GSM Interiors Ltd is an interior design company dealing with a wide range of Flooring solutions, Home & office decor, artificial flowers and artificial plants.</p>

                    <a style="text-decoration:none;" class="btn btn-success" wire:navigate href="{{ route('front-end.about-us') }}">Read More</a>
                </div>
            </div>
            <div class="col">
                <div class="footer-widget-7">
                    <h5 class="mb-3 fw-bold">Explore</h5>
                    <ul class="widget-link list-unstyled">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('front-end.shop-grid',['category_id' => $category->id,'product_id' => 0]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="footer-widget-8">
                    <h5 class="mb-3 fw-bold">Quick Links</h5>
                    <ul class="widget-link list-unstyled">
                        <li><a href="{{ route('front-end.about-us')}}">About Us</a></li>
                        <li><a href="{{ route('front-end.contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('front-end.store')}}">Store</a></li>
                        <li><a href="{{ route('front-end.search')}}">Search</a></li>
                        <li><a href="{{ route('front-end.search') }}">Shop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="footer-widget-9">
                    <h5 class="mb-3 fw-bold">Follow Us</h5>
                    <div class="social-link d-flex align-items-center gap-2">
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=100083292944712"><i class="bi bi-facebook"></i></a>
                        <a target="_blank" href="https://www.tiktok.com/@gsm_interiors_ltd?_t=8p0SeihePRe&_r=1"><i class="bi bi-tiktok"></i></a>
                        <a target="_blank" href="https://www.instagram.com/gsminteriorsltd?igsh=MWc4YWhteHRiY3MwaA=="><i class="bi bi-instagram"></i></a>
                    </div>
                    <div class="mb-3 mt-3">
                        <h5 class="mb-0 fw-bold">Email</h5>
                        <p class="mb-0 text-muted">gsminterior08@gmail.com</p>
                    </div>
                    <div class="">
                        <h5 class="mb-0 fw-bold">Phone</h5>
                        <p class="mb-0 font-13">0798692688</p>
                    </div>
                </div>
                <div style="border:2px solid black; padding:10px;" class="address mt-3 mb-3">
                    <h5 class="mb-2 fw-bold">Address</h5>
                    <p class="mb-0 font-12">Nairobi CBD Odeon, along Taveta Road, Taveta Court Building shop 305/306</p>
                </div>
            </div>
        </div><!--end row-->
        <div class="my-5"></div>
    </div>
</section>
<!--end footer-->
