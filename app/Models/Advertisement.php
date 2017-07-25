<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'user_id', 'uuid', 'title', 'description', 'tags', 'price', 'published_at', 'deleted_at'
	];
	public $timestamps = true;


	/* ------------------------
	 * 	Relationships
	 --------------------------*/

	/**
	 * Return User owner of the advertisement
	 */
	public function user()
	{
		return $this->belogsTo('App\Models\User');
	}

	/**
	 * Return the Pictures of this advertisement
	 */
	public function pictures()
	{
		return $this->hasMany('App\Models\Picture');
	}
}
