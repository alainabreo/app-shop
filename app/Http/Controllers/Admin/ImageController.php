<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\productImage;
use File;

class ImageController extends Controller
{
    public function index($id)
    {
    	$product = Product::find($id);
    	//$images = $product->images;  //Devuelve las imagenes sin ordenar
    	$images = $product->images()->orderBy('featured', 'desc')->get();
    	return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id)
    {
    	//Guardar la imagen en el proyecto
    	$file = $request->file('photo');
    	$path = public_path() . '/images/products';
    	$fileName = uniqid() . $file->getClientOriginalName();
    	$moved = $file->move($path, $fileName);

    	//Crear un registro en la tabla product_images
    	if ($moved) {
	    	$productImage = new productImage();
	    	$productImage->image = $fileName;
	    	//$productImage->featured = false;
	    	$productImage->product_id = $id;
	    	$productImage->save(); //INSERT
	    }

    	return back();
    }

    public function destroy(Request $request, $id)
    {
    	$productImage = ProductImage::find($request->image_id);
    	if (substr($productImage->image, 0, 4) === "http") {
    		$deleted = true;
    	} else {
    		$fullPath = public_path() . '/images/products/' . $productImage->image;
    		$deleted = File::delete($fullPath);
    	}

    	if ($deleted) {
    		$productImage->delete();
    	}

    	return back();
    }

    public function select($id, $image)
    {
    	//Marca todas las destacadas como no destacadas
    	ProductImage::where('product_id', $id)->update([
    		'featured' => false
    	]);

    	//Destaca la que se manda a destacar
    	$productImage = ProductImage::find($image);
    	$productImage->featured = true;
    	$productImage->save();

    	return back();
    }
}
