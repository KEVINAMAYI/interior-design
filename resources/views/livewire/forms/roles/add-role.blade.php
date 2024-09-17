<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

new class extends Component {

    use LivewireAlert;

    public $role_permissions = [];
    public $name;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'role_permissions' => 'required'
        ];
    }

    public function with()
    {
        return [
            'permissions' => Permission::all()
        ];
    }

    /**
     * Create a Role and Assign Permissions set by user
     */
    public function createRole()
    {
        $this->validate();

        DB::beginTransaction();
        try {

            $role = Role::create([
                'name' => $this->name,
                'description' => $this->description
            ]);

            //set permissions to role created
            foreach ($this->role_permissions as $permission) {
                $role->givePermissionTo($permission);
            }

            DB::commit();
            $this->reset();
            $this->alert('success', 'Role Created Successfully');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
        }

    }


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Role') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createRole" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-12">

                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   required autofocus autocomplete="name">
                            @error('name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea style="width:100%" wire:model="description" id="description" cols="50"
                                      rows="5"></textarea>
                            @error('description')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Permissions</label>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title-desc">Assign Permissions.(Click to Select Permission)</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    @foreach($permissions as $permission)
                                        <input type="checkbox" name="role_permissions[]" wire:model="role_permissions"
                                               value="{{ $permission->name }}" class="btn-check"
                                               id="{{ $permission->name }}" autocomplete="off">
                                        <label class="btn btn-outline-primary"
                                               for="{{ $permission->name }}">{{ $permission->name }}</label>
                                    @endforeach
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                            @error('roles_permissions')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                            </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">
                        <span wire:loading.remove>Add Role</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

