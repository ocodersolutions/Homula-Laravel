<?php


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

Route::get('profile', 'FrontendController@index');

/**
 * admin
 */
Route::group(['middleware' => ['role:admin']], function() {
	//user
	Route::get('admin', 'Admin\AdminController@index');
	Route::get('admin/users', 'Admin\UserController@index');
	Route::get('admin/user/create', 'Admin\UserController@create');
	Route::get('admin/user/edit/{id}', 'Admin\UserController@edit');
	Route::post('admin/user/save', 'Admin\UserController@save'); 
	Route::get('admin/user/delete/{id}', 'Admin\UserController@delete');

	//permission
	Route::get('admin/user/permissions', 'Admin\PermissionController@index');
	Route::get('admin/user/permission/create', 'Admin\PermissionController@create');
	Route::post('admin/user/permission/save', 'Admin\PermissionController@update');
	Route::get('admin/user/permission/edit/{id}', 'Admin\PermissionController@edit');
	Route::post('admin/user/permission/update/{id}', 'Admin\PermissionController@update');
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
	Route::patch('admin/menu/update/{id}', 'Admin\MenuController@update');
	Route::get('admin/menu/delete/{id}', 'Admin\MenuController@delete');

	//categories
	Route::get('admin/categories', 'Admin\CategoriesController@index');
	Route::get('admin/categories/create', 'Admin\CategoriesController@create');
	Route::post('admin/categories/save', 'Admin\CategoriesController@update');
	Route::get('admin/categories/edit/{id}', 'Admin\CategoriesController@edit');
	Route::patch('admin/categories/update/{id}', 'Admin\CategoriesController@update');
	Route::get('admin/categories/delete/{id}', 'Admin\CategoriesController@delete');

	//Articles
	Route::get('admin/articles', 'Admin\ArticlesController@index');
	Route::get('admin/articles/create', 'Admin\ArticlesController@create');
	Route::post('admin/articles/save', 'Admin\ArticlesController@update');
	Route::get('admin/articles/edit/{id}', 'Admin\ArticlesController@edit');
	Route::patch('admin/articles/update/{id}', 'Admin\ArticlesController@update');
	Route::get('admin/articles/delete/{id}', 'Admin\ArticlesController@delete');
});

Route::group(['middleware' => ['role:owner|register']], function() {
	Route::get('admin', 'Admin\AdminController@index');

	Route::get('admin/user/profile', 'Admin\UserController@getProfile');
	Route::post('admin/user/profile', 'Admin\UserController@postProfile');
});

/**
 * create menu role:admin
 */

Menu::make('MyNavBar', function($menu) {
    $menu->add('Home')->attr(array('pre_icon'=>'home'));

	//users
    $menu->add('Users Manager', 'users')->attr(array('pre_icon'=>'user'));
    $menu->usersManager->add('Users', 'admin/users')->attr(array('pre_icon'=>'user'))->active('admin/users/*');
    $menu->usersManager->add('Permissions', 'admin/user/permissions')->attr(array('pre_icon'=>'user'))->active('admin/user/permission/*');
    $menu->usersManager->add('Roles', 'admin/user/roles')->attr(array('pre_icon'=>'users'))->active('admin/user/role/*');
    $menu->usersManager->add('Profile', 'admin/user/profile')->attr(array('pre_icon'=>'envelope'));

    $menu->add('Menu', 'admin/menu')->attr(array('pre_icon'=>'bars'));

    $menu->add('Categories', 'admin/categories')->attr(array('pre_icon'=>'tag'));

    $menu->add('Articles', 'admin/articles')->attr(array('pre_icon'=>'file-text'));
});
/**
 * create menu don't role:admin
 */
Menu::make('MyNavBar_v2', function($menu) {
    $menu->add('Home');
    $menu->add('Profile', 'admin/user/profile');
});