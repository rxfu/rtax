<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category', 'flag', 'name', 'unit', 'rate',
	];

	public $timestamps = false;
}
