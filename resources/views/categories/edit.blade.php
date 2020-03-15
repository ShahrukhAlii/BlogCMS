@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">Edit Category</div>

        <div class="card-body">
<div class="row">
  <div class="col-md-12">
  @include('layouts.errors')


  <form action="{{route('categories.update',$category->id)}}" method="post">
    <!-- We need to add a method to prevent csrf attack -->
    @csrf
    <!-- for updating any data in laravel you need to overside this post method with put -->
    @method('PUT')
    <label for="Cat"><strong>Update Category</strong></label>
    <input type="text" name="name" value="{{$category->name}}"  class="form-control">
    <br>
    <input type="submit" name="submit" value="Update" class="btn btn-primary" class="form-control">
  </form>
    </div>
  </div>
  </div>
</div>
</div>

@endsection
