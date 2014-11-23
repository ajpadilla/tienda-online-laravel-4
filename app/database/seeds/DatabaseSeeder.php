<?php

class DatabaseSeeder extends Seeder {


	protected $faker;

	public function getFaker()
	{
		if (empty($this->faker))
		{
			$faker = Faker\Factory::create();
			$faker->addProvider(new Faker\Provider\Base($faker));
			$faker->addProvider(new Faker\Provider\Lorem($faker));
		}
		return $this->faker = $faker;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();

		 $this->call('LanguageTableSeeder');
		 $this->call('DiscountsTypesTableSeeder');
		 $this->call('DiscountsTypesLangTableSeeder');
	}

}
