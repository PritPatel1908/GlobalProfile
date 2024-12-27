<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect; 

class Logout extends Controller
{
    public function index()
	{
		 session()->flush(); // Remove all session variable
		return redirect('login');
	}	
}
