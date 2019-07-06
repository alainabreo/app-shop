<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
    	//$products = Product::all();
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); //Listado de productos
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
    	return view('admin.products.create')->with(compact('categories')); //Cargar el formulario
    }

    public function store(Request $request)
    {
    	//Validar
    	$messages = [
    		'name.required' => 'Es necesario ingresar un nombre para el producto',
    		'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
    		'description.required' => 'La descripción corta es un campo obligatorio',
    		'description.max' => 'La descripción corta solo admite hasta 200 caracteres',
    		'price.required' => 'Es obligatorio definir un precio',
    		'price.numeric' => 'Ingrese un precio válido',
    		'price.min' => 'El precio no admite valores negativos',
    	];
    	$rules = [
    		'name' => 'required|min:3',
    		'description' => 'required|max:200',
    		'price' => 'required|numeric|min:0'
    	];
    	$this->validate($request, $rules, $messages);


    	//Registra el nuevo producto en la BD
    	//dd($request->all());

    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
    	$product->price = $request->input('price');
    	$product->save();

    	return redirect('/admin/products');
    }

    public function edit($id)
    {
    	//return "El id que llega es $id";
    	$product = Product::find($id);
        $categories = Category::orderBy('name', 'asc')->get();
    	return view('admin.products.edit')->with(compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
    	//Validar
    	$messages = [
    		'name.required' => 'Es necesario ingresar un nombre para el producto',
    		'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
    		'description.required' => 'La descripción corta es un campo obligatorio',
    		'description.max' => 'La descripción corta solo admite hasta 200 caracteres',
    		'price.required' => 'Es obligatorio definir un precio',
    		'price.numeric' => 'Ingrese un precio válido',
    		'price.min' => 'El precio no admite valores negativos',
    	];
    	$rules = [
    		'name' => 'required|min:3',
    		'description' => 'required|max:200',
    		'price' => 'required|numeric|min:0'
    	];
    	$this->validate($request, $rules, $messages);
    	
    	//Registra el nuevo producto en la BD
    	//dd($request->all());

    	$product = Product::find($id);
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;        
    	$product->price = $request->input('price');
    	$product->save();

    	return redirect('/admin/products');
    }    

    public function destroy($id)
    {
    	$product = Product::find($id);
    	$product->delete();

    	return redirect('/admin/products');
    }    

}
