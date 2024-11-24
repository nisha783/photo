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
    .hero {
      width: 100%;
      min-height: 100vh;
      background-color: #eceaff;
      color: #525252;
    }

    nav {
      background-color: #1a1a1a;
      width: 100%;
      padding: 5px 0%;
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

    nav ul li:hover {
      color: blue;
      font-weight: 40px;
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
  </style>
</head>

<body>
  <div class="hero">
    <nav class="bg-dark">
      <i class="mt-2 ms-4 fw-bold" style="font-size:20px; color:#fff;">PhotoCollection</i>
      <ul class="mt-3">
        <li class="ps-4 "><a href="{{route('photo.index')}}"  class="text-decoration-none fw-bold" style="color:#fff;">Home</a></li>
        <li class="ps-4 "><a href="{{route('photo.create')}}" class="text-decoration-none fw-bold" style="color:#fff;">Create</a></li>
        <li class="ps-4 "><a href="{{route('pf.index')}}"     class="text-decoration-none fw-bold" style="color:#fff;">Profile</a></li>
        <li class="ps-4"><a href="{{ route('user.photos') }}" class="text-decoration-none fw-bold" style="color:#fff;">My Photos</a></li>
      </ul>
      @if(Auth::user()->filepath)
      <img src="{{ asset('storage/' . Auth::user()->filepath) }}" alt="Profile Picture" class="rounded-circle m-2" style="height:7vh;width:9vh;">
      @else
      <img src="{{ asset('img/1.jpg.png') }}" alt="default profile icon" class="rounded-circle m-2 profile-img" style="height:7vh;width:9vh;">
      @endif
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="{{asset('img/images.jpg')}}" alt="pic" class="text-center logo">
            <h3 class="text-center">Helo pic</h3>
          </div>
        </div>
      </div>
    </nav>
    <div class="container mt-3">
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
      <form action="{{route('photo.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
          <div class="col-6 mt-3">
            <div class="card" style="height: 60vh; border: dashed; border-color:#ccc;">
              <div class="d-flex text-center m-5">
                <div class="upload-card">
                  <p class="fs-3">Click to upload a file</p>
                  <input type="file" id="fileInput" name="photo" class="text-center btn btn-dark text-white">
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <label for="title" class="text-dark fs-2">Title</label>
            <input type="text" name="title" class="mt-2 form-control text-dark" style="border-radius:5px;" placeholder="Add a Title">
            <div class="form-group mt-3">
              <label for="desc" class="text-dark  fs-2">Description</label>
              <textarea name="desc" class="mt-2 form-control text-dark" placeholder="Add a Description" rows="8"></textarea>
            </div>
            <div class="d-felx mt-4 text-end">
              <button type="submit" class="btn btn-dark text-white">Publish</button>
            </div>
      </form>
    </div>
  </div>
  </div>
  <script>
    let subMenu = document.getElimentById('subMenu');

    function toggleMenu() {
      subMenu.classlist.toggle("open-menu");
    }
  </script>
</body>

</html>