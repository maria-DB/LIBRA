<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class CatalogController extends Controller
{
     public function index()
    {

        // sample Eloquent ORM query 

        // $result = Books::with(['reviews','ratings.user' => function ($query) {
        //                     $query->select('id','username');
        //                 }])->get();
        // dd($result);
    	return view('catalog');
    }
}
