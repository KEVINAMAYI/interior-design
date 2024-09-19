<?php

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public $portfolios;

    public function mount()
    {
        $this->getPortfolios();
    }

    public function getPortfolios(){
        $this->portfolios = Portfolio::all();
    }

    #[On('delete-portfolio')]
    public function deletePortfolio($portfolio_id)
    {
        DB::beginTransaction();
        try {

            $this->getPortfolios();

            $portfolio = Portfolio::find($portfolio_id);

            if (!$portfolio) {
                throw new Exception("Portfolio with ID $portfolio_id not found.");
            }

            $portfolio->delete();
            DB::commit();

            $this->getPortfolios();
            $this->alert('success', 'Portfolio deleted successfully');

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
                <livewire:layout.dashboard.site-map page="List-Portfolios"/>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('List Portfolios') }}
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <table id="categories_table"
                                           class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($portfolios as $portfolio)
                                            <tr>
                                                <td>{{ $portfolio->name }}</td>
                                                <td>{{ $portfolio->description }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" wire:navigate href="{{ route('dashboard.edit-portfolio',$portfolio->id) }}"> <i class="mdi mdi-pencil font-size-16"></i> Edit </a>
                                                            <a style="cursor:pointer;" class="dropdown-item deletePortfolio" data-id="{{ $portfolio->id }}"> <i class="mdi mdi-trash-can font-size-16"></i> Delete</a>
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
            $(document).off('click.deletePortfolio').on('click.deletePortfolio', '.deletePortfolio', function () {
                let clickedID = $(this).data('id');
                console.log(clickedID);

                if (confirm("Are you sure ?")) {
                    Livewire.dispatch('delete-portfolio', {portfolio_id: clickedID});
                }
            });

        });
    </script>
@endpush

