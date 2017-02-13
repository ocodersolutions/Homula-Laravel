<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads;

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
        $ads = Ads::All();
        return view('admin.advertisement.home', compact('ads'));
    }
    public function ads_save($id){
        $ads = Ads::findOrFail($id);
        return view('admin.advertisement.create', compact('ads'));
    }
}
