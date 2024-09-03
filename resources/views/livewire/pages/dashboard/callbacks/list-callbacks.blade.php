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
    public $status = 'pending';
    public $callback_id = '';

    public function mount()
    {
        $this->getCallBacks();
    }


    public function getCallBacks()
    {
        $this->callbacks = CallBack::all();
    }


    #[On('update-status')]
    public function updateStatus($callback_id, $status)
    {
        DB::beginTransaction();
        try {


            CallBack::find($callback_id)->update([
                'status' => $status
            ]);
            DB::commit();

            $this->getCallBacks();
            $this->alert('success', 'Status updated successfully');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
        }
    }


    #[On('delete-callback')]
    public function deleteCallBack($callback_id)
    {
        DB::beginTransaction();
        try {

            $this->getCallBacks();

            $callback = CallBack::find($callback_id);

            if (!$callback) {
                throw new Exception("Callback with ID $callback_id not found.");
            }

            $callback->delete();
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
                                    <table id="callbacks_table" class="table table-bordered dt-responsive nowrap w-100">
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
                                                            <button class="updateCallBack dropdown-item"
                                                                    data-id="{{ $callback->id }}"><i
                                                                    class="mdi mdi-pencil-box font-size-16"></i> Update
                                                                status
                                                            </button>
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

    <div wire:ignore.self class="modal fade" id="callBackModal" tabindex="-1" aria-labelledby="callBackModalLabel"
         aria-hidden="true">
        <form>
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="callBackModalLabel">Update Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12 col-sm-12">
                                <div style="padding-left:15px;" class="mb-3 row col-lg-12">
                                    <input type="hidden" id="callback_id" value="">
                                    <select id="status_val" class="form-select">
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div><!-- end row -->

@push('js')
    <script>
        document.addEventListener("livewire:navigated", function () {
            $(document).on('click', '.deleteCallBack', function () {
                let clickedID = $(this).data('id');
                console.log(clickedID)
                Livewire.dispatch('delete-callback', {callback_id : clickedID});
            })

            $(document).on('click', '.updateCallBack', function () {
                let clickedID = $(this).data('id');
                $('#callback_id').val(clickedID);
                $('#callBackModal').modal('show');
            })

            // Handle form submission
            $('#callBackModal form').on('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission
                let clickedID = $('#callback_id').val();
                let status = $('#status_val').val();
                Livewire.dispatch('update-status', {callback_id: clickedID, status: status});
            });

        });
    </script>
@endpush

