<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['author', 'publish_date', 'summary', 'bookId'];

    public function books()
    {
        return $this->belongsTo(Books::class,'bookId', 'bookId');
    }

    public static function getBookReview($isbn)
    {   
        $reviews = Http::get('https://api.nytimes.com/svc/books/v3/reviews.json', [
            'isbn' => $isbn,
            'api-key' => config('services.secrets.nyc'),
        ]);
        // dd($reviews->json());
        return $reviews->json();
    }
}
