<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	public $timestamps = true;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
	protected $fillable = ['productset_id','left','name','price','monthly_orders','vendor_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	function vendor(){
		return $this->belongsTo('Vendor');
	}

	function pp($fn){
		$pp = Productset::where('id',$this->productset_id)->first();
		if (!$pp || $fn=='')
			return [];
		else 
			return $pp->$fn();
	}

}
