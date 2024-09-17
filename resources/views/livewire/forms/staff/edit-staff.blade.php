<?php

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {

    use LivewireAlert;


    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $user_name;
    public $password;
    public $user;

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'phone_number' => 'required|unique:staff',
            'user_name' => 'required',
        ];
    }

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
        $this->user_name = $this->user->user_name;
        $this->email = $this->user->email;
        $this->password = "";
        $this->first_name = $this->user->staff->first_name;
        $this->last_name = $this->user->staff->last_name;
        $this->phone_number = $this->user->staff->phone_number;
    }


    public function updateStaff()
    {

        $this->validate();

        DB::begintransaction();
        try {

            $this->user->update([
                'user_name' => $this->user_name,
                'email' => $this->email
            ]);

            if (!empty($this->password)) {
                $this->user->update([
                    'password' => $this->password
                ]);
            }

            $this->user->staff->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone_number' => $this->phone_number
            ]);

            DB::commit();
            $this->alert('success', 'Staff Updated Successfully');

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
                {{ __('Edit Staff') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="updateStaff" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input wire:model="first_name" id="first_name" class="form-control" type="text"
                                   autofocus autocomplete="first_name">
                            @error('first_name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror

                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input wire:model="last_name" id="last_name" class="form-control" type="text"
                                   autofocus autocomplete="last_name">
                            @error('last_name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror

                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="email" class="form-label">Email</label>
                            <input wire:model="email" id="email" class="form-control" type="text"
                                   autofocus autocomplete="email">
                            @error('email')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror

                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input wire:model="phone_number" id="phone_number" class="form-control" type="text"
                                   autofocus autocomplete="phone_number">
                            @error('phone_number')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="user_name" class="form-label">User Name</label>
                            <input wire:model="user_name" id="user_name" class="form-control" type="text"
                                   autofocus autocomplete="user_name">
                            @error('user_name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="password" class="form-label">New Password (If Left Blank, the user will retain
                                the initial password)</label>
                            <input wire:model="password" id="password" class="form-control" type="text"
                                   autofocus autocomplete="name">
                            @error('password')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">
                        <span wire:loading.remove>Update Staff</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

