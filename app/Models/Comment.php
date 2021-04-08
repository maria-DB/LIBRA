<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'userId', 'bookId'];

    public function books()
    {
        return $this->belongsTo(Books::class, 'bookId', 'bookId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id' , 'userId');
    }
}
