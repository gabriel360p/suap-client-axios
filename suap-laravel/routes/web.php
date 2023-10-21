<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/painel', function () {

    // Recuperar um valor da sessão
    // $session = session('UserSession');

    // return view('painel',['session'=>$session]);

    return view('painel');
});//->middleware(['AuthSuap']);


//armazenando os cookies de acesso
Route::post('/suapToken', function (Request $request) {
    $token='#access_token';

    //geração dos cookies
    setcookie('suapToken', $request->$token, time()+1440);
    setcookie('suapTokenExpirationTime', $request->expires_in, time()+1440);
    setcookie('suapScope', $request->scope, time()+1440);
    
    return response($request);
});


Route::get('/logout', function () {
    setcookie('suapToken', null, -1);
    setcookie('suapTokenExpirationTime', null, -1);
    setcookie('suapScope', null, -1);

    // Excluir um valor da sessão'
    session()->forget('UserSession');

    return redirect('/');
});


Route::post('/dados', function (Request $request) {
    $user = [
        'identificacao' => $request->identificacao,
        'nome' => $request->nome,
        'email' => $request->email,
        'campus' => $request->campus,
        'cpf' => $request->cpf,
        'data_de_nascimento' => $request->data_de_nascimento,
        'email_academico' => $request->email_academico,
        'email_google_classroom' => $request->email_google_classroom,
        'email_preferencial' => $request->email_preferencial,
        'email_secundario' => $request->email_secundario,
        'foto' => $request->foto,
        'nome_registro' => $request->nome_registro,
        'nome_social' => $request->nome_social,
        'nome_usual' => $request->nome_usual,
        'primeiro_nome' => $request->primeiro_nome,
        'sexo' => $request->sexo,
        'tipo_usuario' => $request->tipo_usuario,
        'ultimo_nome' => $request->ultimo_nome,
    ];

    // até aqui ok, funciona
    session()->forget('UserSession');

    //armazenando  na variável sessao do laravel
    session(['UserSession' => $user]);
    $session = session('UserSession');

    return response($session, 200);
});
