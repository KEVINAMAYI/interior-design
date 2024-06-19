<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {

    public $category;
    public $description;

    /**
     * Add product Category.
     */
    public function addProduct(): void
    {
    }


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Role') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="addProduct" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-12">

                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>

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
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Permissions</label>
                            <div style="width: 100%; height:150px; border-radius:5px; padding:10px;  border:1px solid grey;"  name="" id="">
                               <button type="submit" class="btn btn-outline-secondary waves-effect">add user</button>

                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Role</button>
                </form>
            </div>
        </div>
    </div>
</div>

