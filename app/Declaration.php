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
		'section_id', 'tax_name', 'total', 'number', 'issue_time', 'name', 'pathname', 'ext', 'user_id', 'year',
	];

	public function section() {
		return $this->belongsTo('App\Section');
	}
}
