<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      // For now is basically recieves and returns for next
      //request after previous is finished
      // Now we can check or filter simply the isAdmin field
      // annd use this middleware like any other default middleware

      if (!Auth::user()->isAdmin) {
        //If not admin redirect back with a message
        Session::flash('info','You do not have permission to perform is action');

         return redirect()->back();
      }
        return $next($request);
    }
}
