<?php

namespace App\Repositories;

use App\Power;

/**
 * Class to manage Power
 */
class PowerRepository extends Repository
{

    protected $model;

    /**
     * Constructor
     * @method __construct
     * @param  Power      $power [description]
     */
	public function __construct(Power $power)
	{
		$this->model = $power;
	}

	/**
	 * check Power unique
	 * @method check
	 * @param  array  $data
	 * @return Power       [description]
	 */
	public function check(array $data)
	{
		$query = $this->model->where("name", $data['name'])->where('kraken_id', $data['kraken_id']);
		return $query->first();
	}
	

}