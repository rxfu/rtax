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
		'name', 'note',
	];

	public $timestamps = false;

	public function sections() {
		return $this->hasMany('App\Section');
	}
}
