<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    public $variation_id;

    public function mount($variation_id)
    {
        $this->variation_id = $variation_id;
    }

}; ?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <livewire:layout.dashboard.site-map page="Add-Variation"/>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @livewire('forms.variations.edit-variation', ['variation_id' => $variation_id])
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row-->
</div><!-- end row -->

