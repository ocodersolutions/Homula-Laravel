<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Categories;
use App\Models\Articles;

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

    public function articles_detail($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        $articles = Articles::where('alias','=',$alias)->get()->first();
        return view('frontend.article-detail', compact('menus', 'articles'));
    }

    public function categories_news($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        $categories = Categories::where('alias','=', $alias)->get()->first();
        $group_cat = Categories::where('parent_id', '=', $categories->parent_id)->get();
        $articles = Articles::where('categories_id', '=', $categories->id)->get();
        // echo '<pre>'; var_dump($group_cat); echo '<pre>';
        return view('frontend.categories-news', compact('menus', 'categories', 'articles', 'group_cat'));
    }
}
