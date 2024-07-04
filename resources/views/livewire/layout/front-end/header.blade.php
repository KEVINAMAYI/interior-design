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

};

?>

<header class="top-header">
    <nav class="navbar navbar-expand-xl w-100 navbar-dark container gap-3">
        <a class="navbar-brand d-none d-xl-inline" href="index.html"><img src="front-end-assets/images/logo.webp"
                                                                          class="logo-img" alt=""></a>
        <a class="mobile-menu-btn d-inline d-xl-none" href="javascript:;" data-bs-toggle="offcanvas"
           data-bs-target="#offcanvasNavbar">
            <i class="bi bi-list"></i>
        </a>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <div class="offcanvas-logo"><img src="front-end-assets/images/logo.webp" class="logo-img" alt="">
                </div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body primary-menu">
                <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front-end.index') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="tv-shows.html"
                           data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <div style="max-width: 250px;" class="dropdown-menu dropdown-large-menu">
                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <ul class="list-unstyled">
                                        @foreach($categories as $category)
                                            <li>
                                                <a style="font-weight:bold;"
                                                   href="{{ route('front-end.shop-grid',['category_id' => $category->id,'product_id' => 0]) }}">
                                                    <i class="bi {{ $category->icon  }}"></i>
                                                    <span class="mx-2">{{ $category->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate
                           href="{{ route('front-end.shop-grid',['category_id' => 0,'product_id' => 0]) }}">
                            Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('front-end.store') }}">
                            Store
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('front-end.search') }}">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('front-end.about-us') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" wire:navigate href="{{ route('front-end.contact') }}">Contact</a>
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
