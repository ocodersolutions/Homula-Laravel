<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\Categories;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::paginate(10);
        return view('admin.articles.home', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Articles::all();
        $categories = Categories::all();
        return view('admin.articles.create', ['articles' => $articles, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_data = $request->all();
        $articles = new Articles();
        $articles->title = $post_data['title'];
        if (!$post_data['alias'] == '') {
            $articles->alias = $post_data['alias'];
        }
        else {
            $articles->alias = str_slug($post_data['title'], '-');
        }
        $articles->thumbnail = $post_data['thumbnail'];
        $articles->content = $post_data['content'];
        $articles->excerpt = $post_data['excerpt'];
        $articles->categories_id = $post_data['categories_id'];
        $articles->publisher = $post_data['publisher'];
        $articles->save();

        return redirect('admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles = Articles::findOrFail($id);
        $categories = Categories::all();
        return view('admin.articles.edit',compact('articles', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articles = Articles::findOrFail($id); 
        if(!$articles) return redirect('admin/articles');
        $articles->update($request->all()); 
        return redirect('admin/articles/edit/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete($id)
    {
        $articles = Articles::find($id);
        $articles->delete();
        return redirect('admin/articles');
    }
}
