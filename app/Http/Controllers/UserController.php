<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rules = [     
        'name' => 'required|string',
        'email' => 'required|string|email',
        'password'=> 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return response()->json([
                "status" => false,
                "message" => "There is something error while registering.",
                "errors" => $validator->errors()
            ]);

        }else
        {
            if($validator)
            {
                $user = new User;
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password=$request->password;
                $user->save();



                $user->remember_token = $user->createToken(env("APP_TOKEN", ''))->plainTextToken;

                if($user->save())
                {
                    return response()->json([
                    "status" => true,
                    "message" => "User has been registered successfully.",
                    "data" => $user
                    ]);
                } 
                else
                {
                    return response()->json([
                    "message" => "error"
                    ]);
                 } 
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

