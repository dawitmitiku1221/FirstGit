<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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
Route::resource('posts','App\Http\Controllers\EventController');

Route::resource('musuem','App\Http\Controllers\MuseumRecordController');
Auth::routes();

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::resource('churchprofile','App\Http\Controllers\ChurchProfileController');

Route::get('educ_material/display','App\Http\Controllers\Educ_MaterialController@display');
Route::get('educ_material/download','App\Http\Controllers\Educ_MaterialController@download');

Route::resource('educ_material','App\Http\Controllers\Educ_MaterialController');

