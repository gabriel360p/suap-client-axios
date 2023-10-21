<?php

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['SuapAuth']);


Route::get('/authorization-view', function () {
    return view('authorization-view');
});

Route::get('/logout', function (Request $request) {
    setcookie('suapToken',null,-1);
    setcookie('suapTokenExpirationTime',null,-1);
    setcookie('suapScope', $request->scope, null,-1);

    Session::first()->delete();
    return redirect('/');
});


