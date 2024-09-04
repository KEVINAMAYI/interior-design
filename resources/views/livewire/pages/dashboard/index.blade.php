<?php

use App\Models\CallBack;
use App\Models\Category;
use App\Models\Product;
use App\Models\Staff;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    public $product_count;
    public $categories_count;
    public $staff_count;
    public $pending_callbacks_counts;
    public $completed_callbacks_counts;

    public function mount(){
        $this->product_count = Product::count();
        $this->categories_count = Category::count();
        $this->staff_count = Staff::count();
        $this->pending_callbacks_counts = CallBack::where('status','pending')->count();
        $this->completed_callbacks_counts = CallBack::where('status','completed')->count();
    }


}; ?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <livewire:layout.dashboard.site-map  page="Home"/>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block">Products</span>
                                    <h4 class="mb-3">
                                        <span >{{ $product_count  }}</span>
                                    </h4>
                                </div>

                                <div class="col-6">
                                    <i style="color:black;"  data-feather="grid"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block">Categories</span>
                                    <h4 class="mb-3">
                                        <span >{{ $categories_count  }}</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <i style="color:purple;"  data-feather="list"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col-->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block">Staff</span>
                                    <h4 class="mb-3">
                                        <span >{{ $staff_count  }}</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <i style="color:orange;"  data-feather="users"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block">Pending Callbacks</span>
                                    <h4 class="mb-3">
                                        <span >{{ $pending_callbacks_counts  }}</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <i style="color:red;"  data-feather="phone"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block">Completed Callbacks</span>
                                    <h4 class="mb-3">
                                        <span >{{ $completed_callbacks_counts  }}</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <i style="color:green;" data-feather="phone"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <livewire:layout.dashboard.footer/>

</div>
