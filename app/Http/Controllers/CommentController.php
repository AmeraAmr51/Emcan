<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    // Fun to get User Comments
    public function getAllCommentByUser($id)
    {
        try {
            $comment = Comment::where('user_id', $id)->get();
            return response()->json(array(
                'status' => true,
                'data' => $comment,
                'statuscode' => 200
            ), 200);
        } catch (Exception $e) {
            return response()->json(array('status' => false, 'message' => "There is no Comment for this user", "error" => $e->getMessage(), 'statuscode' => 400), 400);
        }
    }

    // Fun to get All Comments

    public function getAllComments()
    {
        try {
            $comment = Comment::with('user:id,username')->get();
            return response()->json(array(
                'status' => true,
                'data' => $comment,
                'statuscode' => 200
            ), 200);
        } catch (Exception $e) {
            return response()->json(array('status' => false, 'message' => "There is no Comments ", "error" => $e->getMessage(), 'statuscode' => 400), 400);
        }
    }

    // Fun to Create New Comment

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {

            $comment = Comment::create([
                'comment' => $request['comment'],
                'user_id' => $request['user_id'],
                'post_id' => $request['post_id'],

            ]);
            $comment->save();

            DB::commit();
            return response()->json(array('status' => true, 'message' => "Success", 'statuscode' => 200), 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    // Fun to Update  Comment

    public function update(Request $request){
        try {
            // Check if comment existed OR not 
                $comment = Comment::findOrFail($request['id']);
                $comment['comment'] = $request['comment'];
                $comment->update();
 
            return response()->json(array('status' => true ,'comment'=> $comment, 'statuscode'=> 200 ));        
        } catch (Exception) {
            
            return response()->json(array('status' => false, 'message' => "No Comment Info Found for This id", 'statuscode' => 400), 400);
        }
    }
    // Fun to Update  Comment
    public function delete($id)
    {
        try {
            $post = Comment::where('id', $id)->first();
            $post->delete();
            return response()->json(array('status' => true, 'message' => "Comment Deleted", 'statuscode' => 204));
        } catch (Exception) {
            return response()->json(array('status' => false, 'message' => "No Comment Info Found for This id", 'statuscode' => 400), 400);
        }
    }
}
