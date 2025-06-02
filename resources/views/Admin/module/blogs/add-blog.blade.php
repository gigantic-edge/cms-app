<div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="name" class="form-label">Title</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Blog Title">
                <div class="text-danger">@error('name'){{ $message }}@enderror</div>
            </div>

            <div class="row mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="editor1" class="form-control" rows="5">{{ old('description') }}</textarea>
                <div class="text-danger">@error('description'){{ $message }}@enderror</div>
            </div>

            <div class="row mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                <div class="text-danger">@error('image'){{ $message }}@enderror</div>
            </div>

            <div class="row mb-3" id="image-preview"></div>

            <div class="row mb-3">
                <label for="order" class="form-label">Ranking</label>
                <input type="text" id="order" name="order" value="{{ old('order') }}" class="form-control" placeholder="Enter Ranking">
                <div class="text-danger">@error('order'){{ $message }}@enderror</div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>