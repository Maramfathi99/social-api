<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
         'text', 'user_id',
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


}
