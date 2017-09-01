<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'building', 'building_number', 'roadbed_amount', 'road_amount', 'investment', 'kilometre', 'address', 'begtime', 'endtime', 'authority', 'bureau', 'finance', 'finance_phone', 'note',
	];

	public function sections() {
		return $this->hasMany('App\Section');
	}
}
