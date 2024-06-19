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
                {{ __('Add Customer') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="addProduct" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">First Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>

                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Last Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">

                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Email</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>

                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Phone Number</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">

                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Staff</button>
                </form>
            </div>
        </div>
    </div>
</div>

