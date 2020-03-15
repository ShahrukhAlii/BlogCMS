@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">View All Posts
        </div>

        <div class="card-body">

<table class="table table-bordered">
  <thead>
    <tr>
      <th width="40">S.N</th>
      <th>Title</th>
      <!-- <th>Content</th> -->
      <th>Featured image</th>
      <th>Category</th>
      <th>Edit</th>
      <th>Trash</th>
    </tr>
  </thead>
  <tbody>
  @if(count($posts)>0)
    @foreach($posts as $post)
    <tr>
      <td>{{$post->id}}</td>
      <td>{{$post->title}}</td>
      <!-- You may need to display formatted
            content without html tags  to do that-->

      <!-- It is usefull for the front end -->
      <!-- <td>{!! $post->content !!}</td> -->
      <!-- <td>{!! Str::limit($post->content, 20, ' ...') !!}</td> -->
      <td>
<img src="{{url($post->featured)}}" alt="{{$post->title}}" width="60" height="60">
      </td>
      <!-- you canuse the relationship to get the category of each post directly -->
      <td>{{$post->category->name}}</td>
   <td>
<a href="{{route('posts.edit',$post->id)}} " class="btn btn-success ">Edit</a>

   </td>
   <td>
     <!-- You can use simple get method to delete the post or any other model or by prefered method
     of resource controller for laravel is using form and method Delete -->
     <form class="" action="{{route('posts.destroy',$post->id)}}" method="post">
       @csrf
       @method('DELETE')
       <input type="submit" name="submit" value="Trash" class="btn btn-warning">
     </form>

    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="6">No posts found </td>
    </tr>
    @endif
  </tbody>
</table>
        </div>
          </div>
          </div>

  @endsection
