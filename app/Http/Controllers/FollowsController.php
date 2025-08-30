<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class FollowsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function followList(){
        $user = Auth()->user();
        $target = Follow::where('following_id', $user->id)
        ->pluck('followed_id');

        $users = User::whereIn('id', $target)->get();
        $posts = Post::whereIn('user_id', $target)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('follows.followList', [
            'users' => $users,
            'posts' => $posts
        ]);
    }

    public function followerList(){
        $user = Auth()->user();
        $target = Follow::where('followed_id', $user->id)
        ->pluck('following_id');

        $users = User::whereIn('id', $target)->get();
        $posts = Post::whereIn('user_id', $target)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('follows.followerList', [
            'users' => $users,
            'posts' => $posts
        ]);
    }
}
