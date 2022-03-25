<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ControlHome extends Controller
{
    public function index(){ 

		return view('/home');
    	
	}
}
