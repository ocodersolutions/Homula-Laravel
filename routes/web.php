<?php
use App\Mail\sender;
use Illuminate\Http\Request;
/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */


Auth::routes();

// Route::get('/', function() {
// 	return view('home');
// });
Route::get('/', 'HomeController@index');

/*
 * Front end
 */
// router compare
Route::get('compare', 'HomeController@compare');
Route::get('compare/remove-all', 'HomeController@remove_all_session_compare');
Route::get('profile', 'FrontendController@index');

// news
Route::get('news/{alias}','FrontendController@news_cat');
Route::get('news-detail/{alias}','FrontendController@news_detail');

// agents
Route::get('agents', 'FrontendController@agents');
Route::get('realestate-agent', 'FrontendController@agents');
Route::get('agents/{alias}', 'FrontendController@agents_detail');

// properties
Route::get('properties/{alias}', 'FrontendController@properties');

//send email template
Route::post('/sender', function () {
    Mail::to('topinfo93@gmail.com')->send(new sender);
    return  redirect('/');
});

/**
 * admin
 */
Route::group(['middleware' => ['role:admin']], function() {
    Route::get('admin', 'Admin\AdminController@index');

    //user
    Route::get('admin/users', 'Admin\UserController@index');
    Route::get('admin/users/create', 'Admin\UserController@create');
    Route::get('admin/users/edit/{id}', 'Admin\UserController@edit');
    Route::post('admin/users/save', 'Admin\UserController@update');
    Route::get('admin/users/delete/{id}', 'Admin\UserController@delete');

    //permission
    Route::get('admin/user/permissions', 'Admin\PermissionController@index');
    Route::get('admin/user/permission/create', 'Admin\PermissionController@create');
    Route::post('admin/user/permission/save', 'Admin\PermissionController@update');
    Route::get('admin/user/permission/edit/{id}', 'Admin\PermissionController@edit');
    Route::get('admin/user/permission/delete/{id}', 'Admin\PermissionController@delete');

    //roles
    Route::get('admin/user/roles', 'Admin\RoleController@index');
    Route::get('admin/user/role/create', 'Admin\RoleController@create');
    Route::post('admin/user/role/save', 'Admin\RoleController@update');
    Route::get('admin/user/role/edit/{id}', 'Admin\RoleController@edit');
    Route::post('admin/user/role/update/{id}', 'Admin\RoleController@update');
    Route::get('admin/user/role/delete/{id}', 'Admin\RoleController@delete');

    //profile
    Route::get('admin/user/profile', 'Admin\UserController@getProfile');
    Route::post('admin/user/profile', 'Admin\UserController@postProfile');

    //menu
    Route::get('admin/menu', 'Admin\MenuController@index');
    Route::get('admin/menu/create', 'Admin\MenuController@create');
    Route::post('admin/menu/save', 'Admin\MenuController@update');
    Route::get('admin/menu/edit/{id}', 'Admin\MenuController@edit');
    Route::get('admin/menu/delete/{id}', 'Admin\MenuController@delete');

    //categories
    Route::get('admin/categories', 'Admin\CategoriesController@index');
    Route::get('admin/categories/create', 'Admin\CategoriesController@create');
    Route::post('admin/categories/save', 'Admin\CategoriesController@update');
    Route::get('admin/categories/edit/{id}', 'Admin\CategoriesController@edit');
    Route::get('admin/categories/delete/{id}', 'Admin\CategoriesController@delete');

    //Articles
    Route::get('admin/articles', 'Admin\ArticlesController@index');
    Route::get('admin/articles/create', 'Admin\ArticlesController@create');
    Route::post('admin/articles/save', 'Admin\ArticlesController@update');
    Route::get('admin/articles/edit/{id}', 'Admin\ArticlesController@edit');
    Route::get('admin/articles/delete/{id}', 'Admin\ArticlesController@delete');

    Route::group(['prefix' => 'admin/gallery', "namespace" => "Admin"], function() {
        Route::get('', 'GalleryController@cats');
        Route::get('/cat/{id}', 'GalleryController@cat');
        Route::get('/cat/add', 'GalleryController@cat');
        Route::post('/cat/save', 'GalleryController@saveCat');
        Route::get('/cat/delete/{id}', 'GalleryController@deleteCat');
    });

    //Agents
    Route::get('admin/agents', 'Admin\AgentsController@index');
    Route::get('admin/agents/create', 'Admin\AgentsController@create');
    Route::post('admin/agents/save', 'Admin\AgentsController@update');
    Route::get('admin/agents/edit/{id}', 'Admin\AgentsController@edit');
    Route::get('admin/agents/delete/{id}', 'Admin\AgentsController@delete');

    //Properties
    Route::get('admin/properties', 'Admin\PropertiesController@index');
    Route::get('admin/properties/create', 'Admin\PropertiesController@create');
    Route::post('admin/properties/save', 'Admin\PropertiesController@update');
    Route::get('admin/properties/edit/{id}', 'Admin\PropertiesController@edit');
    Route::get('admin/properties/delete/{id}', 'Admin\PropertiesController@delete');

    //Page
    Route::get('admin/page', 'Admin\PageController@index');
    Route::get('admin/page/create', 'Admin\PageController@create');
    Route::post('admin/page/save', 'Admin\PageController@update');
    Route::get('admin/page/edit/{id}', 'Admin\PageController@edit');
    Route::get('admin/page/delete/{id}', 'Admin\PageController@delete');

    //Meta
    Route::get('admin/meta', 'Admin\MetaController@index');
    Route::get('admin/meta/create', 'Admin\MetaController@create');
    Route::post('admin/meta/save', 'Admin\MetaController@update');
    Route::get('admin/meta/edit/{id}', 'Admin\MetaController@edit');
    Route::get('admin/meta/delete/{id}', 'Admin\MetaController@delete');

    //Faq
    Route::get('admin/faq', 'Admin\FaqController@index');
    Route::get('admin/faq/create', 'Admin\FaqController@create');
    Route::post('admin/faq/save', 'Admin\FaqController@update');
    Route::get('admin/faq/edit/{id}', 'Admin\FaqController@edit');
    Route::get('admin/faq/delete/{id}', 'Admin\FaqController@delete');

    //Help centre
    Route::get('admin/helpcentre', 'Admin\HelpCentreController@index');
    Route::get('admin/helpcentre/create', 'Admin\HelpCentreController@create');
    Route::post('admin/helpcentre/save', 'Admin\HelpCentreController@update');
    Route::get('admin/helpcentre/edit/{id}', 'Admin\HelpCentreController@edit');
    Route::get('admin/helpcentre/delete/{id}', 'Admin\HelpCentreController@delete');

    //Company
    Route::get("admin/photographers", "Admin\PhotographersController@index");
    Route::get("admin/photographers/create", "Admin\PhotographersController@create");
    Route::post("admin/photographers/save", "Admin\PhotographersController@update");
    Route::get("admin/photographers/edit/{id}", "Admin\PhotographersController@edit");
    Route::get("admin/photographers/delete/{id}", "Admin\PhotographersController@delete");

});

