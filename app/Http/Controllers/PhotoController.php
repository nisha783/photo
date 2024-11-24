<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Like;
use App\Models\User;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Comment;
use App\Models\Dp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('user')->withCount(['comments'])->get()->shuffle();
        $dp = Dp::all();
        return view('photo.index', compact('photos', 'dp'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $dp = Dp::all();
        return view('photo.create', compact('dp'));
    }

    // Store a newly created resource in storage.
    public function store(StorePhotoRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'photo' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle the file upload
        if ($request->hasFile('photo')) {
            $filepath = $request->file('photo')->store('img', 'public');

            // Create a new photo
            $photo = new Photo();
            $photo->filepath = $filepath;
            $photo->title = $request->input('title');
            $photo->desc = $request->input('desc');
            $photo->user_id = Auth::id();
            $photo->save();
        }

        return redirect()->route('photo.index')->with('success', 'Photo created successfully.');
    }



    public function show($photoId)
    {
        $photos = Photo::with(['comments.user', 'likes'])->findOrFail($photoId);
        $user = Auth::user();
        $dp = Dp::all();
        $likedByUser = $photos->likes->contains('user_id',  $user->id);
        return view('photo.show', compact('photos', 'user', 'dp', 'likedByUser'));
    }

    public function userPhotos()
    {
        $photos = Photo::where('user_id', Auth::id())->get();
        $dp=Dp::all();
        return view('job.index', compact('photos','dp'));
    }
    
    public function addComment(StorePhotoRequest $request, $photoId)
    {
        $request->validate([
            'newComment' => 'required|string|max:255',
        ]);

        Comment::create([
            'photo_id' => $photoId,
            'user_id' => auth()->id(),
            'content' => $request->newComment,
        ]);

        return redirect()->route('photo.show', $photoId);
    }

    public function toggleLike(Request $request, Photo $photo)
    {
        //info("here");
        $user = Auth()->user();
        $user = Auth::user();

        info("now saving new like");
        // Check if the user already liked the photo
        $like = $photo->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // info("User already cliked");
            // Unlike if already liked
            $like->delete();
            $liked = false;
        } else {
            // info("User new like");
            // Like if not liked
            $photo->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        // info("All Okay in controller");
        return response()->json([
            'liked' => $liked,
            'likesCount' => $photo->likes()->count(),
        ]);
    }

    public function edit($id)
    {
        return view('photo.edit');
    }

    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    // Remove the specified resource from stor age.
    public  function destroy(Photo $photo, $id)
    {
        $photo = Photo::Where('id', $id)->first();
        $photo->delete();

        return redirect()->route('photo.index')->with('success', 'deleted successfully.');
    }
}
