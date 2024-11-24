<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['photo_id', 'user_id', 'content'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dp()
    {
        return $this->belongsTo(Dp::class, 'user_id');
    }
    public function getLikedByUserAttribute()
    {
        $userId = Auth::id();
        return $userId ? $this->likes->contains('user_id', $userId) : false;
    }
    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    // Optional: Automatically append these attributes when retrieving the model
    protected $appends = ['liked_by_user', 'likes_count'];
}
