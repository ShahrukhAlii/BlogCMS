<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Session;
class SettingController extends Controller
{
  public function settings(){
    // Just need one row data
    $setting = Setting::first();
    return view('settings')->with('setting',$setting);
  }

  public function update(Request $request,$id){
    $request->validate([
      'site_name'=>'required',
      'contact_email'=>'required',
      'contact_number'=>'required',
      'copyright_text'=>'required',
      'address'=>'required'
    ]);

    $setting = Setting::find($id);
    $setting->site_name =$request->site_name;
    $setting->contact_email =$request->contact_email;
    $setting->contact_number =$request->contact_number;
    $setting->address =$request->address;
    $setting->copyright_text =$request->copyright_text;

    $setting->save();
    Session::flash('success','Site Settings has been updated');
    return redirect()->back();
  }
}
