<?php 

use  s4h\store\DiscountsLang\DiscountLang;
use s4h\store\Discounts\Discount;
use	 s4h\store\Languages\Language;

/**
* 
*/
class DiscountsLangTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();
		
		$discounts = Discount::all();
		$languages = Language::all();

		foreach ($discounts as $discount) 
		{
			foreach ($languages as $language)
			{
				DiscountLang::create([
					'name' => ucwords($faker->word),
					'description' => $faker->text,
					'discount_id' => $discount->id,
					'language_id' =>$language->id,
				]);
			}
		}
	}

}