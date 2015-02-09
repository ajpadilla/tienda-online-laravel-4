<?php


use s4h\store\Products\Product;
use s4h\store\Carts\Cart;
use s4h\store\CartProduct\CartProduct;

/**
 *
 */
class CartProductTableSeeder extends DatabaseSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

		$products = Product::all()->toArray();

		$carts = Cart::all();

		$used = [];

		foreach ($carts as $cart) {

			$used = [];
			for ($i = 0; $i < rand(1, 3); $i++) {

				$product = $faker->randomElement($products);

				if (!in_array($product["id"], $used)) {
					CartProduct::create(["product_id" => $product["id"], "cart_id" => $cart->id,]);
					$used[] = $product["id"];
				}
			}
		}
	}

}