<?php 

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class ShipmentStatus extends Eloquent {

	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'shipment_status';

	protected $fillable = ['color'];

}