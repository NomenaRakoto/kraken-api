<?php

namespace App\Repositories;

use App\Kraken;

/**
 * Class to manage kraken 
 */
class KrakenRepository extends Repository
{

    protected $model;

    /**
     * Constructor
     * @method __construct
     * @param  Kraken      $kraken [description]
     */
	public function __construct(Kraken $kraken)
	{
		$this->model = $kraken;
	}
}