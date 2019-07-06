<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
    	//$categories = Category::all();
    	$categories = Category::orderBy('id', 'asc')->paginate(10);
    	return view('admin.categories.index')->with(compact('categories')); //Listado de productos
    }

    public function create()
    {
    	return view('admin.categories.create'); //Cargar el formulario
    }

    public function store(Request $request)
    {
    	//Validar
    	$messages = [
    		'name.required' => 'Es necesario ingresar un nombre para la categoria',
    		'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
    		'description.required' => 'La descripción es un campo obligatorio',
    		'description.max' => 'La descripción solo admite hasta 200 caracteres'
    	];
    	$rules = [
    		'name' => 'required|min:3',
    		'description' => 'required|max:200'
    	];
    	$this->validate($request, $rules, $messages);


    	//Registra la nueva categoría en la BD
    	//dd($request->all());

    	// $category = new Category();
    	// $category->name = $request->input('name');
    	// $category->description = $request->input('description');
    	// $category->save();

    	//Método alternativo para tomar los parametros que vienen en el formulario y hacer la creación de la categoria en una sola linea
    	Category::create($request->all());

    	return redirect('/admin/categories');
    }

    // public function edit($id)
    // {
    // 	//return "El id que llega es $id";
    // 	$category = Category::find($id);
    // 	return view('admin.categories.edit')->with(compact('category'));
    // }

    // public function update(Request $request, $id)
    // {
    // 	//Validar
    // 	$messages = [
    // 		'name.required' => 'Es necesario ingresar un nombre para la categoria',
    // 		'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
    // 		'description.required' => 'La descripción es un campo obligatorio',
    // 		'description.max' => 'La descripción solo admite hasta 200 caracteres'
    // 	];
    // 	$rules = [
    // 		'name' => 'required|min:3',
    // 		'description' => 'required|max:200'
    // 	];
    // 	$this->validate($request, $rules, $messages);
    	
    // 	//Registra el nuevo producto en la BD
    // 	//dd($request->all());

    // 	$category = Category::find($id);
    // 	$category->name = $request->input('name');
    // 	$category->description = $request->input('description');
    // 	$category->save();

    // 	return redirect('/admin/categories');
    // }    

    //Otra opción de hacer el fin para edit
    //En web.php la ruta se debe enviar $category en vez de $id
	//Route::get('/categories/{category}/edit', 'CategoryController@edit'); //form edicion
	//Route::post('/categories/{category}/edit', 'CategoryController@update'); //actualizar

    public function edit(Category $category)
    {
    	return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request, Category $category)
    {
    	//Validar
    	//$rules y $messages están definidos en el modelo Category.php
    	$this->validate($request, Category::$rules, Category::$messages);
    	
    	//Registra el cambio en la BD
    	$category->update($request->all());

    	return redirect('/admin/categories');
    }    

    public function destroy(Category $category)
    {
    	//$category = Category::find($category);
    	$category->delete();

    	return redirect('/admin/categories');
    }    
}
