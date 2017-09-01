<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'project_name', 'building', 'building_number', 'roadbed_amount', 'road_amount', 'investment', 'kilometre', 'address', 'begtime', 'endtime', 'authority', 'bureau', 'finance', 'finance_phone', 'note',
	];
}
