<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'post_content'
    ];

    protected $appends = ['total_like'];
    protected $hidden = ['pivot'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function likes()
    {
    	return $this->belongsToMany(User::class, 'likes');
    }

    public function liked()
    {
        return  $this->hasMany(Like::class, 'post_id');
    }

    public function getTotalLikeAttribute()
    {
    	return $this->likes()->count();
    }
}
