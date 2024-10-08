<?php

use App\Models\ProductVariation;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {

    use LivewireAlert;

    public $name;
    public $email;
    public $ratings;
    public $comments;
    public $product_variation_id;

    public function mount($product_variation_id)
    {
        $this->product_variation_id = $product_variation_id;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'ratings' => 'required',
            'comments' => 'required',
            'email' => 'required',
            'product_variation_id' => 'required'
        ];
    }

    public function addReview()
    {

        $this->validate();

        DB::beginTransaction();
        try {

            Rating::create([
                'product_variation_id' => $this->product_variation_id,
                'name' => $this->name,
                'ratings' => $this->ratings,
                'email' => $this->email,
                'comments' => $this->comments
            ]);
            DB::commit();

            $this->resetExcept('product_variation_id');
            $this->dispatch('get-ratings',  $this->product_variation_id);
            $this->alert('success','Ratings added successfully');

        } catch (Exception $exception) {

            DB::rollBack();
            $this->alert('error','There was an error while adding product rating');

        }

    }

}; ?>

<div class="col col-lg-4">
    <div class="add-review border">
        <form wire:submit="addReview">
            <div class="form-body p-3">
                <h4 class="mb-4">Write a Review</h4>
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input id="name" type="text" wire:model="name"
                           class="form-control rounded-0">
                    @error('name')
                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input id="email" wire:model="email" type="text"
                           class="form-control rounded-0">
                    @error('email')
                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ratings" class="form-label">Rating</label>
                    <select wire:model="ratings" id="ratings" class="form-select rounded-0">
                        <option selected>Choose Rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    @error('ratings')
                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="comments" class="form-label">Comment</label>
                    <textarea id="comments" wire:model="comments"
                              class="form-control rounded-0" rows="3"></textarea>
                    @error('comments')
                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-ecomm">
                        <span wire:loading.remove>Submit a Review</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

