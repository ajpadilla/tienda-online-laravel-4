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

		 $this->call('CountriesTableSeeder');
	     $this->call('CountriesLangTableSeeder');
	     $this->call('StatesTableSeeder');
	     $this->call('CitiesTableSeeder');
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
	     $this->call('ClassifiedsLangTableSeeder');
	     $this->call('ProductConditionTableSeeder');
	     $this->call('ProductConditionsLangTableSeeder');
	     $this->call('WeightTableSeeder');
	     $this->call('WeightLangTableSeeder');
	     $this->call('MeasureTableSeeder');
	     $this->call('MeasureLangTableSeeder');
	     $this->call('CategoriesTableSeeder');
	     $this->call('CategoriesLangTableSeeder');
	     $this->call('ProductTableSeeder');
	     $this->call('ProductosLangTableSeeder');
	     $this->call('ProductClassificationTableSeeder');
	     $this->call('RatingsTableSeeder');
	     $this->call('AttributeTypeTableSeeder');
	     $this->call('AttributeTypeLangTableSeeder');
	     $this->call('AttributeTableSeeder');
	     $this->call('AttributeLangTableSeeder');
	     $this->call('AttributeByProductTableSeeder');
	     $this->call('AttributeValueTableSeeder');
	     $this->call('AttributeValueLangTableSeeder');
	     $this->call('AttributeByValueTableSeeder');
	     $this->call('ClassifiedClassificationTableSeeder');
	}

}
