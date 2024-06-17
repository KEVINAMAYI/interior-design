<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};


?>

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-apps">Product Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a wire:navigate href="{{ route('dashboard.list-categories') }}">
                                <i data-feather="list"></i>
                                <span data-key="t-calendar">List Category</span>
                            </a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('dashboard.add-category') }}">
                                <i data-feather="plus-circle"></i>
                                <span data-key="t-chat">Add Category</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a wire:navigate href="{{ route('dashboard.list-products') }}">
                                <i data-feather="list"></i>
                                <span data-key="t-calendar">List Products</span>
                            </a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('dashboard.add-product') }}">
                                <i data-feather="plus-circle"></i>
                                <span data-key="t-chat">Add Product</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="copy"></i>
                        <span data-key="t-apps">Variations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a wire:navigate href="{{ route('dashboard.list-variations') }}">
                                <i data-feather="list"></i>
                                <span data-key="t-calendar">List Variations</span>
                            </a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('dashboard.add-variation') }}">
                                <i data-feather="plus-circle"></i>
                                <span data-key="t-chat">Add Variation</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-apps">Staff</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a wire:navigate href="{{ route('dashboard.list-staff') }}">
                                <i data-feather="list"></i>
                                <span data-key="t-calendar">List Staff</span>
                            </a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('dashboard.add-staff') }}">
                                <i data-feather="plus-circle"></i>
                                <span data-key="t-chat">Add Staff</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="user-check"></i>
                        <span data-key="t-apps">Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a wire:navigate href="{{ route('dashboard.list-customers') }}">
                                <i data-feather="list"></i>
                                <span data-key="t-calendar">List Customers</span>
                            </a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('dashboard.add-customer') }}">
                                <i data-feather="plus-circle"></i>
                                <span data-key="t-chat">Add Customer</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="user-plus"></i>
                        <span data-key="t-apps">Roles</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a wire:navigate href="{{ route('dashboard.list-roles') }}">
                                <i data-feather="list"></i>
                                <span data-key="t-calendar">List Roles</span>
                            </a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('dashboard.add-role') }}">
                                <i data-feather="plus-circle"></i>
                                <span data-key="t-chat">Add Roles</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="shopping-bag"></i>
                        <span data-key="t-apps">Deals</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a wire:navigate href="{{ route('dashboard.list-deals') }}">
                                <i data-feather="list"></i>
                                <span data-key="t-calendar">List Deals</span>
                            </a>
                        </li>

                        <li>
                            <a wire:navigate href="{{ route('dashboard.add-deal') }}">
                                <i data-feather="plus-circle"></i>
                                <span data-key="t-chat">Add Deals</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{ route('dashboard.profile') }}" wire:navigate>
                        <i data-feather="user"></i>
                        <span data-key="t-apps">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#" wire:click="logout">
                        <i data-feather="log-out"></i>
                        <span data-key="t-apps">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