Route::group(['middleware' => ['role:owner|register']], function() {
    Route::get('admin', 'Admin\AdminController@index');

    Route::get('admin/user/profile', 'Admin\UserController@getProfile');
    Route::post('admin/user/profile', 'Admin\UserController@postProfile');
});

// ads
Route::get('advertisement', 'Admin\AdminController@ads');
Route::get('advertisement/create/{id}', 'Admin\AdminController@ads_save');

//Help centre
Route::get('help-centre', 'FrontendController@help_centre');
Route::get('help-centre/{alias}', 'FrontendController@help_centre_cat');

//Page and specials page
Route::get('{alias}', 'FrontendController@page');

/**
 * create menu role:admin
 */
Menu::make('MyNavBar', function($menu) {
    $menu->add('View site')->attr(array('pre_icon' => 'home'));

    //users
    $menu->add('Users Manager', 'users')->attr(array('pre_icon' => 'user'));
    $menu->usersManager->add('Users', 'admin/users')->attr(array('pre_icon' => 'user'))->active('admin/users/*');
    $menu->usersManager->add('Permissions', 'admin/user/permissions')->attr(array('pre_icon' => 'user'))->active('admin/user/permission/*');
    $menu->usersManager->add('Roles', 'admin/user/roles')->attr(array('pre_icon' => 'users'))->active('admin/user/role/*');
    $menu->usersManager->add('My account', 'admin/user/profile')->attr(array('pre_icon' => 'envelope'));

    $menu->add('Menu', 'admin/menu')->attr(array('pre_icon' => 'bars'))->active('admin/menu/*');

    $menu->add('Categories', 'admin/categories')->attr(array('pre_icon' => 'tag'))->active('admin/categories/*');

    $menu->add('Articles', 'admin/articles')->attr(array('pre_icon' => 'file-text'))->active('admin/articles/*');

    $menu->add('Agents', 'admin/agents')->attr(array('pre_icon' => 'address-book'))->active('admin/agents/*');

    $menu->add('Properties', 'admin/properties')->attr(array('pre_icon' => 'cog'))->active('admin/properties/*');

    $menu->add('Advertisement', 'advertisement')->attr(array('pre_icon' => 'buysellads'))->active('advertisement/*');

    $menu->add('Page', 'admin/page')->attr(array('pre_icon' => 'file'))->active('admin/page/*');

    $menu->add('Meta list', 'admin/meta')->attr(array('pre_icon' => 'info'))->active('admin/meta/*');

    $menu->add('Faq', 'admin/faq')->attr(array('pre_icon' => 'question-circle'))->active('admin/faq/*');

    $menu->add('Help centre', 'admin/helpcentre')->attr(array('pre_icon' => 'user-md'))->active('admin/helpcentre/*');

    $menu->add('photographers', 'admin/photographers')->attr(array('pre_icon' => 'building'))->active('admin/photographers/*');

//    $menu->add('Gallery', 'admin/gallery')->attr(array('pre_icon' => 'picture-o'));
});
/**
 * create menu don't role:admin
 */
Menu::make('MyNavBar_v2', function($menu) {
    $menu->add('Home');
    $menu->add('Profile', 'admin/user/profile');
});
