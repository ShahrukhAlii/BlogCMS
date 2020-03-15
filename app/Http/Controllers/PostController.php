<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Category;
use  App\Post;
use  App\Tag;
use Session;

class PostController extends Controller
{
//this is another way to add auth     // public function __construct()
  // {
  //     $this->middleware('auth')->except('index');
  // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts =Post::all();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // get all categories
       $categories =Category::all();

if ($categories->count()==0) {
  // add new message type as info
  Session::flash('info','Please add category before continuing');
  return redirect()->back();
}
            $tags=Tag::all();
              return view('posts.create')->with('categories',$categories)->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // form Invalidation
        //another method
        $this->validate($request,[
          'title'=>'required',
          'featured'=>'required|image ',
          'content'=>'required',
          'category_id'=>'required'
        ]);
        // change image name
        // chaning the name because user can add images with same name or multiple names of images
          $featured =$request->featured;
          $originalName = $featured->getClientOriginalName();
          $featured_new_name='featured-'. time() . '-'. $originalName;
          // we will store this name
      //    echo $featured_new_name;

        // save the image into directry

         // we can use move method on this
         $featured->move('uploads/posts',$featured_new_name);
         //add path that takes easier  during the view
         // we will use a available function to convert title to slug
         $post = Post::create([
           'title'=>$request->title,
           'content'=>$request->content,
           'featured'=>'uploads/posts/'. $featured_new_name,
           'category_id'=>$request->category_id,
            'slug' => str_slug($request->title),
         ]);
        // create posts//flash message
        //so we have insered $post, so we can us it and
        //another method called attach() to add data into pivot table
    $post->tags()->attach($request->tag);
        Session::flash('success','Post has been created');
        //redirect ti index post
        return redirect()->route('posts.index')->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //send to new page with edit form
        $post=Post::find($id);
        $categories=Category::all();
        $tags=Tag::all();
        return view('posts.edit')->with('post',$post)->with('categories',$categories)->with('tags',$tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //make featured not required as user may not need to update it
      $this->validate($request,[
        'title'=>'required',
        'featured'=>'image ',
        'content'=>'required',
        'category_id'=>'required'
      ]);
      $post=Post::find($id);
      //now before saving first we check if featured image is updloaded then only upload amd pdate te table for, featured
      if ($request->hasFile('featured')) {
        $featured =$request->featured;
        $originalName=$featured->getClientOriginalName();
        $featured_new_name='featured-'. time(). '-'.$originalName;

        //move
        $featured->move('uploads/posts',$featured_new_name);

        //now need to update new name
        $post->featured='uploads/posts/'.$featured_new_name;
      }
      //Update remainig fields

      $post->title=$request->title;
      $post->content=$request->content;
      $post->category_id=$request->category_id;
      $post->save();
      //Use relationship, above $post variable and new method called sync()
      // synce removes old ids of tags related to this post updates
      $post->tags()->sync($request->tag);
      Session::flash('success','Post has been successfully updated');
      return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // to delete first find post id
        // Since we set up softdeletes
        //in model the post will not be permenttly deleted but the deleted_at updated
          $post=Post::find($id);
        $post->delete();
        Session::flash('success','Post has been deleted');
        return redirect()->back();
    }
    public function trashed(){
      //to get softdeletes we use quuery builder
      $posts=Post::onlyTrashed()->get();

      return view('posts.trashed')->with('posts',$posts);
    }
    public function restore($id){
      //we will against use a method to get trashed
      // posts and restore . us id to get single row using first( ) method

       // so get post with trashed where id = $id and get first row
      $post =Post::withTrashed()->where('id',$id)->first();
      // restore
      $post->restore();
      Session::flash('success','Post has been successfully restored');
      return redirect()->route('posts.index');
    }
    public function kill($id){
      $post=Post::withTrashed()->where('id',$id)->first();
      $post->forceDelete();
      Session::flash('success','Post has been deleted permently');
      // return redirect()->route('posts.index');
      return redirect()->back();
    }
}
