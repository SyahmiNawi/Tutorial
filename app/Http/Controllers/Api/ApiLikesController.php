<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiLikesController extends Controller
{
   public function likesAction(Post $post)
   {
   		$user = \Auth::guard('api')->user();

   		$stats = $user->likes()->toggle($post);

   		$likesStatus = !count($stats['detached']);

   		return response()->json([
            'status' => 'ok',
            'like' => $likesStatus
        ]);
   }
}
