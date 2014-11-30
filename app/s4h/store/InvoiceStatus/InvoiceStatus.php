<?php namespace s4h\store\InvoiceStatus;
	
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\InvoiceStatusLang\InvoiceStatusLang;
/**
 * 
 */
 class InvoiceStatus extends Eloquent {
 	
 	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'invoice_status';

	protected $fillable = ['color'];
 	
 	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','invoice_status_lang','invoice_status_id','language_id')->withPivot('name','description');
	}

	public function delete()
	{
		InvoiceStatusLang::where('invoice_status_id','=', $this->id)->delete();
		return parent::delete();
	}

 } 
