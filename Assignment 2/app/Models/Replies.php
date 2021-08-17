<?php

namespace App\Models;
use App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    // protected $fillable = ['user_id', 'post_id', 'description'];

    // public function posts(){
    //     return $this->belongsTo(Post::class);
    // }

    protected $guarded = [];
}
