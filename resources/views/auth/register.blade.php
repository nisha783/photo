<!DOCTYPE html>
<html lang="en">

<head>
    <title>Photo Collection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-80">
            <div class="col-lg-6">
                <div class="card mt-5 shadow border-0">
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
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

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="justify-content-center">
                                <h3 class="text-center fw-bold"> Photo Collection</h3>
                            </div>
                            <di class="form-group mb-3 p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter name" style="color: grey; font-size: small;">
                                    </div>
                                </div>
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email" style="color: grey; font-size: small;">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter password" style="color: grey; font-size: small;">
                                    </div>
                                    <div class="col-12">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="password_confirmation" style="color: grey; font-size: small;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="country">Select Country:</label>
                                    <select id="country" name="country" class="form-select" style="color: grey; font-size: small;">
                                        <option value="us">United States</option>
                                        <option value="ca">Canada</option>
                                        <option value="br">Brazil</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-warning text-white mt-4">Sign In</button>
                                    <a class="ps-3 mt-5 text-dark" href="{{ route('login') }}">Already have Register?</a>
                                </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>