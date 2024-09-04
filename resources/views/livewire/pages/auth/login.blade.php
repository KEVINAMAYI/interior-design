<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard.index'));
    }
}; ?>

<div class="auth-full-page-content d-flex p-sm-5 p-4">

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div class="w-100">
        <div class="d-flex flex-column h-100">
            <div class="mb-4 mb-md-5 text-center">
                <a href="index.html" class="d-block auth-logo">
                    <img width="100"  src="front-end-assets/images/gsm_logo_transparent.png"   alt="" height="90">
                </a>
            </div>
            <div class="auth-content my-auto">
                <div class="text-center">
                    <h5 class="mb-0">Welcome Back !</h5>
                    <p class="text-muted mt-2">Sign in to continue to GSM Dashboard.</p>
                </div>
                <form wire:submit="login">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model="form.email" id="email" autofocus autocomplete="" required
                               class="form-control" placeholder="Enter Email">
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label">Password</label>
                            </div>
                        </div>

                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" wire:model="form.password" id="password" class="form-control" placeholder="Enter password"
                                   aria-label="Password" aria-describedby="password-addon" required autocomplete="current-password">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i
                                    class="mdi mdi-eye-outline"></i></button>
                            <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>

                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-check">
                                <input wire:model="form.remember" class="form-check-input" type="checkbox"
                                       id="remember-check">
                                <label class="form-check-label" for="remember-check">
                                    Remember me
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </form>
            </div>
            <div class="mt-4 mt-md-5 text-center">
                <p class="mb-0">©
                    <script>document.write(new Date().getFullYear())</script>
                    GSM . Crafted with <i class="mdi mdi-heart text-danger"></i> by Techqast
                </p>
            </div>
        </div>
    </div>
</div>
