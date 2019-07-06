<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class TestController extends Controller
{
	//Para productos
    // public function welcome()
    // {
    // 	//$products = Product::all();
    // 	$products = Product::paginate(9);
    // 	return view('welcome')->with(compact('products'));
    // }

    //Para Categorias
    public function welcome()
    {
    	//$categories = Category::all();
    	//$categories = Category::get();
    	//$categories = Category::paginate(9);
    	$categories = Category::has('products')->paginate(9);
    	return view('welcome')->with(compact('categories'));
    }

}
