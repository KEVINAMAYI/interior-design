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
                <livewire:layout.dashboard.site-map page="List-Deals"/>

            </div>

        </div>

    </div><!-- end row-->

</div><!-- end row -->
</div>
<!-- container-fluid -->
</div>
</div>
