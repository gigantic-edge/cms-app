<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS-APP || Sign-up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-4 w-100" style="max-width: 500px;">
        <h2 class="text-center mb-4">CMS-app Sign Up</h2>
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

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

        <form action="{{ url('Administrator/sign-up') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your email" />
                <div class="text-danger small mt-1">@error('name'){{ $message }}@enderror</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" />
                <div class="text-danger small mt-1">@error('email'){{ $message }}@enderror</div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" />
                <div class="text-danger small mt-1">@error('password'){{ $message }}@enderror</div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Signup</button>
        </form>



    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>