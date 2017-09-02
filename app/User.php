<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'password', 'department_id', 'name', 'phone', 'is_admin',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_admin' => 'boolean',
	];

	/**
	 * Set the user's password.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setPasswordAttribute($value) {
		$this->attributes['password'] = bcrypt($value);
	}

	public function department() {
		return $this->belongsTo('App\Department');
	}

	public function completions() {
		return $this->hasMany('App\Completion');
	}
}
