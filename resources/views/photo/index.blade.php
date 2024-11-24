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
      object-fit: cover;
      /* Ensures the image fills its container */
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

    .photo-container {
      position: relative;
      display: block;
    }

    .photo-item .d-flex {
      justify-content: space-between;
      /* Ensures user info is aligned properly */
    }

    nav.sticky {
      position: sticky;
      top: 0;
      z-index: 1000;
      /* Ensures it stays above other elements */
      background-color: #1a1a1a;
      /* Ensures consistent background */
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .photo-item img {
      transition: transform 0.3s ease-in-out;
    }

    .photo-item img:hover {
      transform: scale(1.02);
      /* Slight zoom effect on hover */
    }

    @media (max-width: 768px) {
      .col-3 {
        flex: 1 0 48%;
        /* Two photos per row on medium screens */
      }
    }

    @media (max-width: 480px) {
      .col-3 {
        flex: 1 0 100%;
        /* One photo per row on small screens */
      }
    }
  </style>
</head>

<body>
  <div class="hero">
    <nav class="bg-dark sticky">
      <i class="mt-2 fw-bold" style="font-size:20px; color:#fff;">PhotoCollection</i>
      <ul class="mt-3">
        <li class="ps-4"><a href="{{ route('photo.index') }}" class="text-decoration-none fw-bold" style="color:#fff;">Home</a></li>
        <li class="ps-4"><a href="{{ route('photo.create') }}" class="text-decoration-none fw-bold" style="color:#fff;">Create</a></li>
        <li class="ps-4"><a href="{{ route('pf.index') }}" class="text-decoration-none fw-bold" style="color:#fff;">Profile</a></li>
        <li class="ps-4"><a href="{{ route('user.photos') }}" class="text-decoration-none fw-bold" style="color:#fff;">My Photos</a></li>
      </ul>
      @if(Auth::user()->filepath)
      <img src="{{ asset('storage/' . Auth::user()->filepath) }}" alt="Profile Picture" class="rounded-circle m-2" style="height:7vh;width:9vh;">
      @else
      <img src="{{ asset('img/1.jpg.png') }}" alt="default profile icon" class="rounded-circle m-2 profile-img" style="height:7vh;width:9vh;">
      @endif
    </nav>
    <div class="container-fluid">
      <div class="row">
        @foreach($photos as $photo)
        <div class="col-3">
          <div class="photo-item">
            <div class="photo-container">
              <!-- Photo with link -->
              <a href="{{ route('photo.show', $photo->id) }}" class="photo-link">
                <img src="{{ asset($photo->filepath) }}" alt="{{ $photo->title }}" class="img-fluid p-2">
              </a>
              <a href="{{route('photo.show',$photo->id)}}" class="text-decoration-none" style="position: absolute; top:180px; right: 10px;">
                <i class="bi bi-heart-fill" style="font-size: 24px; color: #fff; border-radius: 50%; padding:2px;"></i>
                <h5 class="text-light text-center" style="font-size: 13px;">{{ $photo->likes->count()}}</h5>
              </a>
              <!-- Comment Icon -->
              <a href="{{ route('photo.show', $photo->id) }}" class="comment-icon" style="position: absolute; top:240px; right: 10px;">
                <i class="bi bi-chat-dots-fill" style="font-size: 24px; color: #fff; border-radius:  50%; padding:2px;"></i>
                <h5 class="text-light text-center" style="font-size: 13px;">{{ $photo->comments_count}}</h5>
              </a>
            </div>
            <div class="d-flex justify-content-start">
              @if($photo->user && $photo->user->filepath)
              <a href="{{ asset('storage/' . $photo->user->filepath) }}" class="photo-link">
                <img src="{{ asset('storage/' . $photo->user->filepath) }}" alt="{{ $photo->title }}" class="rounded-circle" style="height:6vh;width:7vh;">
              </a>
              @else
              <a href="{{ asset('img/1.jpg.png') }}" class="photo-link">
                <img src="{{ asset('img/1.jpg.png') }}" alt="{{ $photo->title }}" class="rounded-circle" style="height:6vh;width:7vh;">
              </a>
              @endif
              <p class="user-name mt-2 ms-2 fw-bold">{{$photo->user->name}}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</body>

</html>