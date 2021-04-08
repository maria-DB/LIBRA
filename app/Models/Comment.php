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
        return $this->hasOne(User::class, 'id' , 'userId');
    }

    public static function getComments($bookId)
    {
        $result = Comment::with(['user' => function($query) { 
                                $query->select('id', 'username');
                            }])->where('bookId', $bookId)->get();
        
        // $result = Books::with(['reviews','comments.user' => function ($query) {
        //                     $query->select('id','username');
        //                 }])->where('bookId', $bookId)->get();

        return $result;
    }
}
