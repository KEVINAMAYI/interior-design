<?php

use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\ProductVariation;
use App\Models\ProductVariationImage;
use App\Models\Tag;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

new class extends Component {

    use WithFileUploads, LivewireAlert;

    public $name;
    public $description;
    public $image;


    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ];
    }


    /**
     * Add portfolio
     */
    public function createPortfolio()
    {
        $this->validate();

        DB::beginTransaction();
        try {

            // Generate a unique name for the image
            $name = time() . '-' . $this->image->getClientOriginalName();

            // Store the image in the 'public/product_variation_images' directory using Livewire's storeAs method
            $path = $this->image->storeAs('portfolio_images', $name, 'public');

            Log::info('File stored successfully at: ' . $path);

            // Store the image path in the database
            Portfolio::create([
                'name' => $this->name,
                'description' => $this->description,
                'image_url' => $path,
            ]);

            DB::commit();
            $this->reset(['name', 'description', 'image']);
            $this->alert('success', 'Portfolio added successfully');

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
                {{ __('Add Portfolio') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createPortfolio" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="name" class="form-label">Client Name</label>
                            <input class="form-control" wire:model="name" id="email" type="text"
                                   autocomplete="name">
                            @error('name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Job Description</label>
                            <textarea style="width:100%" wire:model="description" id="" cols="50" rows="5"></textarea>
                            @error('description')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="image" class="form-label">Image</label>
                            <input accept="image/*" required class="form-control" wire:model="image" id="image"
                                   type="file"
                                   autocomplete="image">
                            @error('image')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">
                        <span wire:loading.remove>Add Portfolio</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

