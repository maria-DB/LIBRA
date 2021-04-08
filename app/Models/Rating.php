<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public static function addRating($text,$bookId)
    {
        $result = Rating::where('userId', Auth::id())->where('bookId', $bookId)->first();

        if($result)
        {
            $rating = Rating::where('userId', Auth::id())->where('bookId', $bookId)->update(['rating'=>$text]);
            $id = $result->ratingId;
        } else {
            $rating = Rating::create([
                    'userId'=> Auth::id(),
                    'bookId'=>$bookId,
                    'rating'=>$text,
                ]);
          $id = $rating->id;
        }
        return $id;
    }

    public static function getRatings($bookId)
    {
        $result = Rating::with(['user' => function($query) { 
            $query->select('id', 'username');
        }])->where('bookId', $bookId)->get();

        return $result;
    }
}
