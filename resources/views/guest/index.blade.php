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
      justify-content: end;
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

    .container-fluid {
      width: 1300px;
      margin: 20px auto;
      columns: 5;
      column-gap: 40px;
      margin-bottom: 20px;
    }

    .container-fluid.box {
      width: 100px;
    }

    .container-fluid .box img {
      max-width: 100%;
      border-radius: 15px;
    }
  </style>
</head>

<body>
  <div class="hero">
    <nav class="bg-dark sticky">
      @if (Route::has('login'))
      @auth
      <a
        href="{{ url('/photo') }}"
        class="px-3 py-2 text-decoration-none text-white" style="font-size:30px;">
        Dashboard
      </a>
      @else
      <a
        href="{{ route('login') }}"
        class="rounded-md px-3 py-2 text-white text-decoration-none te dark:hover:text-white/80 dark:focus-visible:ring-white" style="font-size:30px;">
        Log in
      </a>

      @if (Route::has('register'))
      <a
        href="{{ route('register') }}"
        class="rounded-md px-3 py-2 text-white text-decoration-none" style="font-size:30px;">
        Register
      </a>
      @endif
      @endauth
    </nav>
    @endif
    </header>
    <div class="sub-menu-wrap" id="subMenu">
      <div class="sub-menu">
        <div class="user-info">
          <h3 class="text-center">Helo pic</h3>
        </div>
      </div>
    </div>
    </nav>
    <div class="container-fluid mt-3">
      <div class="box">
        @foreach($photos as $photo)
        <div class="photo-item">
          <a href="{{route('photo.show', $photo->id)}}" class="photo-link">
            <img src="{{ asset($photo->filepath)}}" alt="{{ $photo->title }}" class="img-fluid" style="margin-top:20px;">
          </a>
        </div>
        @endforeach
      </div>
</body>

</html>