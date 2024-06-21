<?php

use App\Models\Category;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {

    public $name;
    public $price;
    public $images;
    public $variations;
    public $category_id;
    public $description;
    public $selling_tags;
    public $variation_id;

    public function mount()
    {
        $this->variations = Variation::all();
    }

    public function with()
    {
        return [
            'categories' => Category::all()
        ];
    }

    /**
     * Add product.
     */
    public function createProduct()
    {
    }

    /**
     * Returns Variations Based on Category
     */
    public function getCategoryVariations()
    {
        $category_slug = Category::where('id', $this->category_id)->first();

        $this->variations = Variation::all();

        if ($category_slug == 'grass_carpet') {
            $this->variations = Variation::where('name', 'height')->get();
        }

    }


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Product') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createProduct" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select id="category_id" wire:model="category_id" wire:change="getCategoryVariations"
                                    class="form-select">
                                <option>Select</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" wire:model="name" id="email" type="text"
                                   autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea style="width:100%" wire:model="description" id="" cols="50" rows="5"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="variation_id" class="form-label">Variations</label>
                            <select id="variation_id" wire:model="variation_id" class="form-select">
                                <option>Select</option>
                                @foreach($variations as $variation)
                                    <option
                                        value="{{ $variation->id }}">{{ $variation->name.'-'.$variation->value }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>

                        <div class="mb-4 col-lg-6">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control" wire:model="price" id="price" type="text"
                                   autocomplete="price">
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="tags" class="form-label">Tags</label>
                            <input class="form-control" wire:model="tags" id="tags" name="tags" type="text"
                                   autocomplete="tags">
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="images" class="form-label">Images</label>
                            <div class="dropzone">
                                {{--                                <div  class="fallback">--}}
                                {{--                                    <input name="file" type="file" multiple="multiple">--}}
                                {{--                                </div>--}}
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                    </div>

                                    <h5>Drop files here or click to upload.</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

