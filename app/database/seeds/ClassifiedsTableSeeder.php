<?php 

use s4h\store\Classifieds\Classified;
use s4h\store\ClassifiedTypes\ClassifiedType;
use s4h\store\ClassifiedConditions\ClassifiedCondition;
use s4h\store\Users\User;
use s4h\store\Address\Address;

/**
* 
*/
class ClassifiedsTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$faker = $this->getFaker();

		$users = User::all()->toArray();
		$classifiedsTypes = ClassifiedType::all()->toArray();
		$classifiedsCondition = ClassifiedCondition::all()->toArray();
		$addressAll = Address::all()->toArray();

		for ($i=0; $i < 20; $i++) 
		{ 
			$user = $faker->randomElement($users);
			$classifiedType = $faker->randomElement($classifiedsTypes);
			$classifiedCondition = $faker->randomElement($classifiedsCondition);
			$address = $faker->randomElement($addressAll);

			Classified::create([
				'price' => $faker->randomFloat(20, 5, 100),
				'user_id' =>  $user['id'],
				'classified_type_id' =>  $classifiedType['id'],
				'classified_condition_id' => $classifiedCondition['id'],
				'address_id' => $address['id'],
				'active' => $faker->numberBetween(0,1),
				]);
		}
		

	}

}