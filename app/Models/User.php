<?php

namespace App\Models;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
// implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function dp()
    {
        return $this->hasOne(Dp::class);
    }
    public function photos()
    {
        return $this->hasMany(Photo::class); // Each user can upload multiple photos
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
