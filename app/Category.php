<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // categor has many post
    public function post(){
      return $this->hasMany('App\Post');
    }
}
