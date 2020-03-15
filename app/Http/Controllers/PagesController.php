<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Setting;
use App\Tag;

class PagesController extends Controller
{
    public function index(){

      // // Take sinle post from 3 categories
      $news1 = Post::where('category_id',4)->first();
      $tech1 = Post::where('category_id',1)->first();
      $travel1 = Post::where('category_id',6)->first();
// Lets get 3 first and skip later below
// $posts_first=post::orderBy('created_at','desc')->take(3)->get();
 // You can use query builder functions to get more posts, enchant_broker_set_ordering
 // them, skip some etc.
 // Lets get 10 recent post for displaying
 // so its display maximum 10
 // You can also skip some posts - > skip() - take ()
$posts= Post::orderBy('created_at','desc')->take(10)->get();
// You can display these dynamically like this or using specific category

$categories =  Category::take(5)->get();
// Since it get single row, so this is not a
// collection of objects but sinle object/ array
$settings =Setting::first();
      return view('pages.index')->with([
        'news1'=>$news1,
        'tech1'=>$tech1,
        'travel1'=>$travel1,
        'posts'=>$posts,
        'categories'=>$categories,
        'settings'=>$settings,
      ]);
    }
    public function single($slug){
      $post= Post::where('slug',$slug)->first();
      $categories =  Category::take(5)->get();
      $settings =Setting::first();

      // Get Next post id
      // So we get next id using this query
          // where id > current id and min of those id
      $next_id= Post::where('id','>',$post->id)->min('id');
      // Get previous post id
      // where id < current id and max of those id
      $prev_id=Post::where('id','<',$post->id)->max('id');

      return view('pages.single')
      ->with('post',$post)
      ->with('categories',$categories)
      ->with('settings',$settings)
      ->with('next',Post::find($next_id))
      ->with('prev',Post::find($prev_id));
    }
    public function category($id){
      $category= Category::find($id);
      $settings =Setting::first();
      $categories =  Category::take(5)->get();
      return view('pages.category')
      ->with('settings',$settings)
      ->with('category',$category)
      ->with('categories',$categories);
    }
    public function tag($id){
      $tag= Tag::find($id);
      $settings =Setting::first();
      $categories =  Category::take(5)->get();
      return view('pages.tag')
      ->with('settings',$settings)
      ->with('tag',$tag)
      ->with('categories',$categories);
    }
}
