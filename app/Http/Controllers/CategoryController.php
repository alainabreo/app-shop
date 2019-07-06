<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
    	//$products = $category->products;  //Sin paginar
    	$products = $category->products()->paginate(10); //Paginando
    	return view('categories.show')->with(compact('category', 'products'));
    }

}
