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
    
    public function index()
    {
        $users = User::all();        

        return view('admin.user.home',['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('roles'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
         
        $roles = Role::all();
        return view('admin.user.edit',['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'min:6|confirmed',
        ]);
        $id = $request->get('id');
        $result = false;
        if ($id == 0) {
            $suser = User::where('username','=',$request->get('username'))->orWhere('email','=',$request->get('email'))->first();
            if (empty($suser)) {
                $post_data = $request->all();
                $user = new User();
                $user->username = $post_data['username'];
                $user->email = $post_data['email'];
                $user->phone_number = $post_data['phone_number'];
                $user->address = $post_data['address'];
                $user->city = $post_data['city'];
                $user->province = $post_data['province'];
                $user->postal = $post_data['postal'];
                if($post_data['image'] != null) {
                    $user->image = $post_data['image'];
                }
                else {
                    $user->image = '/assets/images/profile_small.jpg';
                }
                $user->password = bcrypt($post_data['password']);
                $result = $user->save();
                //save roles
                $roles = $request->get('roles');
                if($roles){
                    $user->roles()->sync($roles);
                }else{
                    $user->roles()->sync([]);
                }
            }
            else {
                Session::flash('error', 'Username or Email is exist!');
                return redirect('admin/users/create');
            }
        }
        else {
            $user = User::findOrFail($id);
            if ($user) {
                $cuser = User::where('username','=',$request->get('username'))->orWhere('email','=',$request->get('email'))->first();
                if (!empty($cuser) && $cuser != $user) {
                    Session::flash('error', 'Username or Email is exist!');
                    return redirect('admin/users/edit/'.$id);
                }
                else {
                    $result = $user->update($request->all());
                    //save roles
                    $roles = $request->get('roles');
                    if($roles){
                        $user->roles()->sync($roles);
                    }else{
                        $user->roles()->sync([]);
                    }
                }
            }
        }
        if ($result) {
            Session::flash('success', 'User saved successfully!');
        } else {
            Session::flash('error', 'User failed to save successfully!');
        }
        if ($user && $user->id) {
            return redirect('admin/users/edit/' . $user->id);
        }
        return redirect('admin/users/create');

    }
    
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
            return redirect('/admin/users/profile');
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
