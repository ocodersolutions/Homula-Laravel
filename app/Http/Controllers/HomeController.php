<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Articles;
use App\Models\Agents;
use App\Models\Categories;

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
        $articles = Articles::where([['id','>=', 8],['id', '<', 18]])->orderBy('id','desc')->get();
        $agents = Agents::all();
        $news = Categories::where('alias','=','news')->get();
        // $news_cat = Categories::where('parent_id','=',$news->id)->get();
        // $news_string = "[['categories_id','=',";
        // $i = 1;
        // $leng = count($news_cat);
        // foreach( $news_cat as $cat) {            
        //     if($i == $leng) {
        //         $news_string .= $cat->id . "]]";
        //     }
        //     else {
        //         $news_string .= $cat->id . "],['categories_id','=',";
        //     }
        //     $i++;
        // }
        // $articles_news = Articles::where($news_string)->orderBy('id','desc')->get();
        // die($news);
        $articles_news = Articles::where([['id','>=',54],['id','<',72]]);
        return view('home', compact('menus', 'articles', 'agents', 'articles_news'));//->orderBy('id','desc')
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
