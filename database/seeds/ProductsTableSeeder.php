<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Primera Opción
        // factory(Category::class, 5)->create();
        // factory(Product::class, 100)->create();
        // factory(ProductImage::class, 200)->create();

        //Segunda Opción
        //Queremos que se creen 5 Categorias, 20 Productos por cada categoria y 5 fotos para cada producto
        $categories = factory(Category::class, 4)->create();
        $categories->each(function ($category) {
            $products = factory(Product::class, 5)->make();
            $category->products()->saveMany($products);
            $products->each(function($product) {
                $images = factory(ProductImage::class, 3)->make();
                $product->images()->saveMany($images);
            });
        });
        
    }
}
