<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Photographers;
use Illuminate\Support\Facades\Session;

class PhotographersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $photographers = Photographers::paginate(10);
        return view("admin.photographers.home", compact("photographers"));
    }

    public function create() {
        return view('admin.photographers.edit');
    }

    public function edit($id) {
        $photographers = Photographers::findOrFail($id);
        return view('admin.photographers.edit', compact('photographers'));
    }

    public function update(Request $request) {
        $id = $request->get("id");
        $result = false;
        $ex_alias = 0;
        if ($id == 0) {
            $post_data = $request->all();
            $photographers = new Photographers();
            $photographers->name = $post_data['name'];
            if ($post_data['alias'] != '') {
                $photographers->alias = $post_data['alias'];
            }
            else {
                $str = str_replace(' ', '-', $post_data['name']);
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
                $str = strtolower(preg_replace('/-+/', '-', $str));
                $ex_alias = Photographers::where("alias",'=',$str)->get()->first() ? "1" : "0";
                $photographers->alias = $str;
            }
            $photographers->company = $post_data['company'];
            $photographers->phone = $post_data['phone'];
            $photographers->email = $post_data['email'];
            $photographers->web = $post_data['web'];
            $photographers->city = $post_data['city'];
            $result = $photographers->save();
        } else {
            $photographers = Photographers::findOrFail($id);
            if ($photographers) {
                $result = $photographers->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Photographers saved successfully!');
        } else {
            Session::flash('error', 'Photographers failed to save successfully!');
        }
        if ($photographers && $photographers->id) {
            if($ex_alias == 1) {
                $photographers->alias .= "-" . $photographers->id;
                $photographers->save();
            }  
            return redirect('admin/photographers/edit/' . $photographers->id);
        }
        return redirect('admin/photographers/create');
    }

    public function delete($id) {
        $photographers = Photographers::find($id);
        $photographers->delete();
        return redirect('admin/photographers');
    }

}
