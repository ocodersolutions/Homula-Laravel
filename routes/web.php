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
	Route::get('admin', 'Admin\AdminController@index');
	Route::get('admin/users', 'Admin\UserController@index');
	Route::get('admin/users/create', 'Admin\UserController@create');
	Route::get('admin/users/edit/{id}', 'Admin\UserController@edit');
	Route::post('admin/user/save', 'Admin\UserController@save'); 
	Route::get('admin/users/delete/{id}', 'Admin\UserController@delete');

	Route::get('admin/user/permissions', 'Admin\PermissionController@index');
	Route::get('admin/user/permission/create', 'Admin\PermissionController@create');
	Route::post('admin/user/permission/save', 'Admin\PermissionController@store');
	Route::get('admin/user/permission/edit/{id}', 'Admin\PermissionController@edit');
	Route::patch('admin/user/permission/update/{id}', 'Admin\PermissionController@update');
	Route::get('admin/user/permission/delete/{id}', 'Admin\PermissionController@delete');

	Route::get('admin/user/roles', 'Admin\RoleController@index');
	Route::get('admin/user/role/create', 'Admin\RoleController@create');
	Route::post('admin/user/role/save', 'Admin\RoleController@store'); 
	Route::get('admin/user/role/edit/{id}', 'Admin\RoleController@edit');
	Route::patch('admin/user/role/update/{id}', 'Admin\RoleController@update');
	Route::get('admin/user/role/delete/{id}', 'Admin\RoleController@delete');

	Route::get('admin/user/profile', 'Admin\UserController@getProfile');
	Route::post('admin/user/profile', 'Admin\UserController@postProfile');

	Route::get('admin/categories', 'Admin\CategoriesController@index');
});

Route::group(['middleware' => ['role:owner|register']], function() {
	Route::get('admin', 'Admin\AdminController@index');

	Route::get('admin/user/profile', 'Admin\UserController@getProfile');
	Route::post('admin/user/profile', 'Admin\UserController@postProfile');
});

/**
 * create menu
 */

Menu::make('MyNavBar', function($menu) {
    $menu->add('Home')->attr(array('pre_icon'=>'home'));

	//users
    $menu->add('Users Manager', 'users')->attr(array('pre_icon'=>'user'));
    $menu->usersManager->add('Users', 'admin/users')->attr(array('pre_icon'=>'user'))->active('admin/users/*');
    $menu->usersManager->add('Permissions', 'admin/user/permissions')->attr(array('pre_icon'=>'user'))->active('admin/user/permission/*');
    $menu->usersManager->add('Roles', 'admin/user/roles')->attr(array('pre_icon'=>'users'))->active('admin/user/role/*');
    $menu->usersManager->add('Profile', 'admin/user/profile')->attr(array('pre_icon'=>'envelope'));

    $menu->add('Categories', 'admin/categories')->attr(array('pre_icon'=>'tag'));
});
Menu::make('MyNavBar_v2', function($menu) {
    $menu->add('Home');
    $menu->add('Profile', 'admin/user/profile');
});