<?php namespace s4h\store\InvoiceStatusLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class InvoiceStatusLang extends Eloquent{
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'invoice_status_lang';

	public function invoiceStatus(){
		return $this->belongsTo('s4h\store\InvoiceStatus\InvoiceStatus','invoice_status_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}


}