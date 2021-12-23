<?php

use App\Http\Controllers\GuiaRemisionController;
use App\Http\Controllers\TestController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::resource('guiaremision', GuiaRemisionController::class);
    Route::get('guiaremision/{id}/pdf', [GuiaRemisionController::class,'pdf'])->name('guiaremision.pdf');
    Route::post('guiaremision/{id}/items', [GuiaRemisionController::class,'item'])->name('guiaremision.items');
    Route::post('guiaremision/{id}/transporte', [GuiaRemisionController::class,'transporte'])->name('guiaremision.transporte');
    Route::get('guiaremision/{id}/sunat', [GuiaRemisionController::class,'sunat'])->name('guiaremision.sunat');
});

Route::get('test', TestController::class);
Route::get('test2', \App\Http\Controllers\Test2Controller::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
