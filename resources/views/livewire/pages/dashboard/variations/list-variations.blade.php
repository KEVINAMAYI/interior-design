<?php

use App\Models\Variation;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    public function with()
    {
        return [
            'variations' => Variation::all()
        ];
    }

}; ?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <livewire:layout.dashboard.site-map page="List-Variations"/>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('List Variations') }}
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <table id="variations_table"
                                           class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($variations as $variation)
                                            <tr>
                                                <td>{{ $variation->name }}</td>
                                                <td>{{ $variation->type }}</td>
                                                <td>{{ $variation->value }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#"> <i class="mdi mdi-eye font-size-16"></i> View</a>
                                                            <a class="dropdown-item" href="#"> <i class="mdi mdi-pencil font-size-16"></i> Edit </a>
                                                            <a class="dropdown-item" href="#"> <i class="mdi mdi-trash-can font-size-16"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row-->
</div><!-- end row -->

