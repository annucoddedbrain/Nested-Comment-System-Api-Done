<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function createComment(Request $request){
        $user = User::all()->find(2);
        $post = Post::all()->find(2);
        // $comment=Comment::all();
        // $user = User::first();


        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
            // 'post_id' => 'required',
            // 'user_id' => 'required',
            'parent_id' => 'nullable'
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->messages()
            ]);

        }
        else
        {
            if($validator)
            {
                $comment = Comment::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'comment' => $request->comment,
                    'parent_id' => $request->parent_id
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "User has been Comment successfully.",
                    "data" =>   $comment 
                ]);
            } 
            else{
                return response()->json([
                    "message" => "error"
                ]);
            }

 
        }
    }



    public function getAllCommentByPost_id(Request $request){
        
        $comment = Comment::with([
            'user',
            'posts'
        ])->find(2);

        
        return response()->json([
            'data' => $comment
        ]);
        
    }


}