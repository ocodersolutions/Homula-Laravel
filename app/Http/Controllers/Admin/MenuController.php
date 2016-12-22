<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menus;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menus::paginate(20);
        return view('admin.menu.home', ['menus' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menus::all();
        return view('admin.menu.create', ['menus'=>$menus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_data = $request->all();
        $menu = new Menus();
        $menu->name = $post_data['name'];
        if(!$post_data['alias'] == '') {
            $menu->alias = $post_data['alias'];
        }
        else {
            $menu->alias = str_slug($post_data['name'], '-');
        }
        $menu->icon = $post_data['icon'];
        $menu->parent_id = $post_data['parent_id'];
        $menu->link = $post_data['link'];
        $menu->target = $post_data['target'];
        $menu->publisher = $post_data['publisher'];
        $menu->save();

        return redirect('admin/menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = Menus::findOrFail($id);
        $all_menus = Menus::all();
        return view('admin.menu.edit',compact('menus','all_menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menus::findOrFail($id); 
        if(!$menu) return redirect('admin/menu');
        $menu->update($request->all()); 
        return redirect('admin/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete($id)
    {
        $menu = Menus::find($id);
        $menu->delete();
        return redirect('admin/menu');
    }
}
