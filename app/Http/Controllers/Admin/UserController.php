<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        // $this->middleware('role:admin|email:trung@gmail.com');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();        

        return view('admin.user.home',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Create User';
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
        $user = User::findOrFail($id);
         
        $roles = Role::all();
        return view('admin.user.edit',['user' => $user, 'roles' => $roles]);
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
        
    }
    public function save(Request $request)
    {
        $id = $request->get('id');
        $user = User::findOrFail($id); 
        if(!$user) return redirect('admin/users');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        if($request->new_password){
            $user->password = bcrypt($request->new_password);
        }
        $user->save();
        //save roles
        $roles = $request->get('roles');
        if($roles){
            $user->roles()->sync($roles);
        }else{
            $user->roles()->sync([]);
        }
         
        Session::flash('success', 'User saved successfully!');
        
        return redirect('admin/user/edit/'.$id);
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
        $user = User::find($id);
        $user->delete();
        return redirect('admin/users');
    }

    public function getProfile() {
        $user = Auth::user();
        return view('admin/user/profile', ['user' => $user]);
    }

    public function postProfile(Request $req) {
        $cuser = Auth::user();
        $user = User::find($cuser->id);
        $count = 0;
        if($req->email == '') {
            Session::flash('error', 'Incorrect email!');
            return redirect('/admin/user/profile');
        }
        elseif($user->email != $req->email) {
            $user->email = $req->email;
            $count++;
        }
        if (\Illuminate\Support\Facades\Hash::check($req->password, $user->password)) {
            Session::flash('error', 'Incorrect password!');
            $user->password = bcrypt($req->new_password);
            $count++;
        }
        if($count > 0) {
            $user->save();
            Session::flash('success', 'Profile saved successfully!');            
        }
        else {
            Session::flash('error', 'Incorrect password! Error.');
        }
        return redirect('/admin/user/profile');
    }
}
