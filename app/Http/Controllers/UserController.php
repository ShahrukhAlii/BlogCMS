<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Session;
use Auth;

class UserController extends Controller
{
  public function __construct(){
    $this->middleware('admin')->except('my_profile','update');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Making the email unique so that user cannot add same email twice
        // others are nullable
        $request->validate([
          'name'=>'required',
          'email'=>'required|email|unique:users',
          'password'=>'required|min:5',
        ]);
        //store users
        $user =User::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'password'=>bcrypt($request->password)
        ]);
        // Store Profile
        // Get id from above inserted var

        // Check if avatar uploaded and store file
        if ($request->hasFile('avatar')) {
        $avatar =$request->avatar;
        $filename='avatar-'. time(). '-'.$avatar->getClientOriginalName();
         $avatar->move('uploads/profiles',$filename);
        }
        else {
          $filename="";
        }
        Profile::create([

          'user_id'=>$user->id,
          'avatar'=>'uploads/profiles/'.$filename, //$filename
          'facebook'=>$request->facebook,
          'about'=>$request->about
        ]);
        Session::flash('success','Profile has been created');
        return redirect()->route('users.index');
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
        //
        $user = User::find($id);
        return view('users.edit')->with('user',$user);
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
        // No need to check unique in edit
        $request->validate([
          'name'=>'required',
          'email'=>'required|email|',

        ]);
        // Get user using id
         $user = User::find($id);
         $user->name=$request->name;
          $user->email=$request->email;
          // Check if User has input password, If you only then update

  if (isset($request->password)) {
    $user->password =bcrypt($request->password);
  }

$user->save();
$profile =$user->profile;

// profile
// Check if request  has the avatar uploaded
if ($request->hasFile('avatar')) {
$avatar =$request->avatar;
$filename='avatar-'. time(). '-'.$avatar->getClientOriginalName();
 $avatar->move('uploads/profiles',$filename);

 $profile->avatar='uploads/profiles/'.$filename;
}

$profile->facebook = $request->facebook;
$profile->about = $request->about;
$profile->save();
// So updating in this way allows to check condition
// in between
Session::flash('success','Profile has been successfully Updated');
return redirect()->route('home');
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
        $user =User::find($id);
        $user->delete();
        // You need to also remove profiles data related to this user

        // Yuo would want to remove avatar if unnecessary for further user
        // You can use php unlink function
if (file_exists($user->profile->avatar)) {
  unlink($user->profile->avatar);
}

           $user->profile->delete();
           session::flash('success','user has ben successflully removed');
           return redirect()->back();
    }
    public function make_admin($id){
      $user =User::find($id);

      // Change isadmin field
      $user->isAdmin = 1;
      $user->save();
    Session::flash('success','Status changed to admin');
    return redirect()->back();
    }


    public function remove_admin($id){
      $user =User::find($id);

      // Change isadmin field
      $user->isAdmin = 0;
      $user->save();

      Session::flash('success','Removed admin status');
      return redirect()->back();
    }
    public function my_profile(){
     $id=Auth::id();
     $user=User::find($id);
     return view('users.profile')->with('user',$user);
    }
}
