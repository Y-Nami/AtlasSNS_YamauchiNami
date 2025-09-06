<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class ProfileController extends Controller
{
    public function profile($id){
        $user = User::find($id);
        $posts = Post::where('user_id', $id)
        ->orderby('created_at', 'desc')
        ->get();

        return view('profiles.profile', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function follow(request $request){
        $id = $request->target;
        auth()->user()->followings()->attach($id);

        return redirect(route('profile', $id));
    }

    public function unfollow(request $request){
        $id = $request->target;
        auth()->user()->followings()->detach($id);

        return redirect(route('profile', $id));
    }
}
