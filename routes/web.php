<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

// Route::get('/', function(){
//   return view('welcome');
// });

// ログイン後にのみ表示可能なアクセス制限ページのグループ
Route::group(['middleware' => 'auth'], function(){

  Route::get('top', [PostsController::class, 'index'])->name('top');

  Route::get('profile/{id}', [ProfileController::class, 'profile'])->name('profile');

  Route::get('search', [UsersController::class, 'index'])->name('search');
  Route::post('search', [UsersController::class, 'search']);

  Route::get('followlist', [FollowsController::class, 'followlist'])->name('followlist');
  Route::get('followerlist', [FollowsController::class, 'followerlist'])->name('followerlist');

  // 新規投稿
  Route::post('post', [PostsController::class, 'store'])->name('posts.store');
  // 投稿編集
  Route::post('edit', [PostsController::class, 'edit'])->name('posts.edit');
  Route::post('delete', [PostsController::class, 'delete'])->name('posts.delete');

  // フォロー・フォロー解除
  Route::post('follow', [UsersController::class, 'follow'])->name('users.follow');
  Route::post('unfollow', [UsersController::class, 'unfollow'])->name('users.unfollow');

});
