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
		 Eloquent::unguard();

		 $this->call('LanguageTableSeeder');
		 $this->call('DiscountsTypesTableSeeder');
		 $this->call('DiscountsTypesLangTableSeeder');
		 $this->call('DiscountsTableSeeder');
		 $this->call('DiscountsLangTableSeeder');
		 $this->call('InvoiceStatusTableSeeder');
		 $this->call('InvoiceStatusLangTableSeeder');
		 $this->call('ShipmentStatusTableSeeder');
	     $this->call('ShipmentStatusLangTableSeeder');
	     $this->call('ClassifiedConditionsTableSeeder');
	     $this->call('ClassifiedConditionsLangTableSeeder');
	     $this->call('ClassifiedTypesTableSeeder');
	     $this->call('ClassifiedTypesLangTableSeeder');
	     $this->call('UserTableSeeder');
	     $this->call('ClassifiedsTableSeeder');
	}

}
