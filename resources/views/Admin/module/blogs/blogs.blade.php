
<div class="container-fluid py-4">
    {{-- Session Message --}}
    @if (session('message'))
    <div class="alert 
        @if(session('type') == 'error') alert-danger 
        @elseif(session('type') == 'success') alert-success 
        @elseif(session('type') == 'warning') alert-warning 
        @endif alert-dismissible fade show" role="alert">
        <strong>{{ ucfirst(session('type')) }}:</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Add Blog Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Manage Blog</h4>
        <a href="{{ url('Administrator/add-blog') }}" class="btn btn-primary">Add Blog</a>
    </div>

    {{-- Blog Table --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Ranking</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($blogs && count($blogs) > 0)
                        @php $sl = 1; @endphp
                        @foreach($blogs as $blog)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $blog['title'] }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($blog['description'], 40) }}</td>
                            <td>
                                {{-- Add image preview here --}}
                                @if($blog['image'])
                                    <img src="{{ asset('/storage/images/blogs/' . $blog['image']) }}" width="100" alt="Blog Image">
                                @endif
                            </td>
                            <td>{{ $blog['ranking'] }}</td>
                            <td>{{ $blog['created_by'] }}</td>
                            <td>
                                <a href="{{ url('Administrator/edit-blog/' . $blog['id']) }}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{ url('Administrator/delete-blog/' . $blog['id']) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-muted">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
