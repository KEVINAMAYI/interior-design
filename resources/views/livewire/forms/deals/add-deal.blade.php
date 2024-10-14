<?php

use App\Models\Deal;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads,LivewireAlert;

    public $name;
    public $discount_off;
    public $image;

    public function rules()
    {
        return [
            'name' => 'required',
            'discount_off' => 'required',
            'image' => 'required'
        ];
    }


    /**
     * Add product Category.
     */
    public function createProductCategory(): void
    {
        $this->validate();

        $name = time() . '-' . $this->image->getClientOriginalName();
        $path = $this->image->storeAs('deals', $name, 'public');


        DB::beginTransaction();
        try {

            Deal::create([
                'name' => $this->name,
                'discount_off' => $this->discount_off,
                'banner_url' => $path
            ]);

            DB::commit();
            $this->reset(['name','discount_off','image']);
            $this->alert('success', 'Deal created successfully');

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
                {{ __('Add Deal') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createProductCategory" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" id="name" class="form-control" type="text"
                                   autofocus autocomplete="name">
                            @error('name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Percentage Discount</label>
                            <input wire:model="discount_off" id="discount_off" class="form-control" type="text"
                                   autofocus autocomplete="discount_off">
                            @error('discount_off')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="image" class="form-label">Image</label>
                            <input accept="image/*"  class="form-control" wire:model="image" id="image"
                                   type="file"
                                   autocomplete="image">
                            @error('image')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">
                        <span wire:loading.remove>Add Deal</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

