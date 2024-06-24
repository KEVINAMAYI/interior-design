<?php

use App\Models\Customer;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Support\Facades\Auth;
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

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:staff',
            'phone_number' => 'required|unique:staff',
        ];
    }

    public function createCustomer()
    {

        $this->validate();

        DB::begintransaction();
        try {

            Customer::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone_number' => $this->phone_number
            ]);

            DB::commit();
            $this->alert('success', 'Customer Created Successfully');

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
                {{ __('Add Customer') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createCustomer" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input wire:model="first_name" id="first_name" class="form-control" type="text"
                                   autofocus autocomplete="name">
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
                                   autofocus autocomplete="name">
                            @error('phone_number')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Customer</button>
                </form>
            </div>
        </div>
    </div>
</div>

