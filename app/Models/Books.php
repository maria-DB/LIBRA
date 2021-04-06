<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

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

    // ALL DATABASE RELATED FUNCTIONS ARE HERE

    public static function searchGoogleBook($keyword, $startIndex)
    {
        $result = Http::get('https://www.googleapis.com/books/v1/volumes?q='.$keyword.'&maxResults=30&startIndex='.$startIndex.'');

        return $result->json();
    }

    public static function searchOpenLibrary($isbn)
    {
        $result = Http::get('https://openlibrary.org/api/books?bibkeys=ISBN:'.$isbn.'&jscmd=data&format=json');

        if(!$result->json()){
            return ["ISBN:".$isbn =>[
                        'publishers'=>
                            [0 => ["name"=>"not available"]], 
                        "publish_date"=> "n/a", 
                        "cover"=> ["large"=>"no cover"], 
                        'ebooks'=>
                            [0 => ["preview_url"=>"no ebook"]],
                        ]];
        }else{
            return $result->json();
        }

    }

    public static function addToBook($title, $desc, $isbn, $author, $genre, $publisher, $publish_date, $cover, $ebook)
    {
        $result = Books::where('isbn', $isbn)->first();
        // dd($result);
        if ($result) {
            return $result->bookId;
        } else {
            $newbook = Books::Create([
                'title' => $title,
                'desc' => $desc,
                'isbn' => $isbn ,
                'author' => $author,
                'genre' => $genre,
                'publisher' => $publisher,
                'publish_date'=> $publish_date,
                'cover'=> $cover,
                'ebook'=> $ebook,
            ]);
            // dd($newbook->id, $newbook);
            return $newbook->id;
        }

    }
}