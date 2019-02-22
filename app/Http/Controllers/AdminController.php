<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
	public function __construct(){

	}

	public function dashboard(){
		return view(Auth::user()->role->name.'.dashboard');
	}
}
