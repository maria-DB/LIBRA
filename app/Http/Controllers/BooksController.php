<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Bookshelf;

class BooksController extends Controller
{
    public function index()
    {
        // changed this to catalog 
        // changed because? gusto ni sir per page is yung API :vvv
    	return view('catalog');
    }

    public function searchGoogleBook(Request $request)
    {
        if($request->has('book'))
        {
            $result = Books::searchGoogleBook($request->book, $request->index);
            return response()->json($result); 
        }else {
            return response()->json(["msg" => "no book result"]);
        }
    }

    public function searchGoogleBookBack(Request $request)
    {
        if($request->has('book'))
        {
            $page = intval($request->page);
            $index = intval($request->index);
            if($page == 1){
                $index = 1;
            } else {
                // page2 30 = 2 * 30 - 30;
                // page3 60 = 3 * 30 - 30;
                // page4 90 = 4 * 30 - 30;
                $index = ($page * 30 ) - 30;
            }

            $result = Books::searchGoogleBook($request->book,$index);
            return response()->json($result); 
        }else {
            return response()->json(["msg" => "no book result"]);
        }
    }

    public function searchGoogleBookNext(Request $request)
    {
        if($request->has('book'))
        {
            $page = intval($request->page);
            $index = intval($request->index);
            if($page == 1){
                $index = 1;
            } else {
                // page2 30 = 2 * 30 - 30;
                // page3 60 = 3 * 30 - 30;
                // page4 90 = 4 * 30 - 30;
                $index = ($page * 30 ) - 30;
            }

            $result = Books::searchGoogleBook($request->book,$index);
            return response()->json($result); 
        }else {
            return response()->json(["msg" => "no book result"]);
        }
    }

    public function addToBook(Request $request)
    {
        if($request->has('isbn'))
        {
            $isbn = $request->get('isbn');
            $openlib = Books::searchOpenLibrary($isbn);
            
            //do it like this if there are undefined keys in the response from the api
            if(array_key_exists('ebooks', $openlib)){
                $ebook = $openlib['ISBN:'.$isbn]['ebooks'][0]['preview_url'];
            } else {
                if(array_key_exists('url', $openlib)){
                    $ebook = $openlib['ISBN:'.$isbn]['url'];
                } else {
                    $ebook = "no url found";
                }
            }

            if(array_key_exists('cover',$openlib)){
                $cover = $openlib['ISBN:'.$isbn]['cover']['large'];
            } else { $cover = $request->get('cover')."&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api";}

            $bookId = Books::addToBook($request->title, $request->desc, $isbn, $request->get('author'), $request->get('genre'),
                                    $openlib['ISBN:'.$isbn]['publishers'][0]['name'],
                                    $openlib['ISBN:'.$isbn]['publish_date'], $cover, $ebook);

            $shelf = Bookshelf::addToShelf($bookId);

            if($shelf) {
                echo "<script>window.setTimeout(window.close(), 8000);</script>";
                return true;
            } else {
                return false;
            }
        } else {

            return abort(404);
        }

    }

    public function getPopular()
    {
        $result = Books::getPopularBooks();

        return response()->json($result);
    }
}
