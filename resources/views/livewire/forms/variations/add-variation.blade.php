<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Variation') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="addProduct" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>

                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Type</label>
                            <select class="form-select">
                                <option>Select</option>
                                <option>Large select</option>
                                <option>Small select</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="name" class="form-label">value</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Variation</button>
                </form>
            </div>
        </div>
    </div>
</div>

