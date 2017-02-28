<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$faq = Faq::paginate(10);
    	return view('admin.faq.home', compact('faq'));
    }

    public function create() {
    	return view('admin.faq.edit');
    }

    public function edit($id) {
    	$faq = Faq::findOrFail($id);
    	return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request) {
    	$id = $request->get("id");
        $result = false;
        if ($id == 0) {
            $post_data = $request->all();
            $faq = new Faq();
            $faq->question = $post_data['question'];
            $faq->answer = $post_data['answer'];
            $result = $faq->save();
        } else {
            $faq = Faq::findOrFail($id);
            if ($faq) {
                $result = $faq->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Faq saved successfully!');
        } else {
            Session::flash('error', 'Faq failed to save successfully!');
        }
        if ($faq && $faq->id) {
            return redirect('admin/faq/edit/' . $faq->id);
        }
        return redirect('admin/faq/create');
    }

    public function delete($id) {
    	$faq = Faq::find($id);
    	$faq->delete();
    	return redirect('admin/faq');
    }
}
