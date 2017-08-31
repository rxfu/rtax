<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'is_activated', 'description',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_activated' => 'boolean',
	];

	public $timestamps = false;

	public function users() {
		return $this->hasMany('App\User');
	}
}
