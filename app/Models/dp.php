<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class dp extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'filepath'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In your User or Dp model
protected static function booted()
{
    static::deleting(function ($dp) {
        // Delete the profile picture when the user is deleted
        if ($dp->filepath) {
            Storage::disk('public')->delete($dp->filepath);  // Deletes the file
        }
    });
}

}
