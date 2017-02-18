<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Properties;
use Illuminate\Support\Facades\Session;

class PropertiesController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	$properties = Properties::paginate(10);
    	return view('admin.properties.home', compact('properties'));
    }

    public function create() {
    	return view('admin.properties.edit');
    }

    public function edit($id) {
    	$properties = Properties::findOrFail($id);
    	return view('admin.properties.edit', compact('properties'));
    }

    public function update(Request $request) {
    	$id = $request->get("id");
        $result = false;
        if ($id == 0) {
            $post_data = $request->all();
            $properties = new Properties();
            $properties->address = $post_data['address'];
            $properties->thumbnail = $post_data['thumbnail'];
            $properties->price = $post_data['price'];
            $properties->location = $post_data['location'];
            $result = $properties->save();
        } else {
            $properties = Properties::findOrFail($id);
            if ($properties) {
                $result = $properties->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Properties saved successfully!');
        } else {
            Session::flash('error', 'Properties failed to save successfully!');
        }
        if ($properties && $properties->id) {
            return redirect('admin/properties/edit/' . $properties->id);
        }
        return redirect('admin/properties/create');
    }

    public function delete($id) {
    	$properties = Properties::find($id);
        $properties->delete();
        return redirect('admin/properties');
    }
}
