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
    return view('pages.index');
});

/**
 * Rotas Cliente
 */
Route::any('cliente', 'App\Http\Controllers\ClientController@index')->name('index_cliente');
Route::get('cliente/create', 'App\Http\Controllers\ClientController@create')->name('create_cliente');
Route::post('cliente/create', 'App\Http\Controllers\ClientController@store')->name('store_cliente');
Route::post('cliente/search', 'App\Http\Controllers\ClientController@search')->name('search_cliente');
Route::get('cliente/{id}', 'App\Http\Controllers\ClientController@edit')->name('edit_cliente');
Route::post('cliente/{id}', 'App\Http\Controllers\ClientController@update')->name('update_cliente');
Route::delete('cliente/{id}', 'App\Http\Controllers\ClientController@delete')->name('delete_cliente');


/**
 * Rotas Produto
 */
Route::any('produto', 'App\Http\Controllers\ProdutosController@index')->name('index_produto');
Route::get('produto/create', 'App\Http\Controllers\ProdutosController@create')->name('create_produto');
Route::post('produto/create', 'App\Http\Controllers\ProdutosController@store')->name('store_produto');
Route::post('produto/search', 'App\Http\Controllers\ProdutosController@search')->name('search_produto');
Route::get('produto/{id}', 'App\Http\Controllers\ProdutosController@edit')->name('edit_produto');
Route::post('produto/{id}', 'App\Http\Controllers\ProdutosController@update')->name('update_produto');
Route::delete('produto/{id}', 'App\Http\Controllers\ProdutosController@delete')->name('delete_produto');

/**
 * Rotas Pedidos
 */
Route::any('pedido/{status?}', 'App\Http\Controllers\PedidosProdutosController@index')->name('index_pedido');
Route::get('pedido/create/{id}', 'App\Http\Controllers\PedidosProdutosController@create')->name('create_pedido');
Route::post('pedido/create/{idc}/{idp}', 'App\Http\Controllers\PedidosProdutosController@store')->name('store_pedido');
Route::get('pedido/{id}/status/{status}', 'App\Http\Controllers\PedidosProdutosController@update')->name('update_pedido');
Route::post('pedido/search', 'App\Http\Controllers\PedidosProdutosController@search')->name('search_pedido');
Route::delete('pedido/delete/{id}', 'App\Http\Controllers\PedidosProdutosController@delete')->name('delete_pedido'); 
Route::get('pedido/{id}/detalhes', 'App\Http\Controllers\PedidosProdutosController@show')->name('show_pedido');
Route::get('pedido/cliente/{id}', 'App\Http\Controllers\PedidosProdutosController@produtosPedidos')->name('show_clientePedido');








