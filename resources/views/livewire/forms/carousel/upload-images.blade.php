<?php

use App\Models\Carousel;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads, LivewireAlert;

    public $image_1;
    public $image_2;
    public $image_3;
    public $image_4;


    public function uploadCarouseImages(): void
    {
        $carousel = Carousel::find(1);

        // Existing image URLs
        $existingPaths = [
            'image_1' => $carousel->image_url_1,
            'image_2' => $carousel->image_url_2,
            'image_3' => $carousel->image_url_3,
            'image_4' => $carousel->image_url_4,
        ];

        // Handle new image uploads
        if ($this->image_1) {
            $name = time() . '-' . $this->image_1->getClientOriginalName();
            $newPath = $this->image_1->storeAs('carousel', $name, 'public');

            // Delete the old image if it exists
            if ($existingPaths['image_1']) {
                Storage::disk('public')->delete($existingPaths['image_1']);
            }

            $existingPaths['image_1'] = $newPath;
        }

        if ($this->image_2) {
            $name = time() . '-' . $this->image_2->getClientOriginalName();
            $newPath = $this->image_2->storeAs('carousel', $name, 'public');

            // Delete the old image if it exists
            if ($existingPaths['image_2']) {
                Storage::disk('public')->delete($existingPaths['image_2']);
            }

            $existingPaths['image_2'] = $newPath;
        }

        if ($this->image_3) {
            $name = time() . '-' . $this->image_3->getClientOriginalName();
            $newPath = $this->image_3->storeAs('carousel', $name, 'public');

            // Delete the old image if it exists
            if ($existingPaths['image_3']) {
                Storage::disk('public')->delete($existingPaths['image_3']);
            }

            $existingPaths['image_3'] = $newPath;
        }


        if ($this->image_4) {
            $name = time() . '-' . $this->image_4->getClientOriginalName();
            $newPath = $this->image_4->storeAs('carousel', $name, 'public');

            // Delete the old image if it exists
            if ($existingPaths['image_4']) {
                Storage::disk('public')->delete($existingPaths['image_3']);
            }

            $existingPaths['image_4'] = $newPath;
        }

        DB::beginTransaction();
        try {
            // Update carousel with new image paths
            $carousel->update([
                'image_url_1' => $existingPaths['image_1'],
                'image_url_2' => $existingPaths['image_2'],
                'image_url_3' => $existingPaths['image_3'],
                'image_url_4' => $existingPaths['image_4']
            ]);

            DB::commit();
            // Reset image inputs
            $this->reset(['image_1', 'image_2', 'image_3','image_4']);
            $this->alert('success', 'Carousel Images Updated successfully');

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
                {{ __('Upload Images') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="uploadCarouseImages" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="image" class="form-label">Wall to Wall & Artificial Carpets</label>
                            <input accept="image/*" class="form-control" wire:model="image_1" id="image"
                                   type="file"
                                   autocomplete="image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="image" class="form-label">Curtain Rails and Rods</label>
                            <input accept="image/*" class="form-control" wire:model="image_2" id="image"
                                   type="file"
                                   autocomplete="image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="image" class="form-label">Wall Decor</label>
                            <input accept="image/*" class="form-control" wire:model="image_3" id="image"
                                   type="file"
                                   autocomplete="image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="image" class="form-label">Artificial Flowers</label>
                            <input accept="image/*" class="form-control" wire:model="image_4" id="image"
                                   type="file"
                                   autocomplete="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">
                        <span wire:loading.remove>Update Images</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

