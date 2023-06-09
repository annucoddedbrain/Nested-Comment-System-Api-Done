<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'parent_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->belongsTo(Post::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class , 'parent_id');
    }

    public function likes()
    {
         return $this->morphMany(Like::class, 'likeable')->where('liked','1');
    }    

}
