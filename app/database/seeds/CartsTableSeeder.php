<?php 

use s4h\store\Currencies\Currency;
use s4h\store\Carts\Cart;
use s4h\store\Users\User;

/**
* 
*/
class CartsTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $faker = $this->getFaker();

        $currencies = Currency::all()->toArray();

        $users = User::all()->toArray();

        $used = [];

        for ($i=0; $i < 4; $i++)
        { 

            //$currency = $faker->randomElement($currencies);

            $user = $faker->randomElement($users);

            if (!in_array($user["id"], $used))
            {
                Cart::create([
                    'user_id' => $user['id'],
                    //'currency_id' => $currency['id']
	                'active' => 0
                ]);
                $used[] = $user["id"];
            }
        }
	}

}