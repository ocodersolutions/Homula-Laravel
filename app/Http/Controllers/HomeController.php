<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Articles;

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
        $articles = Articles::where('id','>=', 8)->take(10)->get();
        $articles_agent = Articles::where('id','>=', 18)->take(36)->get();
        $articles_news = Articles::where('id','>=', 54)->take(18)->get();
        return view('home', compact('menus', 'articles', 'articles_agent', 'articles_news'));
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

    public function article_detail() {
        $menus = Menus::where(['parent_id' => 0, 'published' => 1])->get();
        return view('frontend.article-detail', compact('menus'));
    }
}
