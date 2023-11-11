<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $casts = [
        "user_id" => "integer",
        "query" =>  "string",
        "reply" =>  "string",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
