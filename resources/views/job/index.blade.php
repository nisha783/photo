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
            <i class="mt-2 fw-bold" style="font-size:20px; color:#fff;">PhotoCollection</i>
            <ul class="mt-3">
                <li class="ps-4 "><a href="{{route('photo.index')}}" class="text-decoration-none fw-bold" style="color:#fff;">Home</a></li>
                <li class="ps-4 "><a href="{{route('photo.create')}}" class="text-decoration-none fw-bold" style="color:#fff;">Create</a></li>
                <li class="ps-4 "><a href="{{route('pf.index')}}" class="text-decoration-none fw-bold" style="color:#fff;">Profile</a></li>
                <li class="ps-4"><a href="{{ route('user.photos') }}" class="text-decoration-none fw-bold" style="color:#fff;">My Photos</a></li>
            </ul>
            @if(Auth::user()->filepath)
            <img src="{{ asset('storage/' . Auth::user()->filepath) }}" alt="Profile Picture" class="rounded-circle m-2" style="height:7vh;width:9vh;">
            @else
            <img src="{{ asset('img/1.jpg.png') }}" alt="default profile icon" class="rounded-circle m-2 profile-img" style="height:7vh;width:9vh;">
            @endif
        </nav>
        <div class=" mt-3">
            <div class="row justify-content-center align-items-center min-vh-50 auto">
                <div class="col-lg-6" style="margin-left:400px;">
                    <div class="mt-5   border-0">
                        <div class="">
                            @if(Auth::user()->filepath)
                            <img src="{{ asset('storage/' . Auth::user()->filepath) }}" alt="Profile Picture" class="rounded-circle m-2" style="height:21vh;width:23vh;">
                            @else
                            <img src="{{ asset('img/1.jpg.png') }}" alt="default profile icon" class="rounded-circle m-2 profile-img" style="height:21vh;width:23vh;">
                            @endif
                        </div>
                        <div class="">
                            <i class="fw-bold">{{auth()->user()->name}}</i>
                            <p class="text-grey">{{auth()->user()->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h3 class="fw-bold text-center">My Photo</h3>
        <div class="row  mb-2">
            @forelse($photos as $photo)
            <div class="col-3">
                <a href="{{ route('photo.show', $photo->id) }}" class="photo-link">
                <img src="{{ asset($photo->filepath) }}" alt="{{ $photo->title }}" class="img-fluid p-2 ms-3" style="border-radius: 30px;">
              </a>
            </div>
            @empty
            <li class="text-center ">No photos found for you.</li>
            @endforelse
        </div>
    </div>
    </div>
</body>

</html>