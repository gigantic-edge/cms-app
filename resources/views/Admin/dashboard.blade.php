<div>
  @if (session('message'))
  <div class="alert 
        @if(session('type') == 'error') alert-danger
        @elseif(session('type') == 'success') alert-success
        @elseif(session('type') == 'warning') alert-warning
        @endif alert-dismissible fade show" role="alert">
    <strong>{{ ucfirst(session('type')) }}!</strong> {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
</div>

<main class="p-4 bg-light">
  <div class="row g-4">
    <!-- Card 1 -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card text-white bg-primary h-100">
        <div class="card-body d-flex align-items-center">
          <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-white" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
            </svg>
          </div>
          <h5 class="mb-0">Blogs</h5>
        </div>
      </div>
    </div>

  </div>
</main>
