<?php

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public $products;

    public function mount()
    {
        $this->getProducts();
    }

    public function getProducts()
    {
        $this->products = Product::with('product_variations')->get();
    }

    #[On('delete-product')]
    public function deleteProduct($product_id)
    {
        DB::beginTransaction();
        try {

            $this->getProducts();

            $product = ProductVariation::find($product_id);

            if (!$product) {
                throw new Exception("Category with ID $product_id not found.");
            }

            $product->delete();
            DB::commit();

            $this->getProducts();
            $this->alert('success', 'Product Deleted Successfully');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
        }

    }

}; ?>

@push('css')
    <style>
        .description-column {
            max-width: 200px; /* Adjust the width as per your design */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .description-column.wrap {
            white-space: normal;
            word-break: break-word;
        }

        .name-column {
            max-width: 100px; /* Adjust the width as per your design */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .name-column.wrap {
            white-space: normal;
            word-break: break-word;
        }

        .variation-column {
            max-width: 100px; /* Adjust the width as per your design */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .variation-column.wrap {
            white-space: normal;
            word-break: break-word;
        }
    </style>
@endpush

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
                                    <div class="table-responsive">
                                        <table id="products_table"
                                               class="table table-bordered dt-responsive nowrap w-100">
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
                                                        <td class="name-column">{{ strtoupper($product->name) }}</td>
                                                        <td class="description-column">{{ $product->description }}</td>
                                                        <td>{{ $product->category->name }}</td>
                                                        <td class="variation-column " >{{ empty($product_variation->variation()) ? 'None' :  $product_variation->variation()->name.'-'.$product_variation->variation()->value }}</td>
                                                        <td>{{ $product_variation->price }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                        class="btn btn-primary dropdown-toggle"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" wire:navigate
                                                                       href="{{ route('dashboard.edit-product', $product_variation->id) }}">
                                                                        <i class="mdi mdi-pencil font-size-16"></i> Edit
                                                                    </a>
                                                                    <button class="dropdown-item deleteProduct"
                                                                            data-id="{{ $product_variation->id }}">
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
        </div>
    </div><!-- end row-->
</div><!-- end row -->
@push('js')
    <script>
        document.addEventListener("livewire:navigated", function () {
            $(document).on('click', '.deleteProduct', function () {
                let clickedID = $(this).data('id');
                console.log(clickedID);

                if (confirm("Are you sure ?")) {
                    Livewire.dispatch('delete-product', {product_id: clickedID});
                }
            });

        });
    </script>
@endpush

