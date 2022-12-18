<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPostByUser($id)
    {
        try {
            $posts = Post::where('user_id', $id)->with('comment')->get();
            return response()->json(array(
                'status' => true,
                'data' => $posts,
                'statuscode' => 200
            ), 200);
        } catch (Exception $e) {
            return response()->json(array('status' => false, 'message' => "There is no Post for this user", "error" => $e->getMessage(), 'statuscode' => 400), 400);
        }
    }

    public function getAllPosts()
    {
        try {
            $posts = Post::with('comment:post_id,comment')->with('user:id,username')->get();
            return response()->json(array(
                'status' => true,
                'data' => $posts,
                'statuscode' => 200
            ), 200);
        } catch (Exception $e) {
            return response()->json(array('status' => false, "error" => $e->getMessage(), 'statuscode' => 400), 400);
        }
    }

public function create(Request $request)
{
    DB::beginTransaction();
        try {
            // Check if post existed OR not 
            $check = Post::where('title', $request['title'])->first();

            if ($check)
                return response()->json(array('status' => false, 'message' => "The Title  is Already Existed", 'statuscode' => 400), 400);


            $post = Post::create([
                'title' => $request['title'],
                'user_id' => $request['user_id'],
                'content' => $request['content'],

            ]);
            $post->save();

            DB::commit();
            return response()->json(array('status' => true, 'message' => "Your Post has Been Published ", 'statuscode' => 200), 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function update(Request $request){
        try {
            // Check if post existed OR not 
                $post = Post::findOrFail($request['id']);
                $post['title'] = $request['title'];
                $post['content'] = $request['content'];
                $post->update();
 
            return response()->json(array('status' => true ,'post'=> $post, 'statuscode'=> 200 ));        
        } catch (Exception) {
            
            return response()->json(array('status' => false, 'message' => "No Post Info Found for This id", 'statuscode' => 400), 400);
        }
    }
    public function delete($id){
        try {
            $post = Post::where('id',$id)->first();
            $post->delete();
            return response()->json(array('status' => true ,'message' => "Post Deleted", 'statuscode'=> 204 ));        
                
             } catch (Exception) {
                return response()->json(array('status' => false, 'message' => "No Post Info Found for This id", 'statuscode' => 400), 400);
    
            }
    }

    
}
