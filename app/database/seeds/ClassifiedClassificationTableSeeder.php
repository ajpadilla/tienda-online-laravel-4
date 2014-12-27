<?php

use s4h\store\Classifieds\Classified;
use s4h\store\Categories\Category;
use s4h\store\ClassifiedClassification\ClassifiedClassification;
/**
* 
*/

class ClassifiedClassificationTableSeeder extends DatabaseSeeder
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

    $classifieds = Classified::all();

    foreach ($classifieds as $classified)
    {

      $used = [];
      for ($i = 0; $i < rand(1, 8); $i++)
      {

        $category = $faker->randomElement($categories);

        if (!in_array($category["id"], $used))
        {
          $id = $category["id"];
          ClassifiedClassification::create([
            "category_id"   => $id,
            "classified_id  " => $classified->id,
          ]);
          $used[] = $category["id"];
        }
      }
    }
  }

}