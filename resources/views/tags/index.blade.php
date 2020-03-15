@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">Tags
        </div>

        <div class="card-body">
<div class="row">
  <div class="col-md-12">
  @include('layouts.errors')
  </div>
<div class="col-md-6">
  <!-- lets get count of osts for each category -->
  <table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th width="30">S.N</th>
          <th>Name</th>
          <th>Posts count</th>
          <th>Actions</th>
      </tr>
    </thead>
    <tbody>

        @if(count($tags)>0)
      @foreach($tags as $tag)
      <tr>
        <td>{{$tag->id}}</td>
        <td>{{$tag->name}}</td>
        <td>{{$tag->posts->count() }}</td>
        <td>
<!-- Add aa link to edit to route -->
        <a href="{{route('tags.edit',$tag->id)}}">Edit</a>
        </td>
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="4">No tags at the moment</td>
      </tr>
      @endif
    </tbody>
  </table>

</div>
<div class="col-md-6">
<form action="{{route('tags.store')}}" method="post">
  @csrf
  <label for="Cat"><strong>Add Tags</strong></label>
  <input type="text" name="name"  class="form-control">
  <br>
  <input type="submit" name="submit" value="Create" class="btn btn-primary" class="form-control">
</form>
</div>
</div>
          </div>
          </div>
          </div>

  @endsection
