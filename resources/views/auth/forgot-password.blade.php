<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="card shadow" style="border:none;">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <b>Success</b>{{session('success')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <h1 class="text-center">Forgot Password</h1>
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
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" >
                            <button class="btn btn-warning mt-4 text-white">Reset </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>