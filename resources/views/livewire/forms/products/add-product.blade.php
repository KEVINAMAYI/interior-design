<?php

use App\Models\Category;
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
    public $price;
    public $variations;
    public $category_id;
    public $description;
    public $selling_tags;
    public $selling_tags_ids = [];
    public $variation_id;
    public $images = [];


    public function mount()
    {
        $this->variations = Variation::all();
        $this->selling_tags = Tag::all();
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'selling_tags_ids' => 'required',
            'price' => 'required',
            'variation_id' => 'required',
            'category_id' => 'required',
            'images.*' => 'required|image|max:2048',

        ];
    }

    public function with()
    {
        return [
            'categories' => Category::all()
        ];
    }

    /**
     * Add product and the product variation
     */
    public function createProductWithVariations()
    {
        $this->validate();

        DB::beginTransaction();
        try {

            $product = $this->createProduct();
            $this->saveProductTags($product);

            //create product variation for the created product
            $productVariation = ProductVariation::create([
                'product_id' => $product->id,
                'variation_id' => $this->variation_id,
                'price' => $this->price,
            ]);

            if (!empty($this->images)) {
                foreach ($this->images as $image) {
                    // Generate a unique name for the image
                    $name = time() . '-' . $image->getClientOriginalName();

                    // Define the destination path inside the public/product_variation_images folder
                    $destinationPath = public_path('product_variation_images/' . $name);

                    // Get the temporary file path directly from the Livewire component
                    $tempFilePath = $image->getRealPath();

                    try {
                        // Ensure the directory exists
                        $directoryPath = public_path('product_variation_images');
                        if (!is_dir($directoryPath)) {
                            if (!mkdir($directoryPath, 0755, true)) {
                                throw new \Exception('Failed to create directory: ' . $directoryPath);
                            }
                        }

                        // Read the file content from the temporary location
                        $fileContent = file_get_contents($tempFilePath);
                        if ($fileContent === false) {
                            throw new \Exception('Failed to read file content from: ' . $tempFilePath);
                        }

                        // Write the file content to the destination path
                        $result = file_put_contents($destinationPath, $fileContent);
                        if ($result === false) {
                            throw new \Exception('Failed to write file to: ' . $destinationPath);
                        }

                        Log::info('File moved successfully to: ' . $destinationPath);

                        // Store the image path in the database
                        ProductVariationImage::create([
                            'product_variation_id' => $productVariation->id,
                            'image_url' => 'product_variation_images/' . $name,
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Error moving file: ' . $e->getMessage());
                        // Handle the exception as needed
                    }
                }
            } else {
                Log::warning('No images provided for the product variation.');
            }


            DB::commit();
            $this->reset(['category_id', 'name', 'description', 'variation_id', 'price', 'images']);
            $this->alert('success', 'Product created successfully');
            $this->dispatch('productCreated');

        } catch (Exception $exception) {
            DB::rollBack();
            $this->alert('error', $exception->getMessage());
        }
    }


    /**
     * Create a new product if it doesn't exist otherwise
     * return the product with the name
     */
    public function createProduct()
    {
        $product = Product::where(trim(strtolower('name')), $this->name)->first();

        if (!$product) {
            $product = Product::create([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'description' => $this->description,
            ]);
        }

        return $product;
    }


    /**
     * Save Product Tags if the product has any
     */
    public function saveProductTags($product)
    {
        if (!empty($this->selling_tags_ids)) {
            foreach ($this->selling_tags_ids as $selling_tags_id) {
                ProductTag::create([
                    'product_id' => $product->id,
                    'tag_id' => $selling_tags_id
                ]);
            }
        }
    }


    /**
     * Gets Variations Based on Category
     */
    public function getCategoryVariations()
    {
        $category_slug = Category::where('id', $this->category_id)->first();

        $this->variations = Variation::all();

        if ($category_slug == 'grass_carpet') {
            $this->variations = Variation::where('name', 'height')->get();
        }

    }


    #[On('update-selling-tag-ids')]
    public function updateSellingTagIds($selling_tags_ids)
    {
        $this->selling_tags_ids = $selling_tags_ids;
    }


}; ?>

<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add Product') }}
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <form wire:submit="createProductWithVariations" class="mt-6 space-y-6">
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select id="category_id" wire:model="category_id" wire:change="getCategoryVariations"
                                    class="form-select">
                                <option>Select</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>
                        <div class="mb-4 col-lg-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" wire:model="name" id="email" type="text"
                                   autocomplete="name">
                            @error('name')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea style="width:100%" wire:model="description" id="" cols="50" rows="5"></textarea>
                            @error('description')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-6">
                            <label for="variation_id" class="form-label">Variations</label>
                            <select id="variation_id" wire:model="variation_id" class="form-select">
                                <option>Select</option>
                                @foreach($variations as $variation)
                                    <option
                                        value="{{ $variation->id }}">{{ $variation->name.'-'.$variation->value }}</option>
                                @endforeach
                            </select>
                            @error('variation_id')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>

                        <div class="mb-4 col-lg-6">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control" wire:model="price" id="price" type="text"
                                   autocomplete="price">
                            @error('price')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror                        </div>
                    </div>
                    <div class="row">
                        <div wire:ignore class="mb-4 col-lg-12">
                            <label for="selling_tags" class="form-label">Shopping Tags</label>
                            <select id="tags" class="form-control selling_tags" wire:model="selling_tags_ids" multiple>
                                @foreach($selling_tags as $selling_tag)
                                    <option value="{{ $selling_tag->id }}">{{ $selling_tag->name }}</option>
                                @endforeach
                            </select>
                            @error('selling_tags_id')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4 col-lg-12">
                            <label for="images" class="form-label">Images</label>
                            <input accept="image/*" required class="form-control" wire:model="images" id="images"
                                   type="file"
                                   autocomplete="images" multiple>
                            @error('images.*')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary waves-effect">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener("livewire:navigated", function () {
            const sellingTags = new Choices(".selling_tags", {removeItemButton: !0});
            sellingTags.passedElement.element.addEventListener('change', function (event) {
                const result = $('.selling_tags').val();
                Livewire.dispatch('update-selling-tag-ids', {selling_tags_ids: result});
            })

            Livewire.on('productCreated', () => {
                document.getElementById('images').value = ''; // Clear file input
                document.getElementById('tags').value = ''; // Clear file input
            });

        })

    </script>
@endpush

