<?php

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
use Illuminate\Http\Request;

Route::group(['prefix' => '/'], function () {
    
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'desenvolvedores'], function () {
            Route::get( '/', 'Desenvolvedores@listar');
            Route::get( 'cadastrar', 'Desenvolvedores@cadastrar');
            Route::get( 'alterar/{id}', 'Desenvolvedores@alterar');
            Route::get( 'deletar/{id}', 'Desenvolvedores@excluir');
            Route::post( 'salvar', 'Desenvolvedores@salvar');
        });
        Route::group(['prefix' => 'grupos'], function () {
            Route::get( '/', 'Grupos@listar');
            Route::get( 'cadastrar', 'Grupos@cadastrar');
            Route::get( 'alterar/{id}', 'Grupos@alterar');
            Route::get( 'deletar/{id}', 'Grupos@excluir');
            Route::post( 'salvar', 'Grupos@salvar');
        });
    });;
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');