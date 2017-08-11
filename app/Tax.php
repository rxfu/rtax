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
		'project_name', 'project_id', 'lot_name', 'lot_type', 'specification_name', 'tax_name', 'unit', 'unit_price', 'total_amount', 'flag', 'completion_before', 'completion_after',
	];
}
