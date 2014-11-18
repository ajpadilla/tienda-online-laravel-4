<?php namespace s4h\store\InvoiceStatus;
	
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
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

 } 
