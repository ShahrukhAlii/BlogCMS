<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // many to maney relatioon with post
    public function posts(){
      return $this->belongsToMany('App\Post');
    }
    protected $guarded=[];
    // protected $fillable-['name'];
}
