<?php

namespace App\Http\Controllers;

use Auth; 
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function user() 
    {
        return view('home'); 
    }

    public function dashboard() 
    {
        $userRoles = Auth::user()->roles->pluck('name'); 

        if(!$userRoles->contains('admin')) {
            return redirect('/nopermission');     
        }

        return view('admin.dashboard');    
    }

    public function nopermission()
    {
        return view('nopermission');   
    }
}
