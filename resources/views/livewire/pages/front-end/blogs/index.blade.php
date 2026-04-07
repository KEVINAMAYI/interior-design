<?php

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {
    public $blogs = [];

    public function mount(): void
    {
        $this->loadBlogs();
    }

    public function loadBlogs(): void
    {
        $this->blogs = Blog::with(['coverImage', 'images'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->get();
    }
};
?>

<div class="container py-5">
    <div class="row m-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold">Our Blogs</h1>
            <p class="text-muted">Interior design ideas, inspiration, and updates.</p>
        </div>
    </div>

    <div class="row">
        @forelse($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($blog->coverImage)
                        <img src="{{ asset('storage/' . $blog->coverImage->image_path) }}"
                             class="card-img-top"
                             style="height: 240px; object-fit: cover;"
                             alt="{{ $blog->title }}">
                    @elseif($blog->images->count())
                        <img src="{{ asset('storage/' . $blog->images->first()->image_path) }}"
                             class="card-img-top"
                             style="height: 240px; object-fit: cover;"
                             alt="{{ $blog->title }}">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title">{{ $blog->title }}</h4>

                        <p class="text-muted mb-2">
                            By {{ $blog->author ?? 'Admin' }}
                            · {{ $blog->published_at?->format('d M Y') }}
                        </p>

                        <p class="card-text">
                            {{ $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 120) }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('front-end.blogs.show', $blog->slug) }}" class="btn btn-dark">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info mb-0">
                    No published blogs available right now.
                </div>
            </div>
        @endforelse
    </div>
</div>
