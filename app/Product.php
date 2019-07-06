<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Category;

class Product extends Model
{
    //$product->category
    //Permite saber que productos pertenecen a una categoria
    public function category()
    {
    	//Un producto pertenece a una categoria
    	return $this->belongsTo(Category::Class);
    }

    //$product->images
    public function images()
    {
    	return $this->hasMany(ProductImage::Class);
    }

    public function getFeaturedAttribute()
    {
        $featuredImage = $this->images()->where('featured', true)->first();
        if (!$featuredImage) {
            $featuredImage = $this->images()->first();
        }

        if ($featuredImage) {
            return $featuredImage->url;
        } 

        //Esta imagen se debe copiar en la carpeta
        return '/images/products/default.png';
        
    }

    public function getNcAttribute()
    {
        if ($this->category)
            return $this->category->name;

        return 'General';
    }
}
