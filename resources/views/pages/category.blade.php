@extends('layouts.main')
 @section('content')
<!-- Lets use third design -->
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-star bg-orange"></i> {{$category->name}} <small class="hidden-xs-down hidden-sm-down"> </small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active"> {{$category->name}} </li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section">
    <div class="container">
        <div class="row">
              @if($category->post()->count()>0)
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-list clearfix">

                      <!-- Loop through post here -->

                      @foreach($category->post as $p)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="{{route('page.single',$p->slug)}}" title="">
                                        <img src="{{url($p->featured)}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="{{route('page.single',$p->slug)}}" title="">{{$p->title}}</a></h4>

                                <small class="firstsmall"><a class="bg-orange" href="{{route('page.single',$category->id)}}" title="">{{$category->name}}</a></small>
                                <small><a href="tech-single.html" title="">{{$p->created_at->toFormattedDateString()}}</a></small>
                                <small><a href="tech-author.html" title="">by Matilda</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> 1114</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->

                        <hr class="invis">
                        @endforeach

            




                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                <hr class="invis">

            </div><!-- end col -->
            @else
              <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
            <h2>No posts onthis category</h2>

            </div>
                        @endif

        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection
