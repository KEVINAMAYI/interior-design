<?php

use App\Models\Variation;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public $variations;

    public function mount()
    {
        $this->getVariations();
    }

    public function getVariations()
    {
        $this->variations = Variation::all();
    }

    #[On('delete-variation')]
    public function deleteVariation($variation_id)
    {
        DB::beginTransaction();
        try {

            $this->getVariations();

            $variation = Variation::find($variation_id);

            if (!$variation) {
                throw new Exception("Variation with ID $variation_id not found.");
            }

            $variation->delete();
            DB::commit();

            $this->getVariations();
            $this->alert('success', 'Variation deleted successfully');

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
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false">Action
                                                            <i class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" wire:navigate
                                                               href="{{ route('dashboard.edit-variation',$variation->id) }}">
                                                                <i class="mdi mdi-pencil font-size-16"></i> Edit </a>
                                                            <a style="cursor:pointer;"
                                                               class="dropdown-item deleteVariation"
                                                               data-id="{{ $variation->id }}"> <i
                                                                    class="mdi mdi-trash-can font-size-16"></i>
                                                                Delete</a>
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
@push('js')
    <script>
        document.addEventListener("livewire:navigated", function () {
            $(document).off('click.deleteVariation').on('click.deleteVariation', '.deleteVariation', function () {
                let clickedID = $(this).data('id');
                console.log(clickedID);

                if (confirm("Are you sure?")) {
                    Livewire.dispatch('delete-variation', {variation_id: clickedID});
                }
            });
        });
    </script>
@endpush
