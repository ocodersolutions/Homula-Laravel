<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return redirect('/admin/users');
        // return view('admin.home');
    }

    public function ads(){
        return view('admin.advertisement.home');
    }
    public function ads_save(){
        return view('admin.advertisement.create');
    }
}
