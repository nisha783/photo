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
    }

    .navbar-brand img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    .like-section i {
      font-size: 24px;
      cursor: pointer;
      color: #ccc;
      transition: color 0.3s ease;
    }

    .like-section i.liked {
      color: red;
    }

    @media (max-width: 768px) {
      .card img {
        width: 100%;
        height: auto;
      }

      .card-body {
        padding: 15px;
      }
    }
  </style>
</head>

<body>
  <div class="hero">
    <!-- Responsive Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <i class="m-2 fw-bold" style="font-size:20px; color:#fff;">PhotoCollection</i>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="{{ route('photo.index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="{{ route('photo.create') }}">Create</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="{{ route('pf.index') }}">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="{{ route('user.photos') }}">My Photos</a>
            </li>
          </ul>
          <div class="d-flex align-items-center">
            @if(Auth::user()->filepath)
            <img src="{{ asset('storage/' . Auth::user()->filepath) }}" alt="Profile Picture"
              class="rounded-circle ms-3" style="height:40px;width:40px;">
            @else
            <img src="{{ asset('img/1.jpg.png') }}" alt="Default Profile Picture" class="rounded-circle ms-3"
              style="height:40px;width:40px;">
            @endif
          </div>
        </div>
      </div>
    </nav>

    <!-- Responsive Card -->
    <div class="container mt-5">
      <div class="card" style="border-radius: 15px;">
        <div class="row g-0">
          <div class="col-lg-6 col-md-12">
            <img src="{{ asset($photos->filepath) }}" alt="" class="img-fluid" style="border-radius: 15px;">
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card-body">
              <div class="like-section mb-3">
                <i id="like-icon" class="bi bi-heart-fill {{ $likedByUser ? 'text-danger' : 'text-muted' }}"
                  onclick="toggleLike('{{ $photos->id }}')"></i>
                <span id="like-count">{{ $photos->likes->count() }} likes</span>
              </div>
              <h5 class="fw-bold">Title:</h5>
              <p>{{$photos->title}}</p>
              <h5 class="fw-bold">Description:</h5>
              <p>{{$photos->desc}}</p>
              <h5>Total Comments: {{ $photos->comments_count}}</h5>
              <form method="POST" action="{{ route('comments.add', $photos->id) }}">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Write a comment..." name="newComment" required>
                  @error('newComment')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <button type="submit" class="btn btn-primary mt-2">Comment</button>
                </div>
              </form>
              <ul class="list-group mt-4">
                @if($photos->comments->isNotEmpty())
                @foreach($photos->comments as $comment)
                <li class="list-group-item">
                  <div class="d-flex align-items-start">
                    @if($comment->user && $comment->user->filepath)
                    <a href="{{ route('job.index') }}" class="photo-link">
                      <img src="{{ asset('storage/' . $comment->user->filepath) }}"
                        alt="{{ $comment->user->name }}"
                        class="rounded-circle m-2"
                        style="height:7vh;width:9vh;">
                    </a>
                    @else
                    <a href="{{ route('job.index') }}" class="photo-link">
                      <img src="{{ asset('img/1.jpg.png') }}"
                        alt="default profile"
                        class="rounded-circle m-2"
                        style="height:7vh;width:9vh;">
                    </a>
                    @endif
                    <div>
                      <strong>{{ $comment->user->name }}</strong>
                      <p class="mb-1">{{ $comment->content }}</p>
                      <div class="d-flex">
                        <small class="text-muted mt-3" style="font-size: 14px;">{{ $comment->created_at->diffForHumans()}}</small>
                        @if(Auth::id() == $comment->user->id)
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="m-2">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>
                </li>
                @endforeach
                @else
                <li class="ms-5">No comments found.</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function toggleLike(photoId) {
      $.ajax({
        url: `/photo/${photoId}/like`,
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.liked) {
            $('#like-icon').addClass('text-danger').removeClass('text-muted');
          } else {
            $('#like-icon').addClass('text-muted').removeClass('text-danger');
          }
          $('#like-count').text(response.likesCount + ' likes');
        },
        error: function(error) {
          console.error('Error:', error);
        }
      });
    }
  </script>
</body>

</html>