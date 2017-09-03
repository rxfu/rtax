<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paid extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'section_id', 'tax_name', 'unit', 'amount', 'total', 'issue_time', 'authority', 'sale', 'name', 'pathname', 'ext', 'user_id', 'year',
	];

	public function section() {
		return $this->belongsTo('App\Section');
	}
}
