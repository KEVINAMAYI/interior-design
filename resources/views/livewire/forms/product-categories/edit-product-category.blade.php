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
    public $category;
    public $image;

    public function mount($category_id)
    {
        $this->category = Category::find($category_id);
        $this->name = $this->category->name;
        $this->description = $this->category->description;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required'
        ];
    }


    /**
     * Add product Category.
     */
    public function updateProductCategory(): void
    {
        $this->validate();

        DB::beginTransaction();
        try {

            $this->category->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            if (!empty($this->image)) {
                $name = time() . '-' . $this->image->getClientOriginalName();
                $path = $this->image->storeAs('categories', $name, 'public');

                $this->category->update([
                    'image_url' => $path
                ]);

            }

            DB::commit();
            $this->reset(['image']);
            $this->alert('success', 'Category updated successfully');


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
                {{ __('Edit Category') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="updateProductCategory" class="mt-6 space-y-6">
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
                            <label for="image" class="form-label">Image <span
                                    style="font-size:11px; color:red;">(Selected Image will replace the old Image)</span></label>
                            <input accept="image/*"  class="form-control" wire:model="image" id="image"
                                   type="file"
                                   autocomplete="image">
                            @error('image')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">
                        <span wire:loading.remove>Update Category</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

