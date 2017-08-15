<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Completion extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'project_id', 'completion_before', 'completion_after',
	];

	public $timestamps = false;

	public function project() {
		return $this->belongsTo('App\Project');
	}
}
