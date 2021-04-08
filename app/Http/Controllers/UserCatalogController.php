<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCatalogController extends Controller
{
     public function index()
    {
        return view('usercatalog');
    }
}
