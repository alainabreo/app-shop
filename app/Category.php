<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Product;

class Category extends Model
{
    //$category->products
    //Permite saber que productos pertenecen a una categoria
    public function products()
    {
    	//Una categoria tiene muchos productos
    	return $this->hasMany(Product::Class);
    }
}
