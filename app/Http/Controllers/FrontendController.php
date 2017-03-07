<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Categories;
use App\Models\Articles;
use App\Models\Agents;
use App\Models\Properties;
use App\Models\Meta;
use App\Models\Page;
use App\Models\Faq;
use App\Models\HelpCentre;
use App\Models\Photographers;

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
        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        $news_detail = Articles::where('alias','=',$alias)->get()->first();
        $art_sidebar = Articles::inRandomOrder()->take(8)->get();
        // echo "<pre>";    var_dump($art_sidebar);   echo "</pre>"; die;
        return view('frontend.news-detail', compact('menus', 'news_detail', 'art_sidebar','menus_bot'));
    }

    public function news_cat($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        $categories = Categories::where('alias','=', $alias)->get()->first();
        $group_cat = Categories::where('parent_id', '=', $categories->parent_id)->get();
        $news_detail = Articles::where('categories_id', '=', $categories->id)->get();
        $agents = Agents::all();
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        // echo '<pre>'; var_dump($group_cat); echo '<pre>';
        return view('frontend.news-cat', compact('menus', 'categories', 'news_detail', 'group_cat','agents','properties','menus_bot'));
    }

    public function agents() {
        $agents = Agents::all();
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        $meta = Meta::where("alias","=","agents")->get()->first();

        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        return view('frontend.agents', compact('agents', 'properties','meta','menus','menus_bot'));
    }

    public function agents_detail($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        $agents_detail = Agents::where('alias','=',$alias)->get()->first();
        if(!$agents_detail) {
            return redirect('agents');
        }

        $agents = Agents::all();
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        return view('frontend.agents-detail', compact('agents_detail', 'agents', 'properties', 'meta','menus','menus_bot'));
    }

    public function properties($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        $properties = Properties::where('alias','=',$alias)->get()->first();
        return view('frontend.properties', compact('properties','menus','menus_bot'));
    }

    public function page($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        if($alias == "faq") {
            $faq = Faq::paginate(10);
            return view('frontend.specials.faq', compact('faq'));
        }
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        if($alias == "photographers-properties") {
            $photographers = Photographers::All();
            return view("frontend.specials.".$alias, compact("photographers","properties",'menus','menus_bot'));
        }
        $agents = Agents::all();
        $page = Page::where("alias","=",$alias)->get()->first();
        $help_centre = HelpCentre::where("alias","=",$alias)->get()->first();
        if($page) {
            return view("frontend.page.page", compact('properties', 'agents', 'page','menus','menus_bot'));
        }
        elseif($help_centre) {
            return view('frontend.specials.help-centre-detail', compact('help_centre','menus','menus_bot'));
        }
        else {            
            return view('frontend.specials.'.$alias, compact('properties','agents','menus','menus_bot'));
        }
    }

    public function help_centre() {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        $help_centre = Categories::where("alias","=","help-centre")->get()->first();
        $categories = Categories::where("parent_id","=",$help_centre->id)->get(); 
        // echo "<pre>"; var_dump($categories); echo "</pre>";
        return view('frontend.specials.help-centre', compact('categories','menus','menus_bot'));
    }

    public function help_centre_cat($alias) {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1, 'type' =>'top'])->get();
        $menus_bot = Menus::where(['published' => 1, 'type' =>'bottom'])->get();

        $cat_hc = Categories::where("alias","=",$alias)->get()->first();
        return view('frontend.specials.help-centre-cat',compact('cat_hc','menus','menus_bot'));
    }

    public static function get_art_help_centre($id) {        
        $articles = HelpCentre::where("categories_id","=",$id)->orderBy("id","asc")->take(5)->get();
        return $articles;
    }

    public static function full_art_help_centre($id) {
        $articles = HelpCentre::where("categories_id","=",$id)->orderBy("id","asc")->get();
        return $articles;
    }

    public static function count_art($id) {
        $count = HelpCentre::where("categories_id","=",$id)->count();
        return $count;
    }

    public static function get_cat($id) {
        $categories = Categories::findOrfail($id);
        return $categories;
    }
}
