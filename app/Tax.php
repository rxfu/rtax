<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'section_id', 'specification_name', 'tax_name', 'unit', 'unit_price', 'total_amount', 'flag', 'taxunit_before', 'taxamount_before', 'unittax_before', 'payabletax_before', 'completion_before', 'taxunit_after', 'taxamount_after', 'unittax_after', 'payabletax_after', 'completion_after', 'total', 'user_id', 'year',
	];

	public function section() {
		return $this->belongsTo('App\Section');
	}
}
