<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tentacle extends Model
{
	/**
	 * Disable model timestamps
	 * @var boolean
	 */
	public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'name', 'point_de_vie', 'dexterity', 'stamina', 'strength', 'kraken_id'
    ];

    /**
     * relation between kraken and tentacles (1:n)
     * @method kraken
     * @return array [description]
    */
    public function kraken() 
	{
	    return $this->belongsTo('App\Kraken');
	}
}
