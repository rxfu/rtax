<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'building', 'constructor', 'investment', 'kilometre', 'address', 'begtime', 'endtime', 'authority', 'bureau', 'finance', 'finance_phone', 'bank', 'bank_name', 'bank_account', 'note',
	];
}
