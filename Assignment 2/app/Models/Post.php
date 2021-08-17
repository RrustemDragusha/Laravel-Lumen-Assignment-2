<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Replies;

class Post extends Model
{
    protected $fillable = ['user_id', 'title','description'];


     public function replies(){
          return $this->hasMany(Replies::class);
     }
  

}
