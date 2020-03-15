@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">Edit User:{{$user->name}}</div>

        <div class="card-body">
@include('layouts.errors')
<form class="" action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')

<h3>General:</h3>
<div class="form-group">
<label for="">Name</label>
<input type="text" name="name" value="{{$user->name}}" class="form-control">

</div>
<div class="form-group">
<label for="">Email</label>
<input type="email" name="email" value="{{$user->email}}" class="form-control">
</div>

<div class="form-group">
<label for="">Change Password</label>
<input type="password" name=" password" value="" class="form-control">
</div>

<h3>Profile</h3>
<img src="{{url($user->profile->avatar)}}" alt="" width="60" height="60">
<br>
<hr>
<div class="form-group">
<label for="">Avatar</label>
<input type="file" name="avatar" value="" class="form-control">
</div>
<div class="form-group">
<label for="">Facebook Profile</label>
<input type="text" name="facebook" value="{{$user->profile->facebook}}" class="form-control">
</div>
<div class="form-group">
<label for="">Short Info:</label>
<textarea name="about" rows="5" class="form-control">{{$user->profile->about}}</textarea>
</div>
<div class="form-group">
<input type="submit" name="submit" value="Update user" class="btn btn-success" >
</div>

</form>
          </div>
          </div>
          </div>
          @endsection
