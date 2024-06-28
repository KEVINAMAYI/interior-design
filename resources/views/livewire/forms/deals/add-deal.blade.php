<?php

use App\Models\Deal;
use App\Models\Product;
use App\Models\ProductDeal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use LivewireAlert, WithFileUploads;

    public $name;
    public $discount_off;
    public $discounted_products_ids;
    public $banner;

    public function rules()
    {
        return [
            'name' => 'required',
            'discount_off' => 'required',
            'discounted_products_ids' => 'required',
            'banner' => 'required'
        ];
    }

    public function with()
    {
        return [
            'products' => Product::all()
        ];
    }

    /**
     * Create Deal.
     */
    public function createDeal(): void
    {
        DB::beginTransaction();
        try {

            $name = time() . '-' . $this->banner->hashName();
            $path = $this->banner->storeAs('deals_banners', $name);

            $deal = Deal::create([
                'name' => $this->name,
                'discount_off' => $this->discount_off,
                'banner_url' => $path,
            ]);

            $this->saveDealProducts($deal);

            DB::commit();
            $this->reset();
            $this->alert('success', 'Deal created successfully');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
        }
    }


    /**
     * Save Product Tags if the product has any
     */
    public function saveDealProducts($deal)
    {
        if (!empty($this->discounted_products_ids)) {
            foreach ($this->discounted_products_ids as $discounted_products_id) {
                ProductDeal::create([
                    'deal_id' => $deal->id,
                    'product_id' => $discounted_products_id,
                ]);
            }
        }
    }


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Deal') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createDeal" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-12">

                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">
                            @error('discount_off')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="discount_off" class="form-label">Discount Off (%)</label>
                            <input wire:model="discount_off" id="discount_off" class="form-control" type="number"
                                   required autofocus autocomplete="name">
                            @error('discount_off')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div wire:ignore class="mb-4 col-lg-12">
                            <label for="discounted_products" class="form-label">Products</label>
                            <select class="form-control discounted_products" wire:model="discounted_products_ids"
                                    multiple>
                                @foreach($products as $product)
                                    <option
                                        value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('discounted_products_ids')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="banner" class="form-label">Deal Banner (jpg,jpeg,png)</label>
                            <input class="form-control" wire:model="banner" id="banner" type="file"
                                   autocomplete="images">
                            @error('banner')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Deal</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener("livewire:navigated", function () {
            const discountedProducts = new Choices(".discounted_products", {removeItemButton: !0});
            discountedProducts.passedElement.element.addEventListener('change', function (event) {
                const result = $('.discounted_products').val();
            @this.set('discounted_products_ids', result);
            })
        })
    </script>
@endpush

