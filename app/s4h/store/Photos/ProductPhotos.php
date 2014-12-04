<?php namespace s4h\store\Photos;

use s4h\store\Core\Upload;
use Eloquent;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductPhotos extends Eloquent {

	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'classified_photos';

	private $upload;

	public function classified(){
		return $this->belongsTo('s4h\store\Classifieds\Classified');
	}

	public function user(){
		return $this->belongsTo('s4h\store\Users\User');
	}

	public function register(UploadedFile $file, $classified_id, $userId)
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
		$this->classified_id = $classified_id;
		$this->save();
	}
}