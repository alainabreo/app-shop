<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	//$productImage->product
	public function product()
    {
    	//Un producto pertenece a una categoria
    	return $this->belongsTo(Product::Class);
    }

    //Accesor url
    //Campo calculado
    public function getUrlAttribute()
    {
    	if (substr($this->image, 0, 4) === "http") {
    		return $this->image;
    	}

    	return '/images/products/' . $this->image;
    }
    
}
