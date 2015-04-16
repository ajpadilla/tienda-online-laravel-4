<?php 

use s4h\store\PaymentsTypes\PaymentsTypes;
use s4h\store\Users\User;
use s4h\store\CardBrands\CardBrands;
use s4h\store\PaymentCredentialDetails\PaymentCredentialDetails;

class PaymentCredentialDetailsTableSeeder extends DatabaseSeeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

		$paymentsTypes = PaymentsTypes::all()->toArray();
		$users = User::all()->toArray();
		$cardBrands = CardBrands::all()->toArray();

		for ($i=0; $i < 100; $i++)
		{
			$paymentType = $faker->randomElement($paymentsTypes);
			$user = $faker->randomElement($users);
			$cardBrand = $faker->randomElement($cardBrands);

			PaymentCredentialDetails::create([
				'email' => $user['email'],
				'credit_cart_number' => $faker->creditCardNumber,
				'credit_cart_security_number' => $faker->swiftBicNumber,
				'credit_cart_expire_date' => $faker->creditCardExpirationDate,
				'payments_types_id' => $paymentType['id'],
				'users_id' => $user['id'],
				'card_brands_id' =>$cardBrand['id'],
			]);
		}
	}
}