<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //トップページ
    public function index(){
        $currentUser = Auth::id();
        $users = User::where('id', '!=', $currentUser)->get();

        return view('users.search', ['users' => $users]);
    }

    // 検索ページ
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $currentUser = Auth::id();

        $users = [];

        if(!empty($keyword)){
            $users = User::where('id', '!=', $currentUser)
            ->where('username', 'like', '%'.$keyword.'%')
            ->get();
        } else {
            $users = User::where('id', '!=', $currentUser)
            ->get();
        }

        return view('users.search', [
            'users' => $users,
            'keyword' => $keyword,
        ]);
    }

    // フォローする
    public function follow(Request $request){
        // attach：中間テーブルにレコードを追加
        auth()->user()->followings()->attach($request->target);

        return redirect(route('search'));
    }

    // フォロー解除
    public function unfollow(Request $request){
        // detach：中間テーブルからレコードを削除
        auth()->user()->followings()->detach($request->target);

        return redirect(route('search'));
    }
}
