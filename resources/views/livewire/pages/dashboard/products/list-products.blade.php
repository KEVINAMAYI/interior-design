<?php

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public function with()
    {
        return [
            'products' => Product::with('product_variations')->get()
        ];
    }

    public function deleteProduct($product_id)
    {
        try {
            DB::beginTransaction();
            Product::where('id', $product_id)->delete();
            DB::commit();
            $this->alert('success', 'Product Deleted Successfully');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
        }

    }

}; ?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <livewire:layout.dashboard.site-map page="List-Products"/>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('List Products') }}
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <table id="products_table" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Variation</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            @foreach($product->product_variations as $product_variation)
                                                <tr>
                                                    <td>{{ strtoupper($product->name) }}</td>
                                                    <td style="word-wrap: break-word; white-space: normal;">{{ $product->description }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ empty($product_variation->variation()) ? 'None' :  $product_variation->variation()->name.'-'.$product_variation->variation()->value }}</td>
                                                    <td>{{ $product_variation->price }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                Action <i class="mdi mdi-chevron-down"></i></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#"> <i
                                                                        class="mdi mdi-eye font-size-16"></i> View</a>
                                                                <a class="dropdown-item" href="#"> <i
                                                                        class="mdi mdi-pencil font-size-16"></i> Edit
                                                                </a>
                                                                <button class="dropdown-item"
                                                                        wire:click="deleteProduct({{ $product->id }})">
                                                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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

