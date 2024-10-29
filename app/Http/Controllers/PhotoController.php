<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Like;
use App\Models\User;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Comment;
use App\Models\Dp; // Assuming this is the model for user profile pictures
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $photos = Photo::all()->shuffle();
    $dp = Dp::all(); // Assuming this contains user profile pictures
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
            $filepath = $request->file('photo')->store('photos', 'public');

            // Create a new photo
            $photo = new Photo();
            $photo->filepath = $filepath;
            $photo->title = $request->input('title');
            $photo->desc = $request->input('desc');
            $photo->save();
        }

        return redirect()->route('photo.index')->with('success', 'Photo created successfully.');
    }
    public function show($photoId)
    {
        $photo = Photo::with(['comments.user', 'likes'])->findOrFail($photoId);
        $user = auth()->user();
        $likedByUser = $photo->likes->contains('user_id', $user->id); // Check if current user liked this photo
    
        return view('photo.show', compact('photo', 'user', 'likedByUser'));
    }
    
   
    // Add a comment to a photo
    public function addComment(StorePhotoRequest $request, $photoId)
    {
        $request->validate([
            'newComment' => 'required|string|max:255',
        ]);

        Comment::create([
            'photo_id' => $photoId,
            'user_id' => auth()->id(), // Assumes user is authenticated
            'content' => $request->newComment,
        ]);

        return redirect()->route('photo.show', $photoId);
    }

    public function toggleLike($photoId)
    {
        $user = auth()->user(); // Assumes user is authenticated
    
        // Check if the user already liked the photo
        $existingLike = Like::where('photo_id', $photoId)
                            ->where('user_id', $user->id)
                            ->first();
    
        if ($existingLike) {
            // If like exists, remove it (dislike)
            $existingLike->delete();
            $liked = false;
        } else {
            // If not liked, add a new like
            Like::create([
                'photo_id' => $photoId,
                'user_id' => $user->id,
            ]);
            $liked = true;
        }
    
        // Return the updated like count
        $likeCount = Like::where('photo_id', $photoId)->count();
    
        return response()->json([
            'liked' => $liked,
            'likeCount' => $likeCount,
        ]);
    }
    


    // Show the form for editing the specified resource.
    public function edit($id)
    {
        return view('photo.edit');
    }

    // Update the specified resource in storage.
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    // Remove the specified resource from stor age.
    public  function destroy(Photo $photo, $id)
    {
        $photo = Photo::Where('id', $id)->first();
        $photo->delete();

        return redirect()->route('photo.index')->with('success', 'Article deleted successfully.');
    }
}