<?php

namespace App\Services;

use App\Repositories\PowerRepository;
use App\Lib\DiceLauncher;

class PowerService extends BaseService
{
    protected $diceLauncher;
    private $error;

    /**
     * Constructor
     * @method __construct
     * @param  PowerRepository $powerRepository [description]
     */
    public function __construct(PowerRepository $powerRepository) 
    {
        $this->repo = $powerRepository;
        $this->diceLauncher = new DiceLauncher();
    }

    /**
     * Create Power
     * @method create
     * @param  array $inputs [description]
     * @return [type]         [description]
     */
    public function create($inputs)
    {
    	$inputs['max_usage'] = $this->diceLauncher->rollDices("2D4");
    	return parent::create($inputs);
    }

    /**
     * check if the power name is unique
     * @method isPowerNameUnique
     * @param  string            $name      [description]
     * @param  int            $kraken_id [description]
     * @return boolean                      [description]
     */
    private function isPowerNameUnique($name, $kraken_id)
    {
    	$inputs = array('name' => $name, 'kraken_id' => $kraken_id);
    	$data = $this->repo->check($inputs);
    	return is_null($data);
    }

    /**
     * Is action requested can be processed
     * @method isActionValid
     * @param  array         $inputs [description]
     * @param  KrakenService        $kraken [description]
     * @return boolean               [description]
     */
    public function isActionValid(array $inputs, $kraken)
    {
    	if(!$kraken->isExist($inputs['kraken_id'])) {
    		$this->error = __('messages.kraken_not_found');
			return false;
		} 

		if(!$kraken->isAllowedToAddPower($inputs['kraken_id'])) {
			$this->error = __('messages.kraken_power_add_not_allowed');
			return false;
		}

		if(!$this->isPowerNameValid($inputs['name'])) {
			$this->error = __('messages.kraken_power_name_not_allowed');
			return false;
		}

		if(!$this->isPowerNameUnique($inputs['name'], $inputs['kraken_id'])) {
			$this->error = __('messages.kraken_power_name_not_unique');
			return false;
		}
		return true;
    }

    /**
     * Get error if action can't be processed
     * @method getError
     * @return [type]   [description]
     */
    public function getError()
    {
    	return $this->error;
    }

    /**
     * Check if the power name exists in the finite list of the power
     * @method isPowerNameValid
     * @param  $name           $name [description]
     * @return boolean                [description]
     */
    private function isPowerNameValid($name)
    {
    	return in_array(strtolower($name), config('kraken.powers'));
    }
}