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
		'project_id', 'type_id', 'name', 'building', 'constructor', 'investment', 'kilometre', 'address', 'begtime', 'endtime', 'authority', 'bureau', 'finance', 'finance_phone', 'bank', 'bank_name', 'bank_account', 'note',
	];

	public function project() {
		return $this->belongsTo('App\Project');
	}

	public function type() {
		return $this->belongsTo('App\Type');
	}

	public function completion() {
		return $this->hasOne('App\Completion');
	}
}
