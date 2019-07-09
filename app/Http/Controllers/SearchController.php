<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class SearchController extends Controller
{
    public function show(Request $request)
    {
    	//input() el campo que tiene como nombre query
    	$query = $request->input('query');
    	//$products = Product::where('name', $query)->get();
    	//$products = Product::where('name', 'like', '%$query%')->get();
    	$products = Product::where('name', 'like', "%$query%")->paginate(9);

    	if ($products->count() == 1) {
    		$id = $products->first()->id;
    		return redirect("products/$id"); // 'products/'.$id
    	}

    	return view('search.show')->with(compact('products', 'query'));
    }

    public function data()
    {
    	$products = Product::pluck('name');
    	return $products;
    }
}
