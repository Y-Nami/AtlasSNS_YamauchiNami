<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 登録許可
    protected $fillable = [
        'user_id',
        'post',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
