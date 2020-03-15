<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use App\Post;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //get all categories using elequoent
      $categories = Category::all();
      //send this variableto view
          return view('categories.index ')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //1 validation
        $request->validate([
       'name' => 'required|min:4'
   ]);
       // 2 create and save
       $cat = new Category;
       $cat->name=$request->name;
      $cat->save();

     //lets add flash message
      Session::flash('success','Successfully add a Category');
 //3 redirect
        return redirect()->back()->withInput();


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
        // Need to have id sent here
        // find the category of id
        $category = Category::find($id);
        // send to edit category
        return view('categories.edit')->with('category',$category);
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
        //
        $request->validate([
       'name' => 'required|min:4'
   ]);
   //find this category
   //you can use any method but i will prefer this method instead of update method
$category=Category::find($id);
$category->name=$request->name;
$category->save();
Session::flash('success','Category has been updated');
return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
