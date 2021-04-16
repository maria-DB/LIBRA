<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class AboutController extends Controller
{
    public function index()
    {
    	$genre=Books::pluck('genre')->unique()->toArray();
    	// dd($genre);
    	return view('recommendation')->with('genre',$genre);
    }

    public function searchRecommend(Request $request)
    {
    	$result=Books::where('genre', $request->genre)->get();
    	dd($result);

    }
}
