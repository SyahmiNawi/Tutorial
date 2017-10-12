<?php

namespace App\Http\Controllers\Api;

use Validator;
use \App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class APIAuthController extends Controller
{
	    public function authenticate(Request $request) {
        
        $rules = [
            'email'     => 'required',
            'password'       => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {     
                // fails, then return false
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()->all(),
                    'token' => '',
                ], 400);
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
           $user = Auth::user();
           $user->api_token = str_random(60);
           $user->save();
        }else
        {
            return response()->json([
            'error' => true,
            'message' => 'Login failed wrong user credentials',
        ]);
        }
        
        return response()->json([
            'error' => false,
            'message' => 'login successful',
            'token' => $user->api_token,
        ]);
    }

    public function register(Request $request)
    {
    	$rules = [
    	    'name'     => 'required',
            'email'     => 'required',
            'password'       => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
                // fails, then return false
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()->all(),
                    'token' => '',
                ], 400);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'error' => false,
            'message' => 'register successful',
        ]);
    }
}