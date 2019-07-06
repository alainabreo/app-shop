<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Product;

class Category extends Model
{
	public static $messages = [
		'name.required' => 'Es necesario ingresar un nombre para la categoria',
		'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
		'description.required' => 'La descripción es un campo obligatorio',
		'description.max' => 'La descripción solo admite hasta 200 caracteres'
	];
	public static $rules = [
		'name' => 'required|min:3',
		'description' => 'required|max:200'
	];

	//Campos que pueden ser enviados en una carga masiva desde un formulario
	protected $fillable = ['name', 'description'];

    //$category->products
    //Permite saber que productos pertenecen a una categoria
    public function products()
    {
    	//Una categoria tiene muchos productos
    	return $this->hasMany(Product::Class);
    }

    public function getFeaturedAttribute()
    {
    	$featuredProduct = $this->products()->first();
    	return $featuredProduct->featured;
    }
        
}
