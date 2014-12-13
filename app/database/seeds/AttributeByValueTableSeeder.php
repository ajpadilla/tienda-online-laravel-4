<?php
	
use s4h\store\AttributesByProducts\AttributeByProduct;
use s4h\store\AttributesValues\AttributeValue;
use s4h\store\AttributesByValues\AttributeByValue;

 /**
 * 
 */
 class AttributeByValueTableSeeder extends DatabaseSeeder
 {
 	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$attributesByProducts = AttributeByProduct::all();

		$attributesValues = AttributeValue::all();

		foreach ($attributesByProducts as $attributeByProduct) {
			foreach ($attributesValues as $attributeValue) {
				AttributeByValue::create([
					"attribute_by_product_id" => $attributeByProduct->id,
					"attribute_value_id" => $attributeValue->id 
				]);
			}
		}
	}
 }