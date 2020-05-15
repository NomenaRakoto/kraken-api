<?php

namespace App\Repositories;

use App\Tentacle;

/**
 * Class to manage kraken which implements repository interface
 */
class TentacleRepository extends Repository
{

    protected $model;
    /**
     * Constructor
     * @method __construct
     * @param  Tentacle    $tentacle [description]
     */
	public function __construct(Tentacle $tentacle)
	{
		$this->model = $tentacle;
	}
}