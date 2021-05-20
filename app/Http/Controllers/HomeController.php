<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        return view('home/index');
    }
    public function admin()
    {
        return view('home/admin');
    }
}
