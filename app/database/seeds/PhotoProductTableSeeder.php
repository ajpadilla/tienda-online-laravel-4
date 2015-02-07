<?php 

use s4h\store\Products\Product;
use s4h\store\Photos\ProductPhotos;
/**
* 
*/
class PhotoProductTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

        $products = Product::all();

        foreach ($products as $product) 
        {
        	ProductPhotos::create([
        		'fileName' = upload->getFileName();
        		'path' = upload->getUploadPath();
        		'complete_path' = upload->getCompletePublicFilePath();
        		'complete_thumbnail_path' = upload->getCompleteThumbnailPublicFilePath();
        		'extension' = upload->getFileExtension();
        		'size' = upload->getSize();
        		'mimetype' = upload->getMimeType();
        		'user_id' = 1;
        		'product_id' = $product->id;
        	]);
        }
	}

}