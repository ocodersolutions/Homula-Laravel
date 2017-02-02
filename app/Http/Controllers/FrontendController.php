<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $menus = Menus::where(['parent_id' => 0, 'publisher' => 1])->get();
        
        // return view('layouts.frontend', ['menus'=>$menus]);
        return view('frontend.profile');
    }
}
