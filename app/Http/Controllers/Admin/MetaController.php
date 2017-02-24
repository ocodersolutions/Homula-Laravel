<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Support\Facades\Session;

class MetaController extends Controller
{
    public function __construct() {
    	$this->middleware("auth");
    }

    public function index() {
    	$meta_list = Meta::paginate(10);
    	return view('admin.meta.home', compact('meta_list'));
    }

    public function create() {
    	return view('admin.meta.edit');
    }

    public function edit($id) {
    	$meta = Meta::findOrFail($id);
    	return view('admin.meta.edit', compact('meta'));
    }

    public function update(Request $request) {
    	$id = $request->get("id");
        $result = false;
        if ($id == 0) {
            $post_data = $request->all();
            $meta = new Meta();
            $meta->name = $post_data['name'];
            $meta->alias = $post_data['alias'];
            $meta->keyword = $post_data['keyword'];
            $meta->description = $post_data['description'];
            $result = $meta->save();
        } else {
            $meta = Meta::findOrFail($id);
            if ($meta) {
                $result = $meta->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Meta saved successfully!');
        } else {
            Session::flash('error', 'Meta failed to save successfully!');
        }
        if ($meta && $meta->id) {
            return redirect('admin/meta/edit/' . $meta->id);
        }
        return redirect('admin/meta/create');
    }

    public function delete($id) {
    	$meta = Meta::find($id);
        $meta->delete();
        return redirect('admin/meta');
    }
}
