<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Articles;
use App\Models\Agents;
use App\Models\Categories;
use App\Models\Properties;

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

    public function index()
    {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        $properties = Properties::orderBy('id','desc')->take(10)->get();
        $agents = Agents::all();
        $news = Categories::where('alias','=','news')->get()->first();
        $news_cat = Categories::where('parent_id','=',$news->id)->get();
        $cat_arr = array();
        $leng = count($news_cat);
        foreach( $news_cat as $cat) {  
            array_push($cat_arr, $cat->id); 
        }
        $articles_news = Articles::whereIn('categories_id',$cat_arr)->orderBy('id','desc')->get();
        return view('home', compact('menus', 'properties', 'agents', 'articles_news'));
    }

    public function compare()
    {   
        $slot_1 = session()->put('slot_1', '145');
        $slot_2 = session()->put('slot_2', '436');

        $compare = session()->get('compare');
        if ($compare == null || $compare == "") {
            //redirect to select product page
            return redirect()->action('HomeController@index');
        }else{
            $slot_1 = session()->get('slot_1', $slot_1);
            $slot_2 = session()->get('slot_2', $slot_2);
        }

        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        return view('frontend.compare', ['menus'=>$menus, 'slot_1' => $slot_1, 'slot_2' => $slot_2]);
        
    }

    public function remove_all_session_compare(){
        session()->forget('compare');
        return redirect()->action('HomeController@index');
    }

    public function remove_session_compare(){

    }

    public function add_session_compare(){

    }

}
