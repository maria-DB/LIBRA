<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'userId', 'bookId'];

    public function books()
    {
        return $this->belongsTo(Books::class, 'bookId', 'bookId');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
