<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function createLike(Request $request){
        $user = User::all()->find(2);
        $post = Post::all()->find(2);
        // $comment=Comment::all();
        // $user = User::first();


        $validator = Validator::make($request->all(), [
            'likeable_type' => 'required|string',
            'likeable_id' => 'required',
            // 'post_id' => 'required',
            // 'user_id' => 'required',
            // 'parent_id' => 'nullable'
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
            $like = Like::create([
                'user_id' => $user->id,
                'liked' => 1,
                'likeable_id' => $request->likeable_id,
                // 'post_id' => $post->id,
                // 'comment' => $request->comment,
                'likeable_type' => $request->likeable_type
            ]);

            return response()->json([
                "status" => true,
                "message" => "User has been Comment successfully.",
                "data" =>   $like
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





