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

    .container-fluid {
      margin-top: 30px;
    }

    .photo-item {
      position: relative;
      margin-bottom: 20px;
    }

    .photo-link img {
      width: 100%;
      border-radius: 15px;
      transition: opacity 0.3s ease;
    }

    .photo-link:hover img {
      opacity: 0.7;
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
      opacity: 1;
    }

    .user-info {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
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
    .user-info img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .user-info p {
      font-size: 14px;
      color: #333;
      margin: 0;
    }

    .profile-img {
      margin-top: 15px;
      /* Adjust this as needed */
    }

    .user-info .user-name {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="hero">
    <nav class="bg-dark sticky">
      <i class="mt-2 fw-bold" style="font-size:20px; color:#fff;">PhotoCollection</i>
      <ul class="mt-3">
        <li class="ps-4"><a href="{{ route('photo.index') }}"  class=" fw-bold text-decoration-none" style="color:#fff;">Home</a></li>
        <li class="ps-4"><a href="{{ route('photo.create') }}" class=" fw-bold text-decoration-none" style="color:#fff;">Create</a></li>
        <li class="ps-4"><a href="{{ route('pf.index') }}"     class=" fw-bold text-decoration-none" style="color:#fff;">Profile</a></li>
        <li class="ps-4"><a href="{{ route('user.photos') }}"  class=" fw-bold text-decoration-none" style="color:#fff;">My Photos</a></li>
      </ul>
      @if(Auth::user()->filepath)
      <img src="{{ asset('storage/' . Auth::user()->filepath) }}" alt="Default profile icon" class="rounded-circle m-2" style="height:7vh; width:9vh;">
      @else
      <img src="{{ asset('img/1.jpg.png') }}" alt="default profile icon" class="rounded-circle ms-1 px-1 py-2 profile-img" style="height:10vh;width:9vh;">
      @endif
    </nav>
    <div class="container-fluid mt-3">
      <div class="box">
        @foreach($photos as $photo)
        <div class="photo-item">
          <a href="{{route('photo.show', $photo->id)}}" class="photo-link">
            <img src="{{ asset($photo->filepath)}}" alt="{{ $photo->title }}" class="img-fluid" style="margin-top:20px;">
          </a>
        </div>
        @php
        $userProfile = $photo->user->dp()->first();
        @endphp
        <div class="user-info">
          @if($userProfile)
          <a href="{{ route('job.index') }}" class="photo-link">
            <img src="{{ asset($userProfile->filepath) }}" alt="{{ $photo->title }}">
          </a>
          @else
          <a href="{{ route('job.index') }}" class="photo-link">
            <img src="{{ asset('img/1.jpg.png')}}" alt="{{ $photo->title }}">
          </a>
          @endif
          <p class="user-name">{{ $photo->user->name }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  </div>
  </div>
</body>

</html>