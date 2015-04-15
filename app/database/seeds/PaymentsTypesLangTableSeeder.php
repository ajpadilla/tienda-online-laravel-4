<?php 

class PaymentsTypesLangTableSeeder extends DatabaseSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
		public function run()
	{
		$date = new DateTime;

		$payments_types_lang [] = array(
			'name' => 'Efectivo', 
			'payments_types_id' =>1,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'Cash',
			'payments_types_id' =>1,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$payments_types_lang [] = array(
			'name' => 'Tarjeta de credito', 
			'payments_types_id' =>2,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'Credit Card',
			'payments_types_id' =>2,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$payments_types_lang [] = array(
			'name' => 'PayPal', 
			'payments_types_id' =>3,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'PayPal',
			'payments_types_id' =>3,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$payments_types_lang [] = array(
			'name' => 'Cheque', 
			'payments_types_id' =>4,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'Cheque',
			'payments_types_id' =>4,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$payments_types_lang [] = array(
			'name' => 'Débito Directo', 
			'payments_types_id' =>5,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'Direct Debit',
			'payments_types_id' =>5,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$payments_types_lang [] = array(
			'name' => 'Orden Permanente', 
			'payments_types_id' =>6,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'Standing Order',
			'payments_types_id' =>6,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$payments_types_lang [] = array(
			'name' => 'Transferencia Bancaria', 
			'payments_types_id' =>7,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'Bank Transfer',
			'payments_types_id' =>7,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$payments_types_lang [] = array(
			'name' => 'Pagare', 
			'payments_types_id' =>8,
			'languages_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$payments_types_lang [] = array(
			'name' => 'Note Payable',
			'payments_types_id' =>8,
			'languages_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		// Uncomment the below to run the seeder
		DB::table('payments_types_lang')->insert($payments_types_lang);
	}
}
