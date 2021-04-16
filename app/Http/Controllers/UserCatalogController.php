<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Bookshelf;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class UserCatalogController extends Controller
{
     public function index()
    {
        return view('usercatalog');
    }

    public function getUserBooks(Request $request)
    {
    	$result=User::with(['bookshelf.books'])->where('id', Auth::id())->get();
    	// dd($result);
    	return response()->json($result);

    }

    public function AddtoFavorites(Request $request)
    {
        $result=Bookshelf::where('bookshelfId', $request->id)->update(['favorite'=>'true']);
        // dd($result);
        return response()->json($result);

    }
    
    public function FavoritesTrue(Request $request)
    {
        $result=User::with(['bookshelf.books', 'bookshelf'=> function($query) { 
            $query->select('*')->where('favorite', 'true');
        }])->where('id', Auth::id())->get();
        
        return response()->json($result);

    }

    public function ActLog(Request $request)
    {
        $result=User::with(['comment'=> function($query) {
            $query->select('*')->where('created_at', '>=', Carbon::today()->toDateString());
        }])->where('id', Auth::id())->get();

        return response()->json($result);
    }

}
