<?php

use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public $staffs;

    public function mount()
    {
        $this->getStaff();
    }


    public function getStaff()
    {
        $this->staffs = Staff::all();
    }


    #[On('delete-staff')]
    public function deleteVariation($staff_id)
    {
        DB::beginTransaction();
        try {

            $this->getStaff();

            $staff = Staff::find($staff_id);

            if (!$staff) {
                throw new Exception("Staff with ID $staff_id not found.");
            }

            $staff->delete();
            $staff->user->delete();

            DB::commit();

            $this->getStaff();
            $this->alert('success', 'Staff deleted successfully');

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
                <livewire:layout.dashboard.site-map page="List-Staff"/>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('List Staff') }}
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <table id="staff_table" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $staffs as $staff)
                                            <tr>
                                                <td>{{ $staff->first_name }}</td>
                                                <td>{{ $staff->last_name }}</td>
                                                <td>{{ $staff->phone_number }}</td>
                                                <td>{{ $staff->user->email }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false">Action
                                                            <i class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" wire:navigate
                                                               href="{{ route('dashboard.edit-staff',$staff->user->id) }}">
                                                                <i class="mdi mdi-pencil font-size-16"></i> Edit </a>
                                                            <a style="cursor:pointer;" class="dropdown-item deleteStaff"
                                                               data-id="{{ $staff->id }}"> <i
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
            $(document).off('click.deleteStaff').on('click.deleteStaff', '.deleteStaff', function () {
                let clickedID = $(this).data('id');
                console.log(clickedID);

                if (confirm("Are you sure?")) {
                    Livewire.dispatch('delete-staff', {staff_id: clickedID});
                }
            });
        });
    </script>
@endpush

