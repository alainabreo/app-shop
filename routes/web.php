<?php

/*Route::get('/', function () {
    return view('welcome');
});*/

//controlador@metodo
Route::get('/', 'TestController@welcome');

Route::get('/prueba', function() {
	return 'Hola soy una ruta de prueba';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show'); //ver info de un producto

Route::middleware(['auth'])->group(function () {
	Route::post('/cart', 'CartDetailController@store'); //Agrega un nuevo carrito
	Route::delete('/cart', 'CartDetailController@destroy'); //Borra producto del carrito
	Route::post('/order', 'CartController@update'); //Hace el pedido
});

//Opciones que solo puede ver un administrador logueado
Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {
	Route::get('/products', 'ProductController@index'); //listado
	Route::get('/products/create', 'ProductController@create'); //form crear
	Route::post('/products', 'ProductController@store'); //grabar
	Route::get('/products/{id}/edit', 'ProductController@edit'); //form edicion
	Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar
	Route::delete('/products/{id}', 'ProductController@destroy'); //form eliminar

	Route::get('/products/{id}/images', 'ImageController@index'); //listado
	Route::post('/products/{id}/images', 'ImageController@store'); //grabar	
	Route::delete('/products/{id}/images', 'ImageController@destroy'); //form eliminar	
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar una imagen

	Route::get('/categories', 'CategoryController@index'); //listado
	Route::get('/categories/create', 'CategoryController@create'); //form crear
	Route::post('/categories', 'CategoryController@store'); //grabar
	Route::get('/categories/{id}/edit', 'CategoryController@edit'); //form edicion
	Route::post('/categories/{id}/edit', 'CategoryController@update'); //actualizar
	Route::delete('/categories/{id}', 'CategoryController@destroy'); //form eliminar

});