<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agents;
use Illuminate\Support\Facades\Session;

class AgentsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	$agents = Agents::paginate(10);
    	return view('admin.agents.home', compact('agents'));
    }

    public function create() {
    	return view('admin.agents.edit');
    }

    public function edit($id) {
    	$agents = Agents::findOrFail($id);
    	return view('admin.agents.edit', compact('agents'));
    }

    public function update(Request $request) {
    	$id = $request->get("id");
        $result = false;
        if ($id == 0) {
            $post_data = $request->all();
            $agents = new Agents();
            $agents->name = $post_data['name'];
            $agents->email = $post_data['email'];
            if (!$post_data['alias'] == '') {
                $agents->alias = $post_data['alias'];
            } else {
                $agents->alias = str_slug($post_data['name'], '-');
            }
            $agents->thumbnail = $post_data['thumbnail'];
            $agents->area_work = $post_data['area_work'];
            $agents->spoken_language = $post_data['spoken_language'];
            $agents->experience = $post_data['experience'];
            $result = $agents->save();
        } else {
            $agents = Agents::findOrFail($id);
            if ($agents) {
                $result = $agents->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Agents saved successfully!');
        } else {
            Session::flash('error', 'Agents failed to save successfully!');
        }
        if ($agents && $agents->id) {
            return redirect('admin/agents/edit/' . $agents->id);
        }
        return redirect('admin/agents/create');
    }

    public function delete($id) {
    	$agents = Agents::find($id);
        $agents->delete();
        return redirect('admin/agents');
    }
}
