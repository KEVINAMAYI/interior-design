<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {
}; ?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <livewire:layout.dashboard.site-map page="Add-Staff"/>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <livewire:forms.staff.add-staff/>
                    </div>
                </div>
            </div>

        </div>

    </div><!-- end row-->

</div><!-- end row -->

