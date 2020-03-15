<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Post extends Model
{
  //this will enable to use this feature
use softDeletes;
    protected $table ="posts";
// since new timestamp field is added you can add to protected $dates
protected $dates=['deleted_at'];
// protected $guarded = ['*'];

protected $fillable=['title','content','category_id','featured','slug'];
    // protected $fillable = [
    //   'title','content','category_id','featured'
    // ];

//post belongs to category

    public function category(){
      return $this->belongsTo('App\Category');
    }


// many to many relationship with Tags
public function tags(){
  return $this->belongsToMany('App\Tag');
}

}
