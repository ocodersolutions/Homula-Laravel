<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Categories;
use App\Models\Articles;
use App\Models\Agents;
use App\Models\Properties;
use App\Models\Meta;

class FrontendController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        // $menus = Menus::where(['parent_id' => 0, 'publisher' => 1])->get();
        
        // return view('layouts.frontend', ['menus'=>$menus]);
        return view('frontend.profile');
    }

    public function news_detail($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        $news_detail = Articles::where('alias','=',$alias)->get()->first();
        return view('frontend.news-detail', compact('menus', 'news_detail'));
    }

    public function news_cat($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        $categories = Categories::where('alias','=', $alias)->get()->first();
        $group_cat = Categories::where('parent_id', '=', $categories->parent_id)->get();
        $news_detail = Articles::where('categories_id', '=', $categories->id)->get();
        $agents = Agents::all();
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        // echo '<pre>'; var_dump($group_cat); echo '<pre>';
        return view('frontend.news-cat', compact('menus', 'categories', 'news_detail', 'group_cat','agents','properties'));
    }

    public function agents() {
        $agents = Agents::all();
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        $meta = Meta::where("alias","=","homepage")->get()->first();
        return view('frontend.agents', compact('agents', 'properties','meta'));
    }

    public function agents_detail($alias) {
        $agents_detail = Agents::where('alias','=',$alias)->get()->first();
        if(!$agents_detail) {
            return redirect('agents');
        }

        $agents = Agents::all();
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        return view('frontend.agents-detail', compact('agents_detail', 'agents', 'properties', 'meta'));
    }

    public function properties($id) {
        $properties = Properties::findOrFail($id);
        return view('frontend.properties', compact('properties'));
    }
}
