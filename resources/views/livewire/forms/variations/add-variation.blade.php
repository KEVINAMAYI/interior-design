<?php

use App\Models\User;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {

    public $name;
    public $type;
    public $value;

    public function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required|in:color,measurements,origin',
            'value' => 'required',
        ];
    }

    /**
     * Add Variations.
     */
    public function createVariation()
    {
        $this->validate();

        DB::beginTransaction();
        try {

            Variation::create([
                'name' => $this->name,
                'type' => $this->type,
                'value' => $this->value
            ]);

            DB::commit();
            $this->reset();

        } catch (Exception $exception) {
            DB::rollBack();
        }
    }


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Variation') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createVariation" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   autofocus autocomplete="name">
                            @error('name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="type" class="form-label">Type</label>
                            <select id="type" wire:model="type" class="form-select">
                                <option value="none">Select</option>
                                <option value="color">Color</option>
                                <option value="measurements">Measurements</option>
                                <option value="origin">Origin</option>
                            </select>
                            @error('type')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="value" class="form-label">value</label>
                            <input wire:model="value" id="type" class="form-control" type="text"
                                   autofocus autocomplete="type">
                            @error('value')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Variation</button>
                </form>
            </div>
        </div>
    </div>
</div>

