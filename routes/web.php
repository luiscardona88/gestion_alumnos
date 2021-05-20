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
    return view('welcome');
});

Route::get("/Alumnos/listar_imagenes/",'Alumnos@listar_imagenes');
Route::get('/Login/validaLogin/','Login@validaLogin');
Route::get('/Alumnos/update2/{id}','Alumnos@update2');
Route::get('/Alumnos/asignar_asignaturas/','Alumnos@asignar_asignaturas');
Route::get('/Menu/index/','Menu@index');

Route::post('/Alumnos/store2','Alumnos@store2')->name("guardar_alumnos");
Route::resource("Alumnos","Alumnos");
Route::get("Asignatura/muestra_horarios","Asignatura@muestra_horarios");
Route::resource("Asignatura","Asignatura");
Route::resource("Login","Login");
Route::post('/Asignatura/store','Asignatura@store')->name("store_asignatura");
Route::post("/Alumnos/subirFile",'Alumnos@subirFile')->name("subirFile");

