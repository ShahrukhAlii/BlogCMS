@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">Add New Post</div>

        <div class="card-body">

          <form class="" action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
       @csrf
            <label for=""><strong>Title</strong></label>
            <input type="text" name="title" value="{{old('title')}}" class="form-control">
            <br>
            <!-- after fresh migration no categories are available to add here so lets add there
          so lets check in controller and redirect if no category exist -->
            <label for="">Select Category</label>
            <!--  we just need to store category_id -->
            <!-- lets check each id with the old category_id to select appropiate category after validation errors -->


            <select class="form-control" name="category_id">
@foreach($categories as $cat)
<option value="{{$cat->id}}" {{old('category_id') == $cat->id ? 'selected':''}}>{{$cat->name}}</option>
@endforeach
            </select>
            <br>
    <!-- for tag purpose  -->    <!-- Get and display  tgs here -->
<div class="form-group">
  <!-- we will need checkbox for multiple sesection is neded -->
<label for="">Add Tags</label>
<!-- Value is id in label -->
<!-- For name we need to have an array -->
<!-- So dont forget to write array as name -->
@foreach($tags as $tag)
  <div class="checkbox">
    <label for="tag">    <input type="checkbox" name="tag[]" value="{{$tag->id}}">
 {{$tag->name}}
    </label>
  </div>
  @endforeach
</div>

<!-- Need to get categories at there -->
<br>
<label for="">Featured Image</label>
<input type="file" name="featured" value="" class="form-control">
<br>
<label for="">Content:</label>
<textarea name="content" id="content" rows="10" class="form-control">{{old('content')}}</textarea>
<br>
<input type="submit" name="submit" value="Create post" class="btn btn-success" class="form-control">
          </form>
          </div>
          </div>
          </div>

  @endsection
  @section('scripts')
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>

    $(document).ready(function(){
      CKEDITOR.replace( 'content' );
    });

              </script>
  @endsection
