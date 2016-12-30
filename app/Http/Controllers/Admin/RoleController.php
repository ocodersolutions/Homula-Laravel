<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('admin.role.home',['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $roles = Role::findOrFail($id);
        return view('admin.role.edit',compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = 0)
    {
        $id = $request->get("id");
        $result = false;

        if ($id == 0) {
            $post_data = $request->all();
            $roles = new Role();
            $roles->name = $post_data['name'];
            $roles->display_name = $post_data['display_name'];
            $roles->description = $post_data['description'];
            $result = $roles->save();            
        }
        else {
            $roles = Role::findOrFail($id); 
            if($roles) {
                $result = $roles->update($request->all());
            } 
        }        
        if ($result) {
            Session::flash('success', 'Role saved successfully!');
        } else {
            Session::flash('error', 'Role failed to save successfully!');
        }
        if ($roles && $roles->id) {
            return redirect('admin/user/role/edit/' . $roles->id);
        }
        return redirect('admin/user/role/create');
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
        $role = Role::find($id);
        $role->delete();
        return redirect('admin/user/roles');
    }
}
