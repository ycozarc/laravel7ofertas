<?php

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

Auth::routes(['verify' => true]);

Route::get('/', 'InicioController@index')->name('inicio.index');

Route::get('/chollos', 'CholloController@index')->name('chollos.index');
Route::get('/chollos/gratis', 'CholloController@gratis')->name('chollos.gratis');
Route::get('/chollos/promociones', 'CholloController@promociones')->name('chollos.promociones');
Route::get('/chollos/cupones', 'CholloController@cupones')->name('chollos.cupones');
Route::get('/chollos/populares', 'CholloController@populares')->name('chollos.populares');
Route::get('/chollos/ultimos', 'CholloController@ultimos')->name('chollos.ultimos');
Route::get('/chollos/guardados', 'CholloController@guardados')->name('chollos.guardados');
Route::get('/chollos/crear', 'CholloController@create')->name('chollos.create');
Route::post('/chollos', 'CholloController@store')->name('chollos.store');
Route::get('/chollos/{chollo}', 'CholloController@show')->name('chollos.show');
Route::post('/chollos/{chollo}/comentario', 'ComentariosChollosController@store')->name('comentarios.store');
Route::get('/chollos/{chollo}/editar', 'CholloController@edit')->name('chollos.edit');
Route::put('/chollos/{chollo}', 'CholloController@update')->name('chollos.update');
Route::delete('/chollos/{chollo}', 'CholloController@destroy')->name('chollos.destroy');
Route::delete('/chollos/comentario/{comentario}', 'ComentariosChollosController@destroy')->name('comentarios.destroy');
Route::post('chollos/{chollo}', 'CholloController@estado')->name('chollos.estado');


// Perfiles

Route::get('/perfil/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfil/{perfil}/editar', 'PerfilController@edit')->name('perfiles.edit');
Route::put('/perfil/{perfil}', 'PerfilController@update')->name('perfiles.update');

//Panel admin

Route::group(['middleware' => ['rol:admin,mod']], function () {

    //Inicio Panel
    
    Route::get('admin', 'AdminController@index')->name('admin.index');

    //Admin Chollos

    Route::get('/admin/chollos', 'AdminCholloController@index')->name('admin.chollos.index');
    Route::get('/admin/chollos/{chollo}/editar', 'AdminCholloController@edit')->name('admin.chollos.edit');
    Route::delete('/admin/chollos/{chollo}', 'AdminCholloController@destroy')->name('admin.chollos.destroy');
    Route::put('/admin/chollos/{chollo}', 'AdminCholloController@update')->name('admin.chollos.update');
    Route::get('/admin/chollos/crear', 'AdminCholloController@create')->name('admin.chollos.create');
    Route::post('/admin/chollos', 'AdminCholloController@store')->name('admin.chollos.store');
    Route::get('/admin/chollos/buscar', 'AdminCholloController@search')->name('admin.chollos.buscar');
    Route::get('/admin/chollos/moderar', 'AdminCholloController@moderar')->name('admin.chollos.moderar');
    Route::post('/admin/chollos/moderado/{chollo}', 'AdminCholloController@moderado')->name('admin.chollos.moderado');

    //Admin Comentarios

    Route::get('/admin/comentarios', 'AdminComentariosController@index')->name('admin.comentarios.index');
    Route::get('/admin/comentarios/{comentario}/editar', 'AdminComentariosController@edit')->name('admin.comentarios.edit');
    Route::delete('/admin/comentarios/{comentario}', 'AdminComentariosController@destroy')->name('admin.comentarios.destroy');
    Route::put('/admin/comentarios/{comentario}', 'AdminComentariosController@update')->name('admin.comentarios.update');
    Route::get('/admin/comentarios/buscar', 'AdminComentariosController@search')->name('admin.comentarios.buscar');
});

Route::group(['middleware' => ['rol:admin']], function () {

    //Admin usuarios

    Route::get('/admin/usuarios', 'AdminUserController@index')->name('admin.usuarios.index');
    Route::get('/admin/usuarios/crear', 'AdminUserController@create')->name('admin.usuarios.crear');
    Route::get('/admin/usuarios/{user}/editar', 'AdminUserController@edit')->name('admin.usuarios.editar');
    Route::post('/admin/usuarios', 'AdminUserController@store')->name('admin.usuarios.store');
    Route::put('/admin/usuarios/{user}', 'AdminUserController@update')->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{user}', 'AdminUserController@destroy')->name('admin.usuarios.destroy');
    Route::get('/admin/usuarios/buscar', 'AdminUserController@search')->name('admin.usuarios.buscar');

    //Admin categorias

    Route::get('/admin/categorias', 'AdminCategoriasController@index')->name('admin.categorias.index');
    Route::get('/admin/categorias/{categoria}/editar', 'AdminCategoriasController@edit')->name('admin.categorias.edit');
    Route::delete('/admin/categorias/{categoria}', 'AdminCategoriasController@destroy')->name('admin.categorias.destroy');
    Route::put('/admin/categorias/{categoria}', 'AdminCategoriasController@update')->name('admin.categorias.update');
    Route::get('/admin/categorias/crear', 'AdminCategoriasController@create')->name('admin.categorias.create');
    Route::post('/admin/categorias', 'AdminCategoriasController@store')->name('admin.categorias.store');
    Route::get('/admin/categorias/buscar', 'AdminCategoriasController@search')->name('admin.categorias.buscar');

    //Admin tiendas

    Route::get('/admin/tiendas', 'AdminTiendasController@index')->name('admin.tiendas.index');
    Route::get('/admin/tiendas/{tienda}/editar', 'AdminTiendasController@edit')->name('admin.tiendas.edit');
    Route::delete('/admin/tiendas/{tienda}', 'AdminTiendasController@destroy')->name('admin.tiendas.destroy');
    Route::put('/admin/tiendas/{tienda}', 'AdminTiendasController@update')->name('admin.tiendas.update');
    Route::get('/admin/tiendas/crear', 'AdminTiendasController@create')->name('admin.tiendas.create');
    Route::post('/admin/tiendas', 'AdminTiendasController@store')->name('admin.tiendas.store');
    Route::get('/admin/tiendas/buscar', 'AdminTiendasController@search')->name('admin.tiendas.buscar');

    //Admin Roles

    Route::get('/admin/roles', 'AdminRolesController@index')->name('admin.roles.index');
    Route::get('/admin/roles/{rol}/editar', 'AdminRolesController@edit')->name('admin.roles.edit');
    Route::delete('/admin/roles/{rol}', 'AdminRolesController@destroy')->name('admin.roles.destroy');
    Route::put('/admin/roles/{rol}', 'AdminRolesController@update')->name('admin.roles.update');
    Route::get('/admin/roles/crear', 'AdminRolesController@create')->name('admin.roles.create');
    Route::post('/admin/roles', 'AdminRolesController@store')->name('admin.roles.store');
    Route::get('/admin/roles/buscar', 'AdminRolesController@search')->name('admin.roles.buscar');
});

//Likes

Route::put('/chollo/{chollo}', 'LikesController@update')->name('likes.update');

//Follow

Route::put('/chollof/{chollo}', 'FollowsController@update')->name('follows.update');

//Categorias

Route::get('categoria/{categoriaChollo}', 'CategoriasController@show')->name('categorias.ver');

// Tiendas

Route::get('tienda/{tiendaChollo}', 'TiendasController@show')->name('tiendas.ver');

// Buscador

Route::get('/buscar', 'CholloController@search')->name('buscar.ver');