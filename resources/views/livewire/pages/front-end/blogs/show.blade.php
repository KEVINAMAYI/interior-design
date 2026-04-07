<?php

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {
    use LivewireAlert;

    public Blog $blog;

    public string $author = '';
    public string $comment = '';

    public function mount(string $slug): void
    {
        $this->loadBlog($slug);
    }

    public function loadBlog(string $slug): void
    {
        $this->blog = Blog::with(['images', 'coverImage', 'comments' => fn($query) => $query->where('is_approved', true)->latest()])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();
    }

    public function saveComment(): void
    {
        $this->validate([
            'author' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        DB::beginTransaction();

        try {
            BlogComment::create([
                'blog_id' => $this->blog->id,
                'author' => trim($this->author),
                'comment' => trim($this->comment),
                'is_approved' => true,
            ]);

            DB::commit();

            $this->reset(['author', 'comment']);
            $this->loadBlog($this->blog->slug);

            $this->alert('success', 'Comment posted successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }

};
?>

<div class="container py-5">
    <div class="row ">
        <div class="col-lg-8 mx-auto">
            <div class="mb-4">
                <a href="{{ route('front-end.blogs.index') }}" class="btn btn-outline-secondary btn-sm mb-3 mt-4">
                    ← Back to Blogs
                </a>

                <h1 class="fw-bold mb-3">{{ $blog->title }}</h1>

                <p class="text-muted mb-4">
                    By {{ $blog->author ?? 'Admin' }}
                    · {{ $blog->published_at?->format('d M Y, h:i A') }}
                </p>
            </div>

            @if ($blog->coverImage)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $blog->coverImage->image_path) }}" class="img-fluid rounded w-100"
                        style="max-height: 400px; object-fit: cover;" alt="{{ $blog->title }}">
                </div>
            @endif
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body">
                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0 mb-5">
    <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="mb-3 mb-md-0">
            <h5 class="mb-1">Interested in this product?</h5>
            <p class="mb-0 text-muted">Chat directly with us on WhatsApp for more details.</p>
        </div>

        <a href="https://wa.me/254798692688?text={{ urlencode('Hi, I saw this product: *' . $blog->title. '.* Can I get more details?')  }}"
           target="_blank"
           class="btn btn-success d-flex align-items-center gap-2">
            <i class="bi bi-whatsapp"></i>
            Chat on WhatsApp
        </a>
    </div>
</div>
            @if ($blog->images->count())
                <div class="row mb-4">
                    @foreach ($blog->images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                class="img-fluid rounded border w-100" style="height: 180px; object-fit: cover;"
                                alt="Blog image">
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Leave a Comment</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveComment">
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" wire:model.defer="author"
                                placeholder="Enter your name">
                            @error('author')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <textarea class="form-control" rows="5" wire:model.defer="comment" placeholder="Write your comment"></textarea>
                            @error('comment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Post Comment
                        </button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        Comments ({{ $blog->comments->count() }})
                    </h4>
                </div>
                <div class="card-body">
                    @forelse($blog->comments as $commentItem)
                        <div class="{{ !$loop->last ? 'border-bottom pb-3 mb-3' : '' }}">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 fw-bold">{{ $commentItem->author ?: 'Guest' }}</h6>
                                <small class="text-muted">{{ $commentItem->created_at->diffForHumans() }}</small>
                            </div>

                            <p class="mb-0 text-muted">
                                {{ $commentItem->comment }}
                            </p>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No comments yet. Be the first to comment.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
