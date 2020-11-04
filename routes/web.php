<?php

use Illuminate\Support\Facades\Route;   
use Illuminate\Http\Request;
use App\adduser;
use Illuminate\Support\Facades\Auth;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth','role']], function () {

    Route::get('/admin', function () {
        $userdata = User::all();
        return view('admin',compact('userdata',$userdata));
        
    });
    
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/search', 'HomeController@search')->name('home.search');

Route::any('add','AdduserController@store')->name('add');
Route::get('show/{id}','AdduserController@show')->middleware('can:view,id');
Route::put('/edit/{id}','AdduserController@update');
Route::get('/edit/{id}','AdduserController@edit');  
Route::delete('/delete/{id}','AdduserController@destroy');
Route::resource('/add', 'AdduserController');
Route::resource('/category', 'CategoryController')->only(['index']);

Route::resource('/subcategory', 'SubcategoryController');
Route::get('add',array('as'=>'myform','uses'=>'AdduserController@myform'));
Route::get('add/ajax/{id}',array('as'=>'myform.ajax','uses'=>'AdduserController@myformAjax'));


// Route::get('/search', 'HomeController@index');

// Route::get('/editcategory', function () {
//     return view('editcategory');
// });

Route::get('/lang/{lang}',function($lang){
    App::setlocale($lang);
    return view('home');
});

$user = Auth::loginUsingId(15);
Route::get('testemail',function() use($user){
    Mail::to($user)->send(new WelcomeMail($user));
});