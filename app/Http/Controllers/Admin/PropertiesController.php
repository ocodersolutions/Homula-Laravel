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
        $ex_alias = 0;
        if ($id == 0) {
            $post_data = $request->all();
            $properties = new Properties();
            $properties->address = $post_data['address'];
            if ($post_data['alias'] != '') {
                $properties->alias = $post_data['alias'];
            }
            else {
                $str = str_replace(' ', '-', $post_data['address']);
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
                $str = strtolower(preg_replace('/-+/', '-', $str));
                $ex_alias = Properties::where("alias",'=',$str)->get()->first() ? "1" : "0";
                $properties->alias = $str;
            }
            $properties->location = $post_data['location'];
            $properties->bedrooms = $post_data['bedrooms'];
            $properties->bathrooms = $post_data['bathrooms'];
            $properties->thumbnail = $post_data['thumbnail'];
            $properties->price = $post_data['price'];
            $properties->features = $post_data['features'];
            $properties->advanced = $post_data['advanced'];
            $properties->amenities = $post_data['amenities'];
            $properties->walkscore = $post_data['walkscore'];
            $properties->map = $post_data['map'];
            $properties->slideshow = $post_data['slideshow'];
            $properties->keyword = $post_data['keyword'];
            $properties->description = $post_data['description'];
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
            if($ex_alias == 1) {
                $properties->alias .= "-" . $properties->id;
                $properties->save();
            }            
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
