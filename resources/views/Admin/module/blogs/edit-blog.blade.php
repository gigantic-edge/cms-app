<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Blog Title</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ $blog['title'] }}"
                    class="form-control"
                    placeholder="Enter Category Name">
                <div class="text-danger small">@error('name'){{ $message }}@enderror</div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    name="description"
                    id="editor1"
                    class="form-control"
                    rows="5">{{ $blog['description'] }}</textarea>
                <div class="text-danger small">@error('description'){{ $message }}@enderror</div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">

                {{-- Show validation error --}}
                <div class="text-danger small">@error('image'){{ $message }}@enderror</div>

                {{-- Preview existing image if available --}}
                @if(!empty($blog['image']))
                <div class="mb-3">
                    <img id="existing-image"
                        src="{{ asset('/storage/images/blogs/' . $blog['image']) }}"
                        alt="Image"
                        class="img-thumbnail"
                        style="max-height: 150px;">
                </div>
                @endif

                {{-- Image preview after file select --}}
                <div class="mb-3" id="image-preview" style="display:none;">
                    <img id="preview-img" class="img-thumbnail" style="max-height: 150px;" />
                </div>
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Order</label>
                <input
                    type="text"
                    id="order"
                    name="order"
                    value="{{ $blog['ranking'] }}"
                    class="form-control"
                    placeholder="Enter Order">
                <div class="text-danger small">@error('order'){{ $message }}@enderror</div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>