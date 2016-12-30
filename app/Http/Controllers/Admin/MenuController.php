<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menus;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (@$_GET['sort_by']) {
            Session::put('sort_by', $_GET['sort_by']);
            $dimen = @$_GET['sort_dimen'] ? $_GET['sort_dimen'] : 'asc';
            Session::put('sort_dimen', $dimen);
        }
        $sort_by = Session::get('sort_by', 'id');
        $dimen = Session::get('sort_dimen', 'asc');

        $menu = Menus::orderBy($sort_by, $dimen)->paginate(20);
        
        return view('admin.menu.home', ['menus' => $menu, 'sort_by' => $sort_by, 'sort_dimen' => $dimen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $menus = Menus::all();
        $menus_level = Menus::where(['parent_id' => 0])->get();
        return view('admin.menu.edit', ['menus' => $menus, 'menus_level' => $menus_level]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $menus_item = Menus::findOrFail($id);
        $menus = Menus::all();
        $menus_level = Menus::where(['parent_id' => 0])->get();
        return view('admin.menu.edit', compact('menus_item', 'menus', 'menus_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) 
    {
        $id = $request->get("id");
        $result = false;

        if($id == 0) {
            $post_data = $request->all();
            $menu = new Menus();
            $menu->name = $post_data['name'];
            if (!$post_data['alias'] == '') {
                $menu->alias = $post_data['alias'];
            } else {
                $menu->alias = str_slug($post_data['name'], '-');
            }
            $menu->icon = $post_data['icon'];
            $menu->parent_id = $post_data['parent_id'];
            $menu->link = $post_data['link'];
            $menu->target = $post_data['target'];
            $menu->published = $request->published ? $request->published : 0;
            $result = $menu->save();
        }
        else {
            $menu = Menus::findOrFail($id);
            if ($menu) {
                $menu->published = $request->published ? $request->published : 0;
                $result = $menu->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Menu saved successfully!');
        } else {
            Session::flash('error', 'Menu failed to save successfully!');
        }
        if ($menu && $menu->id) {
            return redirect('admin/menu/edit/' . $menu->id);
        }
        return redirect('admin/menu/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function delete($id) {
        $menu = Menus::find($id);
        $menu->delete();
        return redirect('admin/menu');
    }

}
