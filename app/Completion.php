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
		'section_id', 'completion_before', 'completion_after', 'user_id',
	];

}
