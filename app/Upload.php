<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['picture_name', 'created_at'];


}
