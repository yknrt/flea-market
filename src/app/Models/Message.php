<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function dealing()
    {
        return $this->belongsTo(Dealing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
