@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">Edit Post:{{$post->title}}</div>

        <div class="card-body">

          <form class="" action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
       @csrf
       <!-- like we did in categories -->
      @method('PUT')
            <label for=""><strong>Title</strong></label>
            <input type="text" name="title" value="{{$post->title}}" class="form-control">
            <br>
            <label for="">Select Category</label>
            <!--  we just need to store category_id -->
            <!-- lets check each id with the old category_id to select appropiate category after validation errors -->
            <select class="form-control" name="category_id">
@foreach($categories as $cat)
<option value="{{$cat->id}}" {{$cat->id == $post->category_id ? 'selected':''}}>{{$cat->name}}</option>
@endforeach
            </select>
            <br>

            <div class="form-group">
              <!-- we will need checkbox for multiple sesection is neded -->

  <!-- Now we need to see which tags this belongs to by checking them in the checkboxes -->
  <!-- Loop through tags and check ids -->
  <!-- So we need all tags of this post-->
<?php   $post_tags=$post->tags; ?>
            <label for="">Update Tags</label>
            <!-- Value is id in label -->
            <!-- For name we need to have an array -->
            <!-- So dont forget to write array as name -->
            @foreach($tags as $tag)
              <div class="checkbox">
    <label for="tag"><input type="checkbox" name="tag[]" value="{{$tag->id}}"

@foreach($post_tags as $t)
@if( $t->id==$tag->id)
      checked
      @endif
@endforeach> {{$tag->name}}
                </label>
              </div>
              @endforeach
            </div>
<!-- Show featured image -->
<img class="mb-3" src="{{url($post->featured)}}" alt="{{$post->title}}" width="60" height="60">
<br>
<label for="">New Featured Image</label>
<input type="file" name="featured" value="" class="form-control">
<br>
<label for="">Content:</label>
<textarea name="content" rows="10"  class="form-control">{{$post->content}}</textarea>
<br>
<input type="submit" name="submit" value="Update Post "  class="btn btn-success" class="form-control">
          </form>
          </div>
          </div>
          </div>

  @endsection  @section('scripts')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>

      $(document).ready(function(){
        CKEDITOR.replace( 'content' );
      });

                </script>
    @endsection
