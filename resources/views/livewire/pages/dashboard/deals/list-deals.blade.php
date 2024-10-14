<?php

use App\Models\Category;
use App\Models\Deal;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public $deals;

    public function mount()
    {
        $this->getDeals();
    }

    public function getDeals(){
        $this->deals = Deal::all();
    }

    #[On('delete-deal')]
    public function deleteDeal($deal_id)
    {
        DB::beginTransaction();
        try {

            $this->getDeals();

            $deal = Deal::find($deal_id);

            if (!$deal) {
                throw new Exception("Deal with ID $deal_id not found.");
            }

            $deal->delete();
            DB::commit();

            $this->getDeals();
            $this->alert('success', 'Deal deleted successfully');

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
                <livewire:layout.dashboard.site-map page="List-Deals"/>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('List Deals') }}
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <table id="categories_table"
                                           class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Discount Off</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deals as $deal)
                                            <tr>
                                                <td>{{ $deal->name }}</td>
                                                <td>{{ $deal->discount_off }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a style="cursor:pointer;" class="dropdown-item deleteDeal" data-id="{{ $deal->id }}"> <i class="mdi mdi-trash-can font-size-16"></i> Delete</a>
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
            $(document).off('click.deleteDeal').on('click.deleteDeal', '.deleteDeal', function () {
                let clickedID = $(this).data('id');
                console.log(clickedID);

                if (confirm("Are you sure ?")) {
                    Livewire.dispatch('delete-deal', {deal_id: clickedID});
                }
            });

        });
    </script>
@endpush

