<?php 

 use s4h\store\Attributes\Attribute;
 use s4h\store\AttributeTypes\AttributeType;

/**
* 
*/
class AttributeTableSeeder extends DatabaseSeeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

		$attributesTypes = AttributeType::all()->toArray();

		for ($i=0; $i < 3; $i++) { 
			$attributeType = $faker->randomElement($attributesTypes);
			Attribute::create([
				"attribute_type_id" => $attributeType['id'] 
			]);
		}
	}
}