@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">View All Users</div>

        <div class="card-body">

<table class="table table-bordered table-condensed">
  <thead>
    <tr>

      <th>Name</th>
      <th>Email</th>
      <th>Permissions</th>
      <th>Avatar</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
         <!-- Check if working -->
         <!-- This way you can get authenticated user  -->
         <!-- So current user is admin -->
         <!-- Lets check for each admin and add button to
           change status -->

     @if( $user->isAdmin)
    <a href="{{route('remove.admin',$user->id)}}" class="btn btn-warning">Remove Admin</a>
     @else
<a href="{{route('make.admin',$user->id)}}" class="btn btn-success">Make Admin</a>
     @endif
      </td>
      <th>

<!-- get avatar using user profile relation -->
<img src="{{url($user->profile->avatar)}}" alt="" width="60" height="60">
      </th>
      <th>
<a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
      </th>
      <th>
        <form class="" action="{{route('users.destroy',$user->id)}}" method="post">
             @csrf
             @method('DELETE')
            <input type="submit" name="submit" value="Delete" class="btn btn-danger">
        </form>

      </th>
    </tr>
    @endforeach
  </tbody>
</table>
          </div>
          </div>
          </div>
          @endsection
