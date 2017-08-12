<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'project_id', 'total',
	];

	public function project() {
		return $this->belongsTo('App\Project');
	}
}
