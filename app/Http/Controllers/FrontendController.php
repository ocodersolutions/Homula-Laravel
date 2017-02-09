<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Categories;
use App\Models\Articles;
use App\Models\Agents;

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
        $articles = Articles::where('alias','=',$alias)->get()->first();
        return view('frontend.news-detail', compact('menus', 'articles'));
    }

    public function news_cat($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        $categories = Categories::where('alias','=', $alias)->get()->first();
        $group_cat = Categories::where('parent_id', '=', $categories->parent_id)->get();
        $articles = Articles::where('categories_id', '=', $categories->id)->get();
        $agents = Agents::all();
        $articles_hot = Articles::where([['id','>=', 8],['id', '<', 18]])->orderBy('id','desc')->get();
        // echo '<pre>'; var_dump($group_cat); echo '<pre>';
        return view('frontend.news-cat', compact('menus', 'categories', 'articles', 'group_cat','agents','articles_hot'));
    }

    public function agents() {
        $agents = Agents::all();
        $articles_hot = Articles::where([['id','>=', 8],['id', '<', 18]])->orderBy('id','desc')->get();
        return view('frontend.agents', compact('agents', 'articles_hot'));
    }
}
