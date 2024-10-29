<!DOCTYPE html>
<html lang="en">

<head>
    <title>Photo Collection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-info">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="card">
                @if(session('success'))
                        <div class="alert alert-success">
                        <b>Success</b>{{session('success')}}
                        </div>
                        @endif
                    <div class="card-body">
                        <h1 class="text-center">Reset Password</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('password.store') }}" method="POST">
                            @csrf
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$request->email}}"
                                readonly>
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                            </div>
                            <button class="btn btn-info mt-4 text-white">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>