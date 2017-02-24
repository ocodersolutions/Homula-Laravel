<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categories = Categories::paginate(10);
        return view('admin.categories.home', ['categories' => $categories]);
    }

    public function create()
    {
        $categories = Categories::all();
        $categories_level = Categories::where(['parent_id' => 0])->get();
        return view('admin.categories.edit', ['categories' => $categories, 'categories_level' => $categories_level]);
    }

    public function edit($id)
    {
        $categories_item = Categories::findOrFail($id);
        $categories = Categories::all();
        $categories_level = Categories::where(['parent_id' => 0])->get();
        return view('admin.categories.edit',compact('categories', 'categories_item', 'categories_level'));
    }

    public function update(Request $request)
    {
        $id = $request->get("id");
        $result = false;
        $ex_alias = 0;

        if ($id == 0) {
            $post_data = $request->all();
            $categories = new Categories();
            $categories->name = $post_data['name'];
            if ($post_data['alias'] != '') {
                $categories->alias = $post_data['alias'];
            }
            else {
                $str = str_replace(' ', '-', $post_data['address']);
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
                $str = strtolower(preg_replace('/-+/', '-', $str));
                $ex_alias = Categories::where("alias",'=',$str)->get()->first() ? "1" : "0";
                $categories->alias = $str;
            }
            $categories->description = $post_data['description'];
            $categories->parent_id = $post_data['parent_id'];
            $categories->published = $request->published ? $request->published : 0;
            $categories->meta_keywords = $post_data['meta_keywords'];
            $categories->meta_description = $post_data['meta_description'];
            $result = $categories->save();
        }
        else {
            $categories = Categories::findOrFail($id); 
            if($categories) {
                $categories->published = $request->published ? $request->published : 0;
                $result = $categories->update($request->all());
            } 
        }
        if ($result) {
            Session::flash('success', 'Categories saved successfully!');
        } else {
            Session::flash('error', 'Categories failed to save successfully!');
        }
        if ($categories && $categories->id) {
            if($ex_alias == 1) {
                $categories->alias .= "-" . $categories->id;
                $categories->save();
            }   
            return redirect('admin/categories/edit/' . $categories->id);
        }
        return redirect('admin/categories/create');
    }

    public function delete($id)
    {
        $categories = Categories::find($id);
        $categories->delete();
        return redirect('admin/categories');
    }

    public static function getCat($id) {
        $categories_item = Categories::findOrFail($id);
        return $categories_item;
    }
}
