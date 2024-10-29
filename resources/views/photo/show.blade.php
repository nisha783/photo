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

    .container-fluid {
      width: 1400px;
      margin: 20px auto;
      columns: 5;
      column-gap: 40px;
      margin-bottom: 20px;
    }

    .container-fluid.box {
      width: 100px;
    }

    .container-fluid.box img {
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

    .like-section i {
      font-size: 24px;
      cursor: pointer;
      color: #ccc;
      /* Default color */
      margin-right: 5px;
      transition: color 0.3s ease;
    }

    .like-section i.liked {
      color: red;
      /* Color when liked */
    }

    .like-section {
      display: flex;
      align-items: center;
      margin-top: 10px;
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
      <img src="{{ asset($dps->filepath ) }}" alt="no dp" class="rounded-circle ms-1 px-1 py-2" style="height:10vh;width:9vh;">
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
    <a href="{{route('photo.index')}}" class="btn-sm btn btn-primary">ForYou<a>
        <div class="container mt-5">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <img src="{{ asset($photos->filepath) }}" alt="" class="" style="height:70vh; width:80vh; border-radius: 15px;">
                </div>
                <div class="col-6">
                  <div class="like-section mt-5">
                    <h4 class="fw-bold">Likes</h4>

                    <button class="like-button" data-photo-id="{{ $photos->id }}" id="likeButton-{{ $photos->id }}">
                      ❤️ Like
                    </button>
                    <span id="likeCount-{{ $photos->id }}">{{ $photos->likes->count() }}</span> Likes
                  </div>
                  <div class="d-flex">
                    <h3 class="fw-bold">Title:</h3>
                    <p class="mt-2 ps-3">{{$photos->title}}</p>
                  </div>
                  <div class="d-flex">
                    <h3 class="fw-bold">Description:</h3>
                    <p class="mt-2 ps-3">{{$photos->desc}}</p>
                  </div>
                  <h5>Total Comments: {{ $photos->comments_count }}</h5>
                  <form method="POST" action="{{ route('comments.add', $photos->id) }}">
                    @csrf
                    <div class="form-group ">
                      <input type="text" class="form-control" style="border-radius:90px;" placeholder="Write a comment..." name="newComment" required>
                      @error('newComment')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <button type="submit" class=" btn btn-primary mt-2">Comment</button>
                    </div>
                  </form>
                  <ul class="list-group mt-4">
                    @if($photos->comments->isNotEmpty())
                    @foreach($photos->comments as $comment)
                    <li class="list-group-item">
                      <div class="d-flex">
                        @foreach($dp as $dps)
                        <img src="{{ asset($dps->filepath) }}" alt="no dp" class="rounded-circle ms-1 px-1 py-2" style="height:10vh;width:9vh;">
                        @endforeach
                        <strong style="font-size: medium;" class="mt-3">{{ $comment->user->name }}</strong>
                        <p class="mt-3 ms-4">{{ $comment->content }}</p>
                      </div>
                      <small class="text-muted" style="font-size: 14px;">{{ $comment->created_at->diffForHumans() }}</small>
                    </li>
                    @endforeach
                    @else
                    <li>No comments found.</li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>
  </div>
  </div>

  <script>
    document.querySelectorAll('.like-button').forEach(button => {
      button.addEventListener('click', () => {
        const photoId = button.dataset.photoId;

        fetch(`/photo/${photoId}/like`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
          .then(response => response.json())
          .then(data => {
            // Update the like count in the UI
            document.getElementById(`likeCount-${photoId}`).textContent = data.likeCount;

            // Toggle the liked state
            if (data.liked) {
              button.classList.add('liked');
            } else {
              button.classList.remove('liked');
            }
          })
          .catch(error => console.error('Error:', error));
      });
    });
  </script>


</body>

</html>