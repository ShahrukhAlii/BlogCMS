<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

protected $guarded=[];
//
// protected $fillable=['user_id','avatar','about','facebook'];

//one profile belongs to one user
public function user(){
  return $this->belongsTo('App\User');
}

}
