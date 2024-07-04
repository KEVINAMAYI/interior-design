<?php

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public function with()
    {
        return [
            'categories' => Category::orderBy('name','DESC')->get()
        ];
    }

}; ?>

<!--start page content-->
<div class="page-content">
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Shop Categories</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class=""><a class="text-decoration-none" href="javascript:;">Home <i class="mx-1 bi bi-chevron-right"></i></a>
                            </li>
                            <li class=""><a class="text-decoration-none" href="javascript:;">Shop <i class="mx-1 bi bi-chevron-right"></i></a>
                            </li>
                            <li class=" text-decoration-none mx-1 active" aria-current="page">Shop Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start shop categories-->
    <section class="py-4">
        <div class="container">
            <div class="product-categories">
                <div class="row row-cols-1 row-cols-lg-4 g-5">
                    @foreach($categories as $category)
                        <div class="col">
                            <div class="card">
                                <a href="javascript:;">
                                    <img src="front-end-assets/images/sliders/s_2.webp"
                                         class="card-img-top border-bottom bg-dark-1" alt="...">
                                </a>
                                <div class="list-group list-group-flush">
                                    <a href="javascript:;" class="list-group-item bg-transparent">
                                        <h6 class="mb-0 text-uppercase">{{ $category->name }}</h6>
                                    </a>
                                    @foreach($category->products as $product)
                                        <a  href="{{ route('front-end.shop-grid',[$category->id, $product->id]) }}"
                                           class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $product->name }}
                                            <span style="font-size:10px;" class="badge bg-success rounded-pill">Available</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--end shop categories-->
</div>
<!--end page content-->

