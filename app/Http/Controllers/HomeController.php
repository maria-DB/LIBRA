<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function popularbooks(Request $request)
    {
        $result = $this->bestsellerNYTBook();
        return response()->json($result);
    
    }
    public function bestsellerNYTBook()
    {
        $result = Http::get('https://api.nytimes.com/svc/books/v3/lists/current/hardcover-fiction.json?api-key=xRFoYoPfFfSOd1hx2a1UuRClfW5aeUAH');

        return $result->json();
    }
}
