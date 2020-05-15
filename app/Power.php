<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Power extends Model
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
        'name', 'max_usage', 'kraken_id'
    ];

    /**
     * relation between kraken and powers (1:n)
     * @method kraken
     * @return array [description]
    */
    public function kraken() 
	{
	    return $this->belongsTo('App\Kraken');
	}
}
