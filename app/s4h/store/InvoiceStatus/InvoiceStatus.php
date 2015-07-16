<?php namespace s4h\store\InvoiceStatus;
	
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\InvoiceStatusLang\InvoiceStatusLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;
/**
 * 
 */
 class InvoiceStatus extends BaseModel {
 	
 	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'invoice_status';

	protected $fillable = ['color'];
 	
 	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','invoice_status_lang','invoice_status_id','language_id')->withPivot('name','description');
	}

	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return InvoiceStatusLang::whereInvoiceStatusId($this->id)->whereLanguageId($language->id)->first();
	}

	public function getAccessorInCurrentLang($languageId = ''){
		return InvoiceStatusLang::whereInvoiceStatusId($this->id)->whereLanguageId($languageId)->first();
	}

	public function delete()
	{
		InvoiceStatusLang::where('invoice_status_id','=', $this->id)->delete();
		return parent::delete();
	}

 } 
