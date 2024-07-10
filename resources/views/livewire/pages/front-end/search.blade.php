<?php

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $search;
    public $products;

    public function with()
    {
        return [
            'categories' => Category::all(),
            'search_products' => Product::with(['category', 'product_variations'])->get()
        ];
    }

    #[Computed(cache: true)]
    public function initial_products_data()
    {
        return Product::orderBy('id', 'desc')->take(10)->get()->toArray();
    }


    #[On('search-products')]
    public function searchProducts()
    {
        if (!empty($this->search)) {

            $this->products = Product::where(function ($p) {
                $p->where("name", "like", "%" . $this->search . "%")
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', "%$this->search%");
                    });
            })->with(['category', 'product_variations'])->take(10)->get()->toArray();

        } else {

            $this->products = $this->initial_products_data();
            $this->dispatch('products-search-empty');
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->dispatch('close-search-bar');
    }

}; ?>

<!--start page content-->
@push('css')
    <style>
        .the-dropdown-block {
            position: relative;
        }

        .the-dropdown-list {
            background-color: #fff;
            z-index: 10;
            list-style: none;
            padding: 4px;
            max-height: 180px;
            overflow: auto;
            position: absolute;
            width: 100%;
            border: #ddd solid 1px;
            border-top: none !important;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        .the-dropdown-item {
            padding: 5px 20px;
            margin: 0;
            cursor: pointer;
        }

        .the-dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .the-dropdown-select {
            display: block;
            width: 100%;
            padding: 0.25rem 0.375rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.4rem;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d2d6da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.5rem;
            transition: box-shadow 0.15s ease, border-color 0.15s ease;
        }

        .the-dropdown-select .the-dropdown-input {
            border: none !important;
            background: none !important;
            padding: inherit;
            width: 100% !important;
        }

        .the-dropdown-select .the-dropdown-input:focus {
            outline: none !important;
        }

        .the-dropdown-select .icon {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .the-dropdown-select .icon i {
            font-size: 0.75rem;
        }

    </style>
@endpush
<div class="page-content">
    <section class="section-padding bg-section-2">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="">
                    <h3 class="mb-0 fw-bold">Search Products</h3>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn-close" wire:click="clearSearch" aria-label="Close"></button>
                </div>
            </div>
            <div class="search-box position-relative mt-4">
                <div class="position-absolute position-absolute top-50 end-0 translate-middle ms-4 fs-5"><i
                        class="bi bi-search"></i></div>
                <input
                    @focus="$dispatch('search-products')"
                    wire:keyup="$dispatch('search-products')"
                    wire:model="search"
                    class="form-control the-dropdown-input form-control-lg ps-5 rounded-0" type="text"
                    placeholder="Type here to search">
                <ul wire:loading class="the-dropdown-list searching shadow-sm">
                    <li class="the-dropdown-item searching">Searching...</li>
                </ul>
                <ul wire:loading.remove x-data="{ type: 'none' }" x-init="
                  @this.on('products-search-empty', data => { type = 'block'; });
                  @this.on('close-search-bar', data => { type = 'none'; });
                  @this.on('search-products', data => { type = 'block'; });" x-bind:style="'display: ' + type"
                    class="the-dropdown-list clients-list shadow-sm">
                    @if(!empty($products))
                        @foreach($products as $product)
                            <a style="text-decoration:none; " href="{{ route('front-end.product-details') }}">
                                <li wire:key="{{ $product['id'] }}"
                                    class="the-dropdown-item">
                                    {{ $product['name'] }}
                                </li>
                            </a>
                        @endforeach
                    @else
                        @if(!empty($search))
                            <li class="the-dropdown-item">No Results</li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container">
            <h5 class="mb-0 fw-bold">Explore by categories</h5>
            <div class="search-categories mt-4">
                <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-5 g-4">
                    @foreach($categories as $category)

                        <a style="text-decoration:none;"
                           href="{{ route('front-end.shop-grid',['category_id' => $category->id,'product_id' => 0]) }}">
                            <div class="col">
                                <div class="card border-0 rounded-0 shadow {{ 'bg-'.$category->color }}">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h5 class="mb-0 fw-bold text-white">{{ $category->name }}</h5>
                                            </div>
                                            <div class="ms-auto fs-1 text-white">
                                                <i class="bi {{ $category->icon }}"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div><!--end row-->

                <h5 class="fw-bold mb-3 mt-5">Trending Searches</h5>
                <div class="row">
                    @foreach($search_products as $product)
                        <div class="col-lg-3 col-sm-6 col-md-6">
                            <div class="list-group list-group-flush search-categories">
                                <a href="{{ route('front-end.product-details') }}"
                                   class="list-group-item list-group-item-action py-3"><i
                                        class="bi bi-arrow-up-right me-2"></i>{{ $product->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div><!--end row-->


            </div>
        </div>
    </section>
</div>
<!--end page content-->
@script
<script type="text/javascript">
    $(document).ready(function () {

        //close dropdown on clicking outside
        $(document).on('click', function (event) {
            if ($(event.target).closest(".the-dropdown-input, .the-select-btn").length)
                return;
            let dropdown = $(document).find('.the-dropdown-list');
            $(dropdown).attr('style', 'display: none !important');
            event.stopPropagation();
        });

    });
</script>
@endscript

