<?php 

 use s4h\store\DiscountTypesLang\DiscountTypeLang;
/**
* 
*/
class DiscountsTypesLangTableSeeder extends DatabaseSeeder{
	
	


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

		$discountTypeLang [] = array(
			'name' => 'Navidad', 
			'discount_type_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$discountTypeLang [] = array(
			'name' => 'christmas',
			'discount_type_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$discountTypeLang [] = array(
			'name' => 'Viernes Barato', 
			'discount_type_id' =>2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$discountTypeLang [] = array(
			'name' => 'Friday Cheap',
			'discount_type_id' =>2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$discountTypeLang [] = array(
			'name' => 'Producto en Remate', 
			'discount_type_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$discountTypeLang [] = array(
			'name' => 'Product Foreclosure',
			'discount_type_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$discountTypeLang [] = array(
			'name' => 'Día de Bonanza', 
			'discount_type_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$discountTypeLang [] = array(
			'name' => 'Day Bonanza',
			'discount_type_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$discountTypeLang [] = array(
			'name' => 'Tu Producto Fácil', 
			'discount_type_id' =>5,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$discountTypeLang [] = array(
			'name' => 'Your Easy Product',
			'discount_type_id' =>5,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		// Uncomment the below to run the seeder
		DB::table('discount_types_lang')->insert($discountTypeLang);
	}

}