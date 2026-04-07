<?php

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard')] class extends Component {
    use LivewireAlert;
    use WithFileUploads;

    public $blogs = [];

    public ?int $blog_id = null;
    public string $title = '';
    public string $excerpt = '';
    public string $content = '';
    public string $author = '';
    public string $status = 'draft';
    public ?string $published_at = null;

    public array $images = [];
    public array $existingImages = [];
    public ?int $cover_index = 0;
    public ?int $existing_cover_image_id = null;

    public bool $isEditMode = false;

    public function mount(): void
    {
        $this->getBlogs();
    }

    public function getBlogs(): void
    {
        $this->blogs = Blog::with(['images', 'coverImage'])
            ->latest()
            ->get();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'author' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'cover_index' => ['nullable', 'integer', 'min:0'],
            'existing_cover_image_id' => ['nullable', 'integer'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['blog_id', 'title', 'excerpt', 'content', 'author', 'status', 'published_at', 'images', 'existingImages', 'cover_index', 'existing_cover_image_id', 'isEditMode']);

        $this->status = 'draft';
        $this->cover_index = 0;
        $this->dispatch('hide-blog-modal');
    }

    public function createBlog(): void
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->dispatch('show-blog-modal');
    }

    public function editBlog(int $id): void
    {
        $blog = Blog::with('images')->findOrFail($id);

        $this->blog_id = $blog->id;
        $this->title = $blog->title;
        $this->excerpt = $blog->excerpt ?? '';
        $this->content = $blog->content;
        $this->author = $blog->author ?? '';
        $this->status = $blog->status;
        $this->published_at = $blog->published_at?->format('Y-m-d\TH:i');
        $this->existingImages = $blog->images->toArray();
        $this->existing_cover_image_id = optional($blog->images->firstWhere('is_cover', true))->id;
        $this->images = [];
        $this->cover_index = 0;
        $this->isEditMode = true;

        $this->dispatch('show-blog-modal');
    }

    public function saveBlog(): void
    {
        $validated = $this->validate();

        DB::beginTransaction();

        try {
            if ($this->isEditMode && $this->blog_id) {
                $blog = Blog::findOrFail($this->blog_id);

                $blog->update([
                    'title' => $this->title,
                    'slug' => Str::slug($this->title) . '-' . $blog->id,
                    'excerpt' => $this->excerpt ?: null,
                    'content' => $this->content,
                    'author' => $this->author ?: null,
                    'status' => $this->status,
                    'published_at' => $this->status === 'published' ? ($this->published_at ?: $blog->published_at?->format('Y-m-d H:i:s') ?? now()) : null,
                ]);

                if ($this->existing_cover_image_id) {
                    BlogImage::where('blog_id', $blog->id)->update(['is_cover' => false]);

                    BlogImage::where('blog_id', $blog->id)
                        ->where('id', $this->existing_cover_image_id)
                        ->update(['is_cover' => true]);
                }

                if (!empty($this->images)) {
                    $nextSort = (int) BlogImage::where('blog_id', $blog->id)->max('sort_order');
                    $nextSort++;

                    foreach ($this->images as $index => $image) {
                        $path = $image->store('blogs', 'public');

                        BlogImage::create([
                            'blog_id' => $blog->id,
                            'image_path' => $path,
                            'sort_order' => $nextSort + $index,
                            'is_cover' => false,
                        ]);
                    }
                }
            } else {
                $blog = Blog::create([
                    'title' => $this->title,
                    'slug' => Str::slug($this->title) . '-' . Str::random(5),
                    'excerpt' => $this->excerpt ?: null,
                    'content' => $this->content,
                    'author' => $this->author ?: null,
                    'status' => $this->status,
                    'published_at' => $this->status === 'published' ? ($this->published_at ?: now()) : null,
                ]);

                foreach ($this->images as $index => $image) {
                    $path = $image->store('blogs', 'public');

                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'image_path' => $path,
                        'sort_order' => $index,
                        'is_cover' => $this->cover_index === $index,
                    ]);
                }
            }

            DB::commit();

            $this->getBlogs();
            $this->dispatch('hide-blog-modal');
            $this->alert('success', $this->isEditMode ? 'Blog updated successfully' : 'Blog created successfully');
            $this->resetForm();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }

    public function deleteBlog(int $id): void
    {
        DB::beginTransaction();

        try {
            $blog = Blog::with('images')->findOrFail($id);

            foreach ($blog->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            $blog->delete();

            DB::commit();

            $this->getBlogs();
            $this->alert('success', 'Blog deleted successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }

    public function deleteImage(int $imageId): void
    {
        DB::beginTransaction();

        try {
            $image = BlogImage::findOrFail($imageId);
            $blogId = $image->blog_id;
            $wasCover = $image->is_cover;

            Storage::disk('public')->delete($image->image_path);
            $image->delete();

            if ($wasCover) {
                $nextImage = BlogImage::where('blog_id', $blogId)->orderBy('sort_order')->first();
                if ($nextImage) {
                    $nextImage->update(['is_cover' => true]);
                    $this->existing_cover_image_id = $nextImage->id;
                } else {
                    $this->existing_cover_image_id = null;
                }
            }

            DB::commit();

            if ($this->blog_id === $blogId) {
                $this->existingImages = BlogImage::where('blog_id', $blogId)->orderBy('sort_order')->get()->toArray();
            }

            $this->getBlogs();
            $this->alert('success', 'Image deleted successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }

    public function toggleStatus(int $id): void
    {
        DB::beginTransaction();

        try {
            $blog = Blog::findOrFail($id);

            $newStatus = $blog->status === 'draft' ? 'published' : 'draft';

            $blog->update([
                'status' => $newStatus,
                'published_at' => $newStatus === 'published' ? $blog->published_at ?? now() : null,
            ]);

            DB::commit();

            $this->getBlogs();
            $this->alert('success', 'Blog status updated successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }
};
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <livewire:layout.dashboard.site-map page="Blogs" />

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="row">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Blogs List') }}
                                    </h4>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" class="btn btn-primary" wire:click="createBlog">
                                        {{ __('Add Blog') }}
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <table class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Images</th>
                                            <th>Published At</th>
                                            <th width="180">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($blogs as $blog)
                                            <tr>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->author ?? '—' }}</td>
                                                <td>
                                                    <span
                                                        class="badge btn-rounded badge-pill {{ $blog->status === 'draft' ? 'bg-warning' : 'bg-success' }}">
                                                        {{ ucfirst($blog->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $blog->images->count() }}</td>
                                                <td>{{ $blog->published_at?->format('d M Y H:i') ?? '—' }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            wire:click="editBlog({{ $blog->id }})">
                                                            Edit
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-sm {{ $blog->status === 'draft' ? 'btn-success' : 'btn-warning' }}"
                                                            wire:click="toggleStatus({{ $blog->id }})">
                                                            {{ $blog->status === 'draft' ? 'Publish' : 'Draft' }}
                                                        </button>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            wire:click="deleteBlog({{ $blog->id }})"
                                                            wire:confirm="Are you sure you want to delete this blog?">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No blogs found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form wire:submit.prevent="saveBlog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="blogModalLabel">
                            {{ $isEditMode ? 'Edit Blog' : 'Create Blog' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="resetForm"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" wire:model.defer="title">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Author</label>
                                <input type="text" class="form-control" wire:model.defer="author">
                                @error('author')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" wire:model.defer="status">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Published At</label>
                                <input type="datetime-local" class="form-control" wire:model.defer="published_at">
                                @error('published_at')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Excerpt</label>
                                <textarea class="form-control" rows="3" wire:model.defer="excerpt"></textarea>
                                @error('excerpt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12" wire:ignore>
                                <label class="form-label">Content</label>
                                <textarea id="blog_content_editor" class="form-control">{!! $content !!}</textarea>
                                @error('content')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Upload Images</label>
                                <input type="file" class="form-control" wire:model="images" multiple>
                                @error('images')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                                @error('images.*')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            @if (!$isEditMode && !empty($images))
                                <div class="col-12">
                                    <label class="form-label">Select Cover Image (new uploads)</label>
                                    <select class="form-select" wire:model.defer="cover_index">
                                        @foreach ($images as $index => $image)
                                            <option value="{{ $index }}">Image {{ $index + 1 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ($isEditMode && count($existingImages))
                                <div class="col-12">
                                    <label class="form-label">Existing Images</label>
                                    <div class="row">
                                        @foreach ($existingImages as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="border rounded p-2">
                                                    <img src="{{ asset('storage/' . $image['image_path']) }}"
                                                        class="img-fluid rounded mb-2"
                                                        style="height: 150px; width: 100%; object-fit: cover;">

                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            wire:model="existing_cover_image_id"
                                                            value="{{ $image['id'] }}"
                                                            id="cover_{{ $image['id'] }}">
                                                        <label class="form-check-label"
                                                            for="cover_{{ $image['id'] }}">
                                                            Cover Image
                                                        </label>
                                                    </div>

                                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                                        wire:click="deleteImage({{ $image['id'] }})"
                                                        wire:confirm="Delete this image?">
                                                        Delete Image
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if (!empty($images))
                                <div class="col-12">
                                    <label class="form-label">New Upload Preview</label>
                                    <div class="row">
                                        @foreach ($images as $image)
                                            <div class="col-md-3 mb-3">
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    class="img-fluid rounded border"
                                                    style="height: 150px; width: 100%; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click="resetForm">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isEditMode ? 'Update Blog' : 'Create Blog' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        let blogEditor = null;

        function initBlogEditor(content = '') {
            const editorElement = document.querySelector('#blog_content_editor');

            if (!editorElement) return;

            if (blogEditor) {
                blogEditor.destroy().then(() => {
                    blogEditor = null;
                    createEditor(content);
                });
            } else {
                createEditor(content);
            }
        }

        function createEditor(content = '') {
            ClassicEditor
                .create(document.querySelector('#blog_content_editor'))
                .then(editor => {
                    blogEditor = editor;
                    editor.setData(content || '');

                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        document.addEventListener('livewire:init', function () {
            window.addEventListener('show-blog-modal', () => {
                const modalEl = document.getElementById('blogModal');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                setTimeout(() => {
                    initBlogEditor(@this.get('content'));
                }, 300);
            });

            window.addEventListener('hide-blog-modal', () => {
                const modalEl = document.getElementById('blogModal');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) {
                    modalInstance.hide();
                }
            });
        });
    </script>
@endpush
