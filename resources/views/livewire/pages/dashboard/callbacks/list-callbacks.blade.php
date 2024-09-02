<?php

use App\Models\CallBack;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public $callbacks = [];

    public function mount(){
        $this->getCallBacks();
    }


    public function getCallBacks(){
        $this->callbacks = CallBack::all();
    }


    #[On('delete-callback')]
    public function deleteCallBack($category_id)
    {
        DB::beginTransaction();
        try {

            CallBack::find($category_id)->delete();
            DB::commit();

            $this->getCallBacks();
            $this->alert('success', 'Callback deleted successfully');

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
                <livewire:layout.dashboard.site-map page="List-CallBacks"/>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('List Callbacks') }}
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <table id="customers_table" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($callbacks as $callback)
                                            <tr>
                                                <td>{{ $callback->first_name }}</td>
                                                <td>{{ $callback->last_name }}</td>
                                                <td>{{ $callback->phone_number }}</td>
                                                <td>
                                                    <span
                                                        class="badge btn-rounded badge-pill {{ $callback->status === 'pending' ? 'bg-warning' :'bg-success'}} ">
                                                    {{ $callback->status }}
                                                </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false">Action
                                                            <i class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#"> <i
                                                                    class="mdi mdi-pencil-box font-size-16"></i> Update
                                                                status</a>
                                                            <button data-id="{{ $callback->id }}"
                                                                    class="deleteCallBack dropdown-item"><i
                                                                    class="mdi mdi-trash-can font-size-16"></i> Delete
                                                            </button>
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
             $(document).on('click', '.deleteCallBack', function () {
                let clickedID = $(this).data('id');

                console.log(clickedID)
                Livewire.dispatch('delete-callback', {category_id: clickedID});
            })
        });
    </script>
@endpush

