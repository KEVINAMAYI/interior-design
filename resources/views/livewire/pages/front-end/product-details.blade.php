<?php

use App\Models\CallBack;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Illuminate\Validation\Rule;


new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $productVariation;
    public $first_name;
    public $last_name;
    public $phone_number;
    public $product_ratings;
    public $product_avg_rating;
    public $product_count_rating;
    public $similar_product;


    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
        ];
    }

    public function mount(ProductVariation $product_variation)
    {
        $this->similar_product = Product::where('id',$product_variation->product->id)->first();
        $this->productVariation = $product_variation;
        $this->getRatingsData($product_variation->id);
    }


    #[On('get-ratings')]
    public function getRatingsData($product_variation_id)
    {
        $this->product_avg_rating = Rating::where('product_variation_id', $product_variation_id)->avg('ratings');
        $this->product_count_rating = Rating::where('product_variation_id', $product_variation_id)->count();
        $this->product_ratings = Rating::where('product_variation_id', $product_variation_id)->get();
    }


    public function createCallBack()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            CallBack::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone_number' => $this->phone_number
            ]);

            $this->reset(['first_name', 'last_name', 'phone_number']);
            $this->dispatch('close-modal');

            DB::commit();
            $this->alert('success', 'CallBack was requested Successfully');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', 'CallBack request failed');
        }

    }


}; ?>

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush

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
                                @if(count($productVariation->images()) > 1)
                                    @foreach($productVariation->images() as $image)
                                        <div class="col">
                                            <div class="img-thumb-container overflow-hidden position-relative"
                                                 data-fancybox="gallery">
                                                <img src="{{ asset('storage/' . $image->image_url) }}" class="img-fluid"
                                                     alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($productVariation->images() as $image)
                                        <div class="col-12">
                                            <div class="img-thumb-container overflow-hidden position-relative"
                                                 data-fancybox="gallery">
                                                <img src="{{ asset('storage/' . $image->image_url) }}" class="img-fluid"
                                                     alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div><!--end row-->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5">
                    <div class="product-info">
                        <h4 class="product-title fw-bold mb-1">{{ $productVariation->product->name }}</h4>
                        <div class="product-rating">
                            <div class="hstack gap-2 border p-1 mt-3 width-content">
                                <div><span class="rating-number">{{ $product_avg_rating }}</span><i
                                        class="bi bi-star-fill ms-1 text-warning"></i></div>
                                <div class="vr"></div>
                                <div>{{ $product_count_rating }} Ratings</div>
                            </div>
                        </div>
                        <hr>
                        <div class="product-price d-flex align-items-center gap-3">
                            <div class="h4 fw-bold">KES {{ $productVariation->price }}</div>
                            <div class="h5 fw-light text-muted text-decoration-line-through">$2089</div>
                            <div class="h4 fw-bold text-danger">(70% off)</div>
                        </div>
                        <p class="fw-bold mb-0 mt-1 text-success">inclusive of all taxes</p>
                        <hr class="my-3">
                        <div class="product-info">
                            <h6 class="fw-bold mb-3">Product Details</h6>
                            <p style="font-size:14px;" class="mb-1">{{ $productVariation->product->description }}</p>
                        </div>
                        <hr class="my-3">
                        <div class="customer-ratings">
                            <h6 class="fw-bold mb-3">Customer Ratings</h6>
                            <div class="d-flex align-items-center gap-4 gap-lg-5 flex-wrap flex-lg-nowrap">
                                <div class="">
                                    <h1 class="mb-2 fw-bold">{{ round($product_avg_rating,1) }}<span
                                            class="fs-5 ms-2 text-warning">
                                            @if(($product_avg_rating >= 1) && ($product_avg_rating < 2))
                                                <i class="bi bi-star-fill"></i>
                                            @elseif(($product_avg_rating >= 2) && ($product_avg_rating < 3))
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            @elseif(($product_avg_rating >= 3) && ($product_avg_rating < 4))
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            @elseif(($product_avg_rating >= 4) && ($product_avg_rating < 5))
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            @elseif($product_avg_rating == 5)
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            @endif
                                        </span>
                                    </h1>

                                </div>
                                <div class="vr d-none d-lg-block"></div>
                                <div class="w-100">
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">5</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: {{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',5)->count() ?? 0 / \App\Models\Rating::where('product_variation_id', $productVariation->id)->count() * 100   }}%"></div>
                                        </div>
                                        <p class="mb-0">{{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',5)->count() ?? 0 }}</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">4</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: {{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',4)->count() ?? 0 / \App\Models\Rating::where('product_variation_id', $productVariation->id)->count() * 100   }}%"></div>
                                        </div>
                                        <p class="mb-0">{{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',4)->count() ?? 0 }}</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">3</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                 style="width: {{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',3)->count() ?? 0 /  \App\Models\Rating::where('product_variation_id', $productVariation->id)->count() * 100   }}%"></div>
                                        </div>
                                        <p class="mb-0">{{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',3)->count() ?? 0 }}</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">2</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                 style="width: {{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',2)->count() ?? 0 / \App\Models\Rating::where('product_variation_id', $productVariation->id)->count() * 100   }}%"></div>
                                        </div>
                                        <p class="mb-0">{{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',2)->count() ?? 0 }}</p>
                                    </div>
                                    <div class="rating-wrrap hstack gap-2 align-items-center">
                                        <p class="mb-0">1</p>
                                        <div class=""><i class="bi bi-star"></i></div>
                                        <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                 style="width: {{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',1)->count() ?? 0 / \App\Models\Rating::where('product_variation_id', $productVariation->id)->count() * 100   }}%"></div>
                                        </div>
                                        <p class="mb-0">{{ \App\Models\Rating::where('product_variation_id', $productVariation->id)->where('ratings',1)->count() ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5 shadow-none mb-3 mb-lg-0 border-3 border-success">
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a target="_blank" style="font-weight:bold;"
                                   href="https://api.whatsapp.com/send?phone=254798692688"
                                   class="list-group-item d-flex  text-success  justify-content-between align-items-center bg-orange">WhatsApp
                                    <i class='bx bxl-whatsapp fs-5'></i></a>
                                <a style="font-weight:bold;" href="tel:+254798692688"
                                   class="list-group-item text-success d-flex justify-content-between align-items-center bg-transparent">Call
                                    - 0798692688 <i class='bx bx-phone-call fs-5'></i></a>
                                <button style="font-weight:bold;" type="button"
                                        class=" list-group-item d-flex text-success justify-content-between align-items-center bg-transparent "
                                        data-bs-toggle="modal" data-bs-target="#callBackModal">
                                    Request CallBack <i class='bx bx-phone-incoming fs-5'></i>
                                </button>
                                <button style="font-weight:bold;" type="button"
                                        class=" list-group-item d-flex text-success justify-content-between align-items-center bg-transparent "
                                        data-bs-toggle="modal" data-bs-target="#sendEmailModal">
                                    Send Email <i class='bx bx-mail-send fs-5'></i>
                                </button>
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
                        <a class="nav-link" data-bs-toggle="tab" href="#tags">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">Tags</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#reviews">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">({{ count($product_ratings) }}) Reviews
                                </div>
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
                                    <h5 class="mb-4">{{ count($product_ratings) }} Reviews For The Product</h5>
                                    <div class="review-list">
                                        @foreach($product_ratings as $product_rating)
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div
                                                        style="padding-top:5px; background-color:{{ $product_rating->generateRandomColor() }}; width:65px; height:65px; font-size: 35px; font-weight:bold;"
                                                        class="rounded-circle text-white  text-center">
                                                        {{ ucfirst(substr($product_rating->name, 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-11 px-4">
                                                    <div class="rates cursor-pointer fs-6">
                                                        @if($product_rating->ratings == '1')
                                                            <i class="bx bxs-star text-warning"></i>
                                                        @elseif($product_rating->ratings == '2')
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        @elseif($product_rating->ratings == '3')
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        @elseif($product_rating->ratings == '4')
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        @elseif($product_rating->ratings == '5')
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 justify-content-between  mb-2">
                                                        <h6 style="font-weight:bold;"
                                                            class="mb-0">{{ ucfirst($product_rating->name) }}</h6>
                                                        <h6 class="mb-0">{{ $product_rating->created_at->format('d-m-Y')}}</h6>
                                                    </div>
                                                    <p>{{ $product_rating->comments }}</p>
                                                </div>
                                            </div>
                                            <hr/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @livewire('pages.front-end.components.create-rating', ['product_variation_id' =>
                            $productVariation->id])
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
                    @foreach($similar_product->product_variations as $product_variation)
                        <div class="col">
                            <div class="card">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ route('front-end.product-details',$product_variation->id) }}">
                                        <img src="{{ asset('storage/' . $product_variation->images()[0]->image_url) }}"
                                             class="card-img-top"
                                             alt="...">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <p class="mb-1 product-short-name">{{ strtoupper( $similar_product->name) }}</p>
                                            <h6 class="mb-1"> {{ empty($product_variation->variation()) ? '' :  str_replace('_',' ',$product_variation->variation()->name).'-'.$product_variation->variation()->value }}</h6>
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
                                    <div
                                        class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                        <div class="h6 fw-bold">KES {{ $product_variation->price }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                 </div>
                <!--end row-->
            </div>

            {{--Email Modal--}}
            <livewire:pages.front-end.components.send-email/>

        </div>
    </section>
    <!--end product details-->

    <!-- callBackModal -->
    <div wire:ignore.self class="modal fade" id="callBackModal" tabindex="-1" aria-labelledby="callBackModalLabel"
         aria-hidden="true">
        <form wire:submit="createCallBack">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="callBackModalLabel">Request CallBack</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" id="first_name" class="form-control" wire:model="first_name">
                                    @error('first_name')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" id="last_name" class="form-control" wire:model="last_name">
                                    @error('last_name')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" id="phone_number" class="form-control" wire:model="phone_number">
                                    @error('phone_number')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#callBackModal').modal('hide');
            $('#sendEmailModal').modal('hide');
            location.reload();
        });
    </script>
@endpush
<!--end page content-->
