<?php

use App\Models\Category;
use App\Models\Portfolio;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public function with()
    {
        return [
            'portfolios' => Portfolio::all()
        ];
    }

}; ?>

<!--start page content-->
@push('css')
    <style>
        .card {
            height: 420px; /* Set a fixed height for the card */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-10px);
            transition: transform 0.2s ease-in-out;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 230px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1rem;
            color: #666;
        }
    </style>
@endpush
<div class="page-content">
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Portfolio</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class=""><a class="text-decoration-none" href="javascript:;">Home <i
                                        class="mx-1 bi bi-chevron-right"></i></a>
                            </li>
                            <li class=""><a class="text-decoration-none" href="javascript:;">portfolio</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start shop categories-->
    <section class="py-4">
        <div class="container my-5">
            <div class="row">
                <!-- Client Work 1 -->
                <div class="col-md-4 mb-4">
                    @foreach($portfolios as $portfolio)
                        <div class="card">
                            <img src="{{ asset('storage/' . $portfolio->image_url) }}" class="card-img-top"
                                 alt="Client Work Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $portfolio->name }}</h5>
                                <p class="card-text">{{ $portfolio->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--end shop categories-->
</div>
<!--end page content-->

