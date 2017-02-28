<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HelpCentre;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;

class HelpCentreController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$help_centre = HelpCentre::paginate(10);
    	return view('admin.help_centre.home', compact('help_centre'));
    }

    public function create() {
    	$cat_help_centre = Categories::where("alias","=","help-centre")->get()->first();
    	$categories = Categories::where("parent_id","=",$cat_help_centre->id)->get();
     	return view('admin.help_centre.edit', compact('categories'));
    }

    public function edit($id) {
    	$cat_help_centre = Categories::where("alias","=","help-centre")->get()->first();
    	$categories = Categories::where("parent_id","=",$cat_help_centre->id)->get();
    	$help_centre = HelpCentre::findOrFail($id);
    	return view('admin.help_centre.edit', compact('help_centre','categories'));
    }

    public function update(Request $request) {
    	$id = $request->get("id");
        $result = false;
        if ($id == 0) {
            $post_data = $request->all();
            $help_centre = new HelpCentre();
            $help_centre->question = $post_data['question'];
            if ($post_data['alias'] != '') {
                $help_centre->alias = $post_data['alias'];
            }
            else {
                $str = str_replace(' ', '-', $post_data['question']);
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
                $str = strtolower(preg_replace('/-+/', '-', $str));
                $help_centre->alias = $str;
            }
            $help_centre->answer = $post_data['answer'];
            $help_centre->categories_id = $post_data['categories_id'];
            $result = $help_centre->save();
        } else {
            $help_centre = HelpCentre::findOrFail($id);
            if ($help_centre) {
                $result = $help_centre->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Help centre saved successfully!');
        } else {
            Session::flash('error', 'Help centre failed to save successfully!');
        }
        if ($help_centre && $help_centre->id) {
            return redirect('admin/helpcentre/edit/' . $help_centre->id);
        }
        return redirect('admin/helpcentre/create');
    }

    public function delete($id) {
    	$help_centre = HelpCentre::find($id);
    	$help_centre->delete();
    	return redirect('admin/helpcentre');
    }

    public static function getCat($id) {
        $categories_item = Categories::findOrFail($id);
        return $categories_item;
    }
}
