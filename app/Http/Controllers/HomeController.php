<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        return view('home', ['menus'=>$menus]);
    }

    public function compare()
    {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        return view('frontend.compare', ['menus'=>$menus]);
        
    }
}
