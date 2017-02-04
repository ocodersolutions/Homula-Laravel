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
        return view('admin.user.create');
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
    public function update(Request $request)
    {
        $id = $request->get('id');
        $user = User::findOrFail($id); 
        if(!$user) return redirect('admin/users');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->phone_number = $request->get('phone_number');
        $user->address = $request->get('address');
        $user->city = $request->get('city');
        $user->province = $request->get('province');
        $user->postal = $request->get('postal');
        $user->image = $request->get('image');
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

    public function save(Request $request)
    {
        $post_data = $request->all();
        $path = "";
        $name = "";
        if ($_FILES['image']['name'] != NULL) {
            $path = "uploads-user/";
            if (!is_dir($path)) {
                mkdir($path);
            }
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = time() . $_FILES['image']['name'];
            // Upload file
            move_uploaded_file($tmp_name, $path . $name);
        }
        $suser = User::where('username','=',$post_data['username'])->orWhere('email','=',$post_data['email'])->first();
        if(empty($suser)) {
            $user = new User;
            $user->username = $post_data['username'];
            $user->email = $post_data['email'];
            $user->password = bcrypt($post_data['password']);
            $user->phone_number = $post_data['phone_number'];
            $user->address = $post_data['address'];
            $user->city = $post_data['city'];
            $user->province = $post_data['province'];
            $user->postal = $post_data['postal'];
            if($post_data['image'] == '') {
                $user->image = '/assets/images/profile_small.jpg';
            }
            else {
                $user->image = '/' . $path . $name;
            }
            $user->save();
            return redirect('admin/user/edit/'.$user->id);
        }
        else {
            Session::flash('error', 'Username or Email is exist!');
            return redirect('admin/user/create');
        }
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
