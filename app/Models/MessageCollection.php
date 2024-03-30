<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MessageCollection extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'message', 'uploaded_files'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

