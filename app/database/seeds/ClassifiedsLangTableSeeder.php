<?php 

use s4h\store\Classifieds\Classified;
use	 s4h\store\Languages\Language;
use s4h\store\ClassifiedsLang\ClassifiedsLang;

/**
* 
*/
class ClassifiedsLangTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();
		
		$classifieds = Classified::all();
		$languages = Language::all();

		foreach ($classifieds as $classified) 
		{
			foreach ($languages as $language)
			{
				ClassifiedsLang::create([
					'name' => ucwords($faker->word),
					'description' => $faker->text,
					'address' => $faker->address,
					'classified_id' => $classified->id,
					'language_id' =>$language->id,
				]);
			}
		}
	}

}