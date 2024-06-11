<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<header class="top-header">
    <nav class="navbar navbar-expand-xl w-100 navbar-dark container gap-3">
        <a class="navbar-brand d-none d-xl-inline" href="index.html"><img src="front-end-assets/images/logo.webp" class="logo-img" alt=""></a>
        <a class="mobile-menu-btn d-inline d-xl-none" href="javascript:;" data-bs-toggle="offcanvas"
           data-bs-target="#offcanvasNavbar">
            <i class="bi bi-list"></i>
        </a>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <div class="offcanvas-logo"><img src="front-end-assets/images/logo.webp" class="logo-img" alt="">
                </div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body primary-menu">
                <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('front-end.index') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="tv-shows.html"
                           data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <div class="dropdown-menu dropdown-large-menu">
                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <h6 class="large-menu-title">Fashion</h6>
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;">Casual T-Shirts</a>
                                        </li>
                                        <li><a href="javascript:;">Formal Shirts</a>
                                        </li>
                                        <li><a href="javascript:;">Jackets</a>
                                        </li>
                                        <li><a href="javascript:;">Jeans</a>
                                        </li>
                                        <li><a href="javascript:;">Dresses</a>
                                        </li>
                                        <li><a href="javascript:;">Sneakers</a>
                                        </li>
                                        <li><a href="javascript:;">Belts</a>
                                        </li>
                                        <li><a href="javascript:;">Sports Shoes</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end col-3 -->
                                <div class="col-12 col-xl-4">
                                    <h6 class="large-menu-title">Electronics</h6>
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;">Mobiles</a>
                                        </li>
                                        <li><a href="javascript:;">Laptops</a>
                                        </li>
                                        <li><a href="javascript:;">Macbook</a>
                                        </li>
                                        <li><a href="javascript:;">Televisions</a>
                                        </li>
                                        <li><a href="javascript:;">Lighting</a>
                                        </li>
                                        <li><a href="javascript:;">Smart Watch</a>
                                        </li>
                                        <li><a href="javascript:;">Galaxy Phones</a>
                                        </li>
                                        <li><a href="javascript:;">PC Monitors</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end col-3 -->
                                <div class="col-12 col-xl-4 d-none d-xl-block">
                                    <div class="pramotion-banner1">
                                        <img src="front-end-assets/images/menu-img.webp" class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <!-- end col-3 -->
                            </div>
                            <!-- end row -->
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" wire:navigate href="{{ route('front-end.shop-grid') }}" data-bs-toggle="dropdown">
                            Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('front-end.search') }}">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('front-end.about-us') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('frontend.contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="navbar-nav secondary-menu flex-row">
            <li class="nav-item">
                <a class="nav-link dark-mode-icon" href="javascript:;">
                    <div class="mode-icon">
                        <i class="bi bi-moon"></i>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('front-end.search') }}"><i class="bi bi-search"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('front-end.wishlist') }}"><i class="bi bi-suit-heart"></i></a>
            </li>
        </ul>
    </nav>
</header>
<!--end top header-->
