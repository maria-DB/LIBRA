<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['title'
                        ,'desc'
                        ,'isbn'
                        ,'author'
                        ,'genre'
                        // ,'review'
                        // ,'rating'
                        ,'publisher'
                        ,'publish_date'
                        ,'cover'
                        ,'ebook'];
    
    public function reviews()
    {
        //                     Model      Foreign key , Local Key
        return $this->hasMany(Review::class, 'bookId', 'bookId');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'bookId', 'bookId');
    }

    public function bookshelf()
    {
        return $this->hasOne(Bookshelf::class, 'bookId', 'bookId');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'bookId', 'bookId');
    }
}