<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class PostsController extends Controller
{
    // トップページ
    public function index(){
        $user = Auth::user();
        $users = User::all();

        // フォローしているユーザーIDの取得
        $target = Follow::where('following_id', '=', $user->id)
        ->pluck('followed_id')  // 特定カラムの値のみを取得
        ->push($user->id);  // 自身のIDを配列に追加

        // フォローしているユーザーの投稿を取得
        $posts = Post::whereIn('user_id', $target)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('posts.index', [
            'user'=>$user,
            'users' => $users,
            'posts' => $posts,
        ]);
    }

    // 投稿内容のバリデーション、DB登録
    public function store(Request $request){
        $validated = $request->validate([
            'post' => 'required|min:1|max:150'
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'post' => $validated['post']
        ]);

        return redirect()->route('top');
    }

    // 投稿の編集、DBアップデート
    public function edit(Request $request){
        $validated = $request->validate([
            'post_edit' => 'required|min:1|max:150'
        ]);

        $id = $request->input('id_edit');
        $up_post = $request->input('post_edit');

        Post::where('id', $id)->update([
            'post' => $up_post
        ]);

        return redirect()->route('top');
    }

    // 投稿の削除
    public function delete(Request $request){
        Post::where('id', $request->id)->delete();

        return redirect()->route('top');
    }
}
