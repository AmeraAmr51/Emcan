<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
    $user=User::with('roles')->findOrFail($request->user_id);
    
    if($user->roles->role == $role){
        return $next($request);
        // Check if user has the role This check will depend on how your roles are set up
    }else{
    return response()->json(array('status' => false, 'message' => "You Dont have Role To acsess", 'statuscode' => 400), 400);
    }
      

    }
}
