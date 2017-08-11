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
		'project_id', 'amount', 'total', 'name', 'pathname', 'ext',
	];

	public function project() {
		return $this->belongsTo('App\Project');
	}
}
