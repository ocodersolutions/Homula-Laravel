<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$page = Page::where('page_parent','!=','0')->paginate(10);
    	return view('admin.page.home', compact('page'));
    }

    public function create() {
    	$page_parent = Page::All();
    	return view('admin.page.edit', compact('page_parent'));
    }

    public function edit($id) {
    	$page = Page::findOrFail($id);
    	$page_parent = Page::All();
    	return view('admin.page.edit', compact('page', 'page_parent'));
    }

    public function update(Request $request) {
    	$id = $request->get("id");
        $result = false;
        if ($id == 0) {
            $post_data = $request->all();
            $page = new Page();
            $page->title = $post_data['title'];
            if (!$post_data['alias'] == '') {
                $page->alias = $post_data['alias'];
            } else {
                $page->alias = str_slug($post_data['title'], '-');
            }
            $page->thumbnail = $post_data['thumbnail'];
            $page->content = $post_data['content'];
            $page->page_parent = $post_data['page_parent'];
            $page->template = $post_data['template'];
            $result = $page->save();
        } else {
            $page = Page::findOrFail($id);
            if ($page) {
                $result = $page->update($request->all());
            }
        }
        if ($result) {
            Session::flash('success', 'Page saved successfully!');
        } else {
            Session::flash('error', 'Page failed to save successfully!');
        }
        if ($page && $page->id) {
            return redirect('admin/page/edit/' . $page->id);
        }
        return redirect('admin/page/create');
    }

    public function delete($id) {
    	$page = Page::find($id);
        $page->delete();
        return redirect('admin/page');
    }

    public static function getPage($id) {
    	$page_parent = Page::findOrFail($id);
    	return $page_parent;
    }
}