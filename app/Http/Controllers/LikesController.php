<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
   public function LikesAction(Post $post)
    {
        $user = Auth::user();
        $stats = $user->likes()->toggle($post);
        dd($post);
        return back();
    }
}
