<?php

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads,LivewireAlert;

    public $name;
    public $description;
    public $image;

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
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
        $path = $this->image->storeAs('categories', $name, 'public');


        DB::beginTransaction();
        try {

            Category::create([
                'name' => $this->name,
                'description' => $this->description,
                'slug' => $this->generateSlug(),
                'image_url' => $path
            ]);

            DB::commit();
            $this->reset(['name','description','image']);
            $this->alert('success', 'Category created successfully');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
        }

    }

    public function generateSlug()
    {
        return str_replace(' ', '_', strtolower($this->name));
    }


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Category') }}
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
                            <label for="description" class="form-label">Description</label>
                            <textarea style="width:100%" wire:model="description" name="description" id="description"
                                      cols="50" rows="5"></textarea>
                            @error('description')
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
                        <span wire:loading.remove>Add Category</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

