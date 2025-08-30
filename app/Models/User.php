<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    // 自分 が フォローしている
    public function followings(){
        return $this->belongsToMany(
            User::class,    // 関連先モデル
            'follows',  // 中間テーブル名
            'following_id',
            'followed_id'
        );
    }

    // 特定ユーザーのフォローチェック
    public function isFollowing($id): bool{ // true/falseで返す
        return $this->followings()->where('followed_id', $id)->exists();
    }

    // 自分 を フォローしている
    public function followers(){
        return $this->belongsToMany(
            User::class,
            'follows',
            'followed_id',
            'following_id'
        );
    }
}
