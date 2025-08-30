<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Follow;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ユーザ名・ユーザアイコン・フォロー数・フォロワー数
        view::composer('layouts.login', function($view){
            $user = Auth::user();
            $userId = Auth::id();   //ログイン中ユーザのID取得

            $followCount = 0;
            $followerCount = 0;

            if($userId){    //ログインチェック
                $followCount = follow::where('following_id', $userId)->count();
                $followerCount = follow::where('followed_id', $userId)->count();
            }

            $view->with([
                'user' => $user,
                'followCount' => $followCount,
                'followerCount' => $followerCount,
            ]);
        });
    }
}
