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
      @foreach($dp as $dps)
      <img src="{{ asset($dps->filepath) }}" alt="helo" class="rounded-circle px-1 py-2 ms-1" style="height:11vh;width:10vh;">
      @endforeach
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="{{asset('img/images.jpg')}}" alt="pic" class="text-center logo">
            <h3 class="text-center">Helo pic</h3>
          </div>
        </div>
      </div>
    </nav>
    <div class=" mt-3">
      <div class="row justify-content-center align-items-center min-vh-50 auto">
        <div class="col-lg-6" style="margin-left:400px;">
          <div class="mt-5   border-0">
            <div class="d-flex">
              @foreach($dp as $dps)
              <img src="{{ asset($dps->filepath) }}" alt="no dp" class="rounded-circle" style="height:10vh;width:9vh;">
              @endforeach
              <h3 class="fs-1  text-grey">{{auth()->user()->name}}</h3>
            </div>
            <p class="text-grey px-3" style="margin-left:60px;">{{auth()->user()->email}}</p>
            <a href="{{route('profil.edit')}}" class="btn btn-light px-3" style="border-radius:40px;">Edit Profile</a>
            <a href="{{route('password.edit')}}" class="btn btn-light px-3" style="border-radius:40px;"> Change Password</a>
            <div class="d-flex mt-3">
              <button type="button" class="btn btn-light" style="border-radius:40px;" data-bs-toggle="modal" data-bs-target="#myModal">
                Change Profile
              </button>
              <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <button type="button" class="btn-close m-4" data-bs-dismiss="modal"></button>
                    <div class="modal-body">
                      @if(session('success'))
                      <div>{{ session('success') }}</div>
                      @endif

                      @if($errors->any())
                      <div>
                        @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                      </div>
                      @endif

                      @if(session('error'))
                      <div>{{ session('error') }}</div>
                      @endif
                      <form action="{{route('dp.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center">
                          <h3>Click to Upload Profile</h3>
                          <input type="file" class="form-control mt-3" name="dp" id="filepath">
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                          <button type="submit" class="btn-sm btn btn-dark">Upload</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-light px-3 ms-5 mt-3" style="border-radius: 40px;">
                  Logout
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
</body>

</html>