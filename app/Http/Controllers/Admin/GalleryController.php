<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Gallery\GalleryCat;
use App\Models\Gallery\GalleryItem;
use Illuminate\Support\Facades\Input;

class GalleryController extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function cats() {
        $cats = GalleryCat::paginate(15);
        return view("admin/galleries/cats", ['cats' => $cats]);
    }

    public function cat($id = 0) {
        $cat = GalleryCat::find($id);
        return view("admin/galleries/cat", ['cat' => $cat]);
    }

    public function saveCat(Request $req) {
        $id = Input::get("id");
        if ($id) {
            $cat = GalleryCat::find($id);
        } else {
            $cat = new GalleryCat();
            $cat->title = $req->title;
            $cat->save();
        }
        $result = $cat->update($req->all());

        if ($result) {
            Session::flash('success', 'Gallery Category saved successfully!');
        } else {
            Session::flash('error', 'Gallery Category fail to save!');
            Input::flash();
        }
        if ($cat && $cat->id) {
            return Redirect::to('/admin/gallery/cat/' . $cat->id);
        }
        return Redirect::to('/admin/gallery/cat/add');
    }

    public function deleteCat($cat_id) {
        if (!$cat_id) {
            Session::flash('error', 'Gallery Category fail to delete!<br>No id found!');
        } else {
            $cat = GalleryCat::find($cat_id);
            if ($cat && $cat->delete()) {
                Session::flash('success', 'Gallery Category deleted successfully!');
            } else {
                Session::flash('error', 'Gallery Category fail to delete!');
            }
        }
        return Redirect::to('/admin/gallery');
    }

}
