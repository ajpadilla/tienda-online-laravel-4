<?php namespace s4h\store\Photos;

use s4h\store\Core\Upload;
use Eloquent;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductPhotos extends Eloquent {

	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'product_photos';

	private $upload;

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product');
	}

	public function user(){
		return $this->belongsTo('s4h\store\Users\User');
	}

	public function register(UploadedFile $file, $product_id, $userId)
	{
		$this->upload = new Upload($file);
		$this->upload->process();
		$this->complete_path = $this->upload->getCompletePublicFilePath();
		$this->complete_thumbnail_path = $this->upload->getCompleteThumbnailPublicFilePath();
		$this->fileName = $this->upload->getFileName();
		$this->path = $this->upload->getUploadPath();
		$this->extension = $this->upload->getFileExtension();
		$this->size = $this->upload->getSize();
		$this->mimetype = $this->upload->getMimeType();
		$this->user_id = $userId;
		$this->product_id = $product_id;
		$this->save();
	}
}