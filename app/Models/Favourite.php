<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use HasFactory , SoftDeletes;
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
    public function post()
    {
        return $this->belongsTo(user::class, 'post_id');
    }
}
