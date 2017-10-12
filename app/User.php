<?php

namespace App;

use App\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

   public function alreadyliked(Post $post)
    {
        return $post->liked->contains('user_id', $this->id);
    }
    
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'created_at', 'updated_at'
    ];
}
