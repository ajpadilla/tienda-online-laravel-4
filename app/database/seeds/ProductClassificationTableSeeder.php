<?php

use s4h\store\Products\Product;
use s4h\store\Categories\Category;
use s4h\store\ProductClassification\ProductClassification;
/**
* 
*/

class ProductClassificationTableSeeder extends DatabaseSeeder
{

 /**
   * Run the database seeds.
   *
   * @return void
  */
  public function run()
  {
    $faker = $this->getFaker();

    $categories   = Category::all()->toArray();

    $products = Product::all();

    foreach ($products as $product)
    {

      $used = [];
      for ($i = 0; $i < rand(1, 8); $i++)
      {

        $category = $faker->randomElement($categories);

        if (!in_array($category["id"], $used))
        {
          $id = $category["id"];
          ProductClassification::create([
            "category_id"   => $id,
            "product_id" => $product->id,
          ]);
          $used[] = $category["id"];
        }
      }
    }
  }

}