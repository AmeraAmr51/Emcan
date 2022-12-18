<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function register(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            // Check if user existed OR not 
            $check = User::where('username', $request['username'])->first();

            if ($check)
                return response()->json(array('status' => false, 'message' => "The UserName  is Already Existed", 'statuscode' => 400), 400);


            $user = User::create([
                'username' => $request['username'],
                'password' => Hash::make($request['password']),
                'email' => $request['email'],
                'phone' => $request['phone'],

            ]);
            $user->save();

            DB::commit();
            return response()->json(array('status' => true, 'message' => "Thank You For Your Registration", 'statuscode' => 200), 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function login(Request $request)
    {
        try {
            $data = $request->only('username', 'password');
            $username = $data['username'];
            $password = $data['password'];

            $user = User::where('username', $username)->first();
            if (empty($user)) {
                return response()->json(array('status' => false, 'message' => "No User Found", 'statuscode' => 400), 400);
            } elseif (Hash::check($password, $user->password)) {
                return response()->json(array('status' => true, 'message' => "success", 'statuscode' => 200, 'user_data' => $user));
            }


            return response()->json(array('status' => false, 'message' => "user name and password don't match", 'statuscode' => 400), 400);
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }


    public function getUsers()
    {
        try {
        $users = User::with('projects')->get() ;
        return $users;
       
            
         } catch (Exception) {
            return response()->json(array('status' => false, 'message' => "There is no Users", 'statuscode' => 400), 400);

        }
    }


    
}
