<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
	protected $fillable = [
		'street',
		'city',
		'state',
		'country',
		'zip',
		'price',
		'description'
		];

	public function getPriceAttribute($price)
	{
		return '$' . number_format($price);
	}

	public static function locatedAt($zip, $street)
	{
		$street = str_replace('-', ' ', $street);
        return static::where(compact('zip', 'street'))->firstOrFail();
	}

	public function addPhoto(Photo $photo)
	{
		return $this->photos()->save($photo);
	}


	/**
	 * A flyer is composed of many photos
	 */
    public function photos()
    {
    	return $this->hasMany('App\Photo');
    }

    /**
     * A flyer is owned by a user
     */

    public function ownedBy(User $user)
    {
    	return $this->user_id == $user->id;
    }

    /**
     * Determine if the given user created the flyer
     */
    public function owner()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
