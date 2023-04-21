<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function createPost(Request $request){
        $user = User::all()->find(1);
        // $user = User::first();


        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string',
            'slug' => 'required|string',
            'resume'=> 'required|string',
            'resume'=> 'required|string',
           
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

                $post = Post::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $request->image,
                    'slug' => $request->slug,
                    'resume' => $request->resume,
                    'user_id' => $user->id,
                ]);

                if($post->save()){

                return response()->json([
                    "status" => true,
                    "message" => "User has been posted successfully.",
                    "data" => $post
                ]);
            } 
            else{
                return response()->json([
                    "message" => "error"
                ]);
            }

 
            }
        }
    }



    public function showPostDetail(Request $request){
        
        // user_id, post_id , last_comment_id(for parent_id), 

        $post = Post::with(['user',   //user ki details
        'comment.user',    //knse user ne comment kia h user ki detail k sath
        'comment.replies',     // knse comment pr kya reply aaya hai
        'comment.replies.user',   // knse comment pr knse user ne reply kia h with user details
        'likes',                //knse post pr like hua h
        'likes.user',             //knse post pr knse user ne like kia h with user details 
        'comment.likes',             // knse comment pr like hua h
        'comment.likes.user'            //knse comment pr knse user like kia h
        ])
        ->withCount('likes')
        ->first();

        
        return response()->json([
            'data' => $post
        ]);
        
    }


}

