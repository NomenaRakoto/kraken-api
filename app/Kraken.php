<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kraken extends Model
{
	/**
	 * Disable model timestamps
	 * @var boolean
	 */
	public $timestamps = false;

    /**
     * The attributes that are mass assignable for a kraken.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'age', 'size','weight'
    ];

    /**
     * relation between kraken and tentacles (1:n)
     * @method tentacles
     * @return array [description]
    */
    public function tentacles() 
	{
	    return $this->hasMany('App\Tentacle');
	}

	/**
     * relation between krakens and powers (1:n)
     * @method powers
     * @return array [description]
    */
    public function powers()   
	{
	    return $this->hasMany('App\Power');
	}


}
