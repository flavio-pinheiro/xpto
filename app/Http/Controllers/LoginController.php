<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Aluno;

class LoginController extends Controller
{
    public function index(){
    	if(auth()->user()->isSuperAdm){
	    	return redirect ('/admin/register2');
	    }

    	if(auth()->user()->isAdmin){
	    	return redirect ('/admin/home');
	    }
	    
	    return redirect ('/aluno/home'); 
    }
	    
}

