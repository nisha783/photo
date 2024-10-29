<!DOCTYPE html>
<html lang="en">

<head>
    <title> Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
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
                      
                        <form method="POST" action="{{ route('login') }}">
        @csrf
       <div class="d-flex justify-content-center    m-2 fs-5">
           <img src="{{ asset('img/images.jpg') }}" alt="" height="60px" class="rounded-circle ms-2">
           </div>
        <!-- Modal body -->
         <div class="justify-content-center">
             <h3 class="text-center fw-bold">Log in to See More Collection</h3>
            </div>
      <di class="form-group mb-3 p-3">
              <label for="">Email</label>
              <input type="text" class="form-control" name="email" placeholder="Enter email" style="color: grey; font-size: small;">
        <label for="password">Password</label>
        <input type="text" name="password" class="form-control" placeholder="Enter password" style="color: grey; font-size: small;">   
<div class="d-flex justify-content-center" style="font-size: x-large;">
    <button class=" badge rounded-pill  bg-warning text-white mt-4">Log In</button>
</div>

<a class=" text-dark" href="{{ route('password.request') }}">Forgot Password?</a>
      </div>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>