<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['author', 'publish_date', 'summary', 'bookId'];

    public function books()
    {
        return $this->belongsTo(Books::class,'bookId', 'bookId');
    }
}
