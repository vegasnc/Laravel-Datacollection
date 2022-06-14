<?php

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

//start Test
Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');
//End test
Route::group(['prefix' => 'v1'], function () {
    Route::get('/clientlist', 'App\Http\Controllers\ApiController@clientlist')->name('clientlist');

    Route::POST('/contactlist', 'App\Http\Controllers\ApiController@contactlist')->name('contactlist');
    Route::POST('/contactlocation', 'App\Http\Controllers\ApiController@contactlocation')->name('contactlocation');

    Route::POST('/getEstimateProposal', 'App\Http\Controllers\ApiController@getEstimateProposal')->name('getEstimateProposal');

    Route::get('/users', 'App\Http\Controllers\TestController@users')->name('users');

    Route::post('/create-users', 'App\Http\Controllers\TestController@createUsers')->name('apicreateEnv');
}); 