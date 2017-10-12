<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiPostsController extends Controller
{
	public function index()
    {
    	return Post::with('user')->get();
    }

    public function mypost()
    {
    	return Post::where('user_id', \Auth::guard('api')->user()->id)->get();
    }

        public function store(Request $request)
    {
        $rules = [
            'post_content'     => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // fails, then return false
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->all(),
            ], 400);
        }

        $post = new Post;
        $post->post_content = $request->post_content;
        $post->user_id = \Auth::guard('api')->user()->id;
        $post->save();

        return response()->json([
            'error' => false,
            'post_content' => $post->post_content,
            'post_creator' => $post->user_id
        ]);
    }

   public function show(Post $post)
    {
        return Post::findOrFail($post);
    }

}