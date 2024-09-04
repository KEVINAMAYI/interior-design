<?php

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;

new #[Layout('layouts.dashboard')] class extends Component {

    use LivewireAlert;

    public $roles;

    public function mount()
    {
        $this->getRoles();
    }

    public function getRoles()
    {
        $this->roles = Role::all();
    }


    #[On('delete-role')]
    public function deleteRole($role_id)
    {
        DB::beginTransaction();
        try {

            $this->getRoles();

            $role = Role::find($role_id);

            if (!$role) {
                throw new Exception("Role with ID $role_id not found.");
            }

            $role->delete();
            DB::commit();

            $this->getRoles();
            $this->alert('success', 'Role deleted successfully');

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
                <livewire:layout.dashboard.site-map page="List-Roles"/>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('List Roles') }}
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <table id="roles_table" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->description }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                                class="btn btn-primary dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action <i class="mdi mdi-chevron-down"></i></button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item deleteRole"
                                                                    data-id="{{ $role->id }}">
                                                                <i class="mdi mdi-trash-can font-size-16"></i>
                                                                Delete
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
            $(document).off('click.deleteRole').on('click.deleteRole', '.deleteRole', function () {
                let clickedID = $(this).data('id');
                console.log(clickedID);
                if (confirm("Are you sure?")) {
                    Livewire.dispatch('delete-role', {role_id: clickedID});
                }
            });
        });
    </script>
@endpush

