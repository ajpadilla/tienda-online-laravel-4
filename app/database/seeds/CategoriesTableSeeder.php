<?php

use s4h\store\Categories\Category;

class CategoriesTableSeeder extends Seeder {

		/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
		public function run()
		{

			$date = new DateTime;

			$categories [] = array(
				'category_id' => NULL,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  

			$categories [] = array(
				'category_id' => 1,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  

			$categories [] = array(
				'category_id' => 1,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  
  

			$categories [] = array(
				'category_id' => 1,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  


			$categories [] = array(
				'category_id' => NULL,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  


			$categories [] = array(
				'category_id' => 2,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  
 

			$categories [] = array(
				'category_id' => 2,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  

			$categories [] = array(
				'category_id' => NULL,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  
 
			$categories [] = array(
				'category_id' => 3,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  

			$categories [] = array(
				'category_id' => 3,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  
 

			$categories [] = array(
				'category_id' => 3 ,
				'created_at' => $date->format('Y-m-d h:m:s'),
				'updated_at' => $date->format('Y-m-d h:m:s')             
			);  

			// Uncomment the below to run the seeder
			DB::table('categories')->insert($categories);
		}

	}
