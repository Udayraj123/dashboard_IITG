<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Hostel extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	public $timestamps = true;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'hostels';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	function vendor($store_type="stationary"){
		return Vendor::where('store_type',$store_type)->where('hostel_id',$this->id)->first();
	}

}
