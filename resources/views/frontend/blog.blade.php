<!-- Hero Section -->
<div class="hero text-white text-center py-5" style="background: url('https://source.unsplash.com/1600x400/?blog') center/cover no-repeat;">
    <div class="container" style="color: black;">
        <h1>Explore Our Latest Blogs</h1>
        <p class="lead">Insights, stories, and ideas from our team</p>
    </div>
</div>

<!-- Blog List Section -->
<div class="container my-5">
    <div class="row g-4">

        @if ($blogs->isEmpty())
        <div class="col-12">
            <div class="alert alert-warning text-center">
                No articles found.
            </div>
        </div>
        @else
        @foreach ($blogs as $blog)
        <div class="col-md-4">
            <div class="card blog-card h-100 border-0 shadow-sm">
                <img src="{{ asset('/storage/images/blogs/' . $blog['image']) }}" class="card-img-top" alt="Blog image">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">
                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 100) }}
                    </p>
                    <p class="blog-meta text-muted small">
                        {{ $blog->created_at->format('M d, Y') }}
                    </p>
                    <a href="{{ url('/blog-details/' . $blog['slug']) }}" class="btn btn-outline-primary btn-sm mt-2">Read More</a>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Pagination -->
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $blogs->links('pagination::bootstrap-5', ['size' => 'sm']) }}
        </div>
        @endif

    </div>
</div>