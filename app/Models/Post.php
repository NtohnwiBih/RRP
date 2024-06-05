<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'short', 'content', 'image', 'status'
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function user(){

        return $this->belongsTo(User::class);

    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function relatedPosts()
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id')
                    ->where('id', '!=', $this->id);
    }
}
