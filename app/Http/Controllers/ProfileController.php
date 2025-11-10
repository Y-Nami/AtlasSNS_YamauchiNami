<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class ProfileController extends Controller
{
    // 相手プロフィールの表示
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

    // フォロー・フォロー解除
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

    // プロフィール編集ページの表示
    public function edit(){
        $user = Auth::user();

        return view('profiles.profileEdit', ['user' => $user]);
    }

    // プロフィール編集ページからDB更新
    public function update(request $request){
        $validated = $request->validate([
            'username' => [
                'required',
                'min:2', 'max:12'
            ],
            'email' => [
                'required',
                'min:5', 'max:40',
                // ↓自分以外のメールアドレスとの重複
                Rule::unique('users', 'email')->ignore(auth()->id()),
                'email'
            ],
            'password' => [
                'required',
                'alpha_num',
                'min:8', 'max:20'
            ],
            'password_confirmation' => [
                'required',
                'alpha_num',
                'min:8', 'max:20',
                'same:password'
            ],
            'bio' => ['nullable', 'max:150'],
            'icon_image' => [
                'nullable',
                'image', 'mimes:jpg,png,bmp,gif,svg'
            ],
        ]);

        $id = $request->input('id');
        $username = $request->input('username');
        $email = $request->input('email');
        $bio = $request->input('bio');
        $filename = User::where('id',$id)->value('icon_image');

        if($request->hasFile('icon_image')){
            $file = $request->file('icon_image');
            $filename = $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);
        }

        User::where('id', $id)->update([
            'username' => $username,
            'email' => $email,
            'bio' => $bio,
            'icon_image' => $filename
        ]);

        return redirect(route('top'));
    }
}
