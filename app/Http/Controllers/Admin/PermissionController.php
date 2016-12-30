<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
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
        $permissions = Permission::all();
        return view('admin.permissions.home',['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.edit');
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
        $permissions = Permission::findOrFail($id);
        return view('admin.permissions.edit',compact('permissions'));
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

        if ($id == 0) {
            $post_data = $request->all();
            $permissions = new Permission;
            $permissions->name = $post_data['name'];
            $permissions->display_name = $post_data['display_name'];
            $permissions->description = $post_data['description'];
            $result = $permissions->save();
        }
        else {
            $permissions = Permission::findOrFail($id); 
            if($permissions) {
                $result = $permissions->update($request->all());
            } 
        }        
        if ($result) {
            Session::flash('success', 'Permissions saved successfully!');
        } else {
            Session::flash('error', 'Permissions failed to save successfully!');
        }
        if ($permissions && $permissions->id) {
            return redirect('admin/user/permission/edit/' . $permissions->id);
        }
        return redirect('admin/user/permission/create');
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
        $permissions = Permission::find($id);
        $permissions->delete();
        return redirect('admin/user/permissions');
    }
}
