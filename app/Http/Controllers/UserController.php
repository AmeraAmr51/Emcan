<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //Fun Return the register view 
    public function indexRegister()
    {
        return view('register');
    }

    // Fun to create new user 
    public function register(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            if (isset($request['submit'])) {
                $user = User::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role_id' => 2,
                    'password' => Hash::make($request->password)

                ]);
                $user->save();
                DB::commit();
                return redirect()->route('home');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', __("word.same_error"));
        }
    }

    // Fun to Return Login view
    public function indexLogin()
    {
        return view('login');
    }

    // Fun to login 
    public function login(UserRequest $request)
    {
        try {
            if (isset($request['submit'])) {

                $username = $request->username;
                $password = $request->password;
                $user = User::where('username', $username)->first();
                if (Hash::check($password, $user->password)) {
                    return redirect()->route('home');
                }
            }
        } catch (Exception $e) {

            return $e->getMessage();
            return back()->with('error', __("word.same_error"));
        }
    }


    public function getUsers()
    {
        try {
            $users = User::with('projects')->get();
            return $users;
        } catch (Exception) {
            // return response()->json(array('status' => false, 'message' => "There is no Users", 'statuscode' => 400), 400);
        }
    }

    public function index()
    {
        return view('welcome');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect(route('login'));
    }
}
