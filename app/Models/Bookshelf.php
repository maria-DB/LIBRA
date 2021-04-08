<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Bookshelf extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'bookId', 'userId', 'favorite'];

    public function books()
    {
        return $this->belongsTo(Books::class, 'bookId', 'bookId');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public static function addToShelf($bookId)
    {
        $result = Bookshelf::where('userId', Auth::id())->where('bookId', $bookId)->first();

        if($result) {
            $newbook = Bookshelf::where('userId', $result->userId)->where('bookId', $result->bookId)
                                ->update(['favorite' => $result->favorite, 'type' => $result->type ]); 
        } 
        else {
            $newbook = Bookshelf::Create([
                'type' => 'to be read',
                'userId' => Auth::id(),
                'bookId' => $bookId,
                'favorite' => "false",
                ]);
        }

        return $newbook;
    }
}
