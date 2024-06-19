<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {

    public $name;
    public $description;

    /**
     * Add product Category.
     */
    public function addProductCategory(): void
    {
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
                <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="example-text-input" class="form-label">Category</label>
                            <select class="form-select">
                                <option>Select</option>
                                <option>Large select</option>
                                <option>Small select</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="example-search-input" class="form-label">Name</label>
                            <input class="form-control" wire:model="email" id="email" name="email" type="email"
                                   autocomplete="username">
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea style="width:100%" name="" id="" cols="50" rows="5"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="example-text-input" class="form-label">Variations</label>
                            <select class="form-select">
                                <option>Select</option>
                                <option>Large select</option>
                                <option>Small select</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>

                        <div class="mb-4 col-lg-6">
                            <label for="example-search-input" class="form-label">Price</label>
                            <input class="form-control" wire:model="email" id="email" name="email" type="email"
                                   autocomplete="username">
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="example-search-input" class="form-label">Tags</label>
                            <input class="form-control" wire:model="email" id="email" name="email" type="email"
                                   autocomplete="username">
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="example-text-input" class="form-label">Images</label>
                            <div  class="dropzone">
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

