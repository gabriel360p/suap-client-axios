<?php

use App\Models\Session;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/authorization-callback', function (Request $request) {
        $request->token;
        
        $res = Http::withUrlParameters([
            'scope' => 'identificacao'
        ])->withToken($request->token)
        ->acceptJson()
        ->get('https://suap.ifrn.edu.br/api/eu/');

        Session::create([
            'nome'=>$res['nome'],
            'email'=>$res['email'],
            'identificacao'=>$res['identificacao'],
        ]);

        return $res;
    }
);