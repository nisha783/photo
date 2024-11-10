<!DOCTYPE html>
<html lang="en">

<head>
  <title>Photo Collection</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    nav.sticky {
      position: sticky;
      top: 0;
      padding: 5px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .hero {
      width: 100%;
      min-height: 100vh;
      background-color: #eceaff;
      color: #525252;
    }

    nav {
      background-color: #1a1a1a;
      width: 100%;
      padding: 10px 10%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
    }

    .logo {
      width: 50px;
      border-radius: 70%;
      cursor: pointer;
      margin-left: 30px;

    }

    nav ul {
      width: 100%;
      text-align: right;

    }

    nav ul li {
      display: inline-block;
      list-style: none;
    }

    nav ul li {
      color: #fff;
      text-decoration: none;
    }

    nav i {
      margin-left: 40px;
    }

    .sub-menu-wrap {
      position: absolute;
      top: 100px;
      right: 10px;
      max-height: 0px;
      width: 320px;
      overflow: hidden;
      transition: max-height 0.5s;
    }

    .sub-menu-wrap.open-menu {
      max-height: 400px;
    }

    .sub-menu {
      background-color: #fff;
      padding: 20px;
      margin: 10px;
    }

    .user-info {
      display: flex;
      align-items: center;
    }

    .container {
      width: 1400px;
      margin: 20px auto;
      columns: 5;
      column-gap: 40px;
      margin-bottom: 20px;
    }

    .container.box {
      width: 100px;
    }

    .container .box img {
      max-width: 100%;
      border-radius: 15px;
    }

    .photo-link {
      display: inline-block;
      /* Adjusts spacing around images */
    }

    .photo-link img {
      transition: opacity 0.3s ease;
      /* Smooth transition for the opacity */
    }

    .photo-link:hover img {
      opacity: 0.5;
      /* Decrease opacity on hover */
    }

    .photo-link:before {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.6);
      transition: opacity 0.1s ease;
    }

    .photo-link:hover:before {
      opacity: 3;
    }
  </style>
</head>

<body>
  <div class="hero">
    <nav class="bg-dark sticky">
      <i class="mt-2" style="font-size:20px; color:#fff;">PhotoCollection</i>
      <ul class="mt-3">
        <li class="ps-4 "><a href="{{route('photo.index')}}" class="text-decoration-none" style="color:#fff;">Home</a></li>
        <li class="ps-4 "><a href="{{route('photo.create')}}" class="text-decoration-none" style="color:#fff;">Create</a></li>
        <li class="ps-4 "><a href="{{route('pf.index')}}" class="text-decoration-none" style="color:#fff;">Profile</a></li>
      </ul>
      @forelse($dp as $dps)
      @if($dps->user_id == Auth::id())
      <!-- Display the profile picture for the current user -->
      <img src="{{ asset($dps->filepath) }}" alt="profile picture" class="rounded-circle ms-1 px-1 py-2" style="height:10vh;width:9vh;">
      @else
      <!-- Default profile icon when the profile picture is not for the current user -->
      <img src="{{ asset('img/1.jpg.png') }}" alt="default profile icon" class="rounded-circle ms-1 px-1 py-2" style="height:10vh;width:9vh;">
      @endif
      @empty
       <!-- No profile picture uploaded -->
       <img src="{{ asset('img/1.jpg.png') }}" alt="default profile icon" class="rounded-circle ms-1 px-1 py-2" style="height:10vh;width:9vh;">
      @endforelse
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="{{asset('img/images.jpg')}}" alt="pic" class="text-center logo">
            <h3 class="text-center">Helo pic</h3>
          </div>
        </div>
      </div>
    </nav>
    <div class="">
      <div class="row justify-content-center align-items-center min-vh-60">
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
              <h1 class="text-center">Edit Profile</h1>
              <form method="POST" action="{{ route('profil.update') }}">
                @csrf
                <di class="form-group mb-3 ">
                  <div class="row">
                    <div class="col-">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>

                  </div>
                  <label for="">Email</label>
                  <input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                  <div class="d-flex justify-content-between">
                    <a href="{{route('pf.index')}}"><i class="mt-3 bi bi-arrow-bar-left fs-3 text-dark fw-bold"></i></a>
                    <button type="submit" class="btn btn-warning text-white mt-4">Save</button>
                  </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

</body>

</html>