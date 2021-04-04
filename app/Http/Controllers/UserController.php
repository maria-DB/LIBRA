<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class UserController extends Controller
{
	protected $redirectTo = '/movies';

	public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
    	$user = new User;
    	$user->name = $request->name;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);

    	$user->save();

    	Auth::login($user);
    	if(Auth::user()) {
    		return json_encode(array("msg"=>"OK"));
    	}
    }
}
