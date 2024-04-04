<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MessageCollection extends Model
{
    protected $fillable = ['title', 'leadtext', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

