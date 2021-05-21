<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Textbook;
class HomeController extends Controller
{
    public function index()
    {
        //$user = \Auth::user();
        return view('home/index');
    }
    public function admin()
    {
        return view('home/admin');
    }
    public function register_history()
    {
      
        $textbooks = Textbook::where('seller_id', \Auth::id())
                ->orderBy('created_at', 'desc')->paginate(20);
        return view('textbooks/register_history', ['textbooks' => $textbooks]);
    }
}
