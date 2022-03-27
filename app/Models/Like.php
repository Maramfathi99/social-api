<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Like extends Model
{
    use HasFactory , SoftDeletes;

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
    public function Comment()
    {
        return $this->belongsTo(Comment::class);
    }


}
