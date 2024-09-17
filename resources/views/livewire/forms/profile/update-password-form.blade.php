<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Update Password') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Ensure your account is using a long, random password to stay secure.") }}
            </p>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="updatePassword" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="update_password_current_password" class="form-label">Current Password</label>
                            <input wire:model="current_password" id="update_password_current_password"
                                   name="current_password" type="password" class="form-control">
                            <x-input-error :messages="$errors->get('current_password')" class="mt-2"/>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="update_password_password" class="form-label">New Password</label>
                            <input class="form-control" wire:model="password" id="update_password_password"
                                   name="password" type="password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="update_password_password_confirmation" class="form-label">Confirm
                                Password</label>
                            <input class="form-control" wire:model="password_confirmation"
                                   id="update_password_password_confirmation" name="password_confirmation"
                                   type="password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">
                        <span wire:loading.remove>Update Password</span>
                        <span wire:loading>Loading...</span>
                    </button>
                    <x-action-message class="me-3" on="password-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </form>
            </div>
        </div>
    </div>
</div>


