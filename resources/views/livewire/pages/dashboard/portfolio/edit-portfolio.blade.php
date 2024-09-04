<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    public $portfolio_id;

    public function mount($portfolio_id)
    {
        $this->portfolio_id = $portfolio_id;

    }

}; ?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <livewire:layout.dashboard.site-map page="Edit-Portfolio"/>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @livewire('forms.portfolio.edit-portfolio', ['portfolio_id' => $portfolio_id])
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row-->
    </div><!-- end row -->
</div>
