<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use SoftDeletes;

	protected $fillable = [
		'advertisement_id', 'file', 'active', 'deleted_at',
	];
	public $timestamps = true;

	/* ------------------------
	 * 	Relationships
	 ------------------------- */

	/**
	 * Return User owner of the advertisement
	 */
	public function advertisement()
	{
		return $this->belogsTo('App\Models\Advertisement');
	}
}
