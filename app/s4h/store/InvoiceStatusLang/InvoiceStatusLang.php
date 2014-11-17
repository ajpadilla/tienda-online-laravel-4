<?php namespace s4h\store\InvoiceStatusLang\;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class InvoiceStatusLang extends Eloquent{
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'invoice_status_lang';


}