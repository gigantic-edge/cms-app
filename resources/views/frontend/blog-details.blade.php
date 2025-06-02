<div class="container my-5">

  <div class="row">

    <!-- Blog Content -->
    <div class="col-lg-8">

      <article>
        <h1 class="mb-3">{{ $blog_detail->title }}</h1>
        <p class="text-muted">
          By <strong>{{ $blog_detail->author ?? 'Admin' }}</strong> · 
          {{ $blog_detail->created_at->format('F d, Y') }}
        </p>

        @if ($blog_detail->image)
          <img src="{{ asset('/storage/images/blogs/' . $blog_detail['image']) }}" alt="{{ $blog_detail->title }}" class="img-fluid rounded mb-4">
        @endif

        <div class="blog-content">
          {!! $blog_detail->description !!}
        </div>
      </article>

    </div>

  </div>

  <!-- Related Blogs Section -->
  <section class="mt-5">
    <h3 class="mb-4">Related Blogs</h3>

    <div class="row g-4">

      @foreach ($relatedBlogs as $related)
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <img src="{{ asset('/storage/images/blogs/' . $related['image']) }}" class="card-img-top" alt="{{ $related->title }}">
          <div class="card-body">
            <h5 class="card-title">{{ \Illuminate\Support\Str::limit($related->title, 50) }}</h5>
            <p class="card-text">
              {{ \Illuminate\Support\Str::limit(strip_tags($related->description ?? ''), 80) }}
            </p>
            <a href="{{ url('/blog-details/' . $related['slug']) }}" class="btn btn-outline-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </section>

</div>
