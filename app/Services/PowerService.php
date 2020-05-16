<?php

namespace App\Services;

use App\Repositories\PowerRepository;
use App\Lib\DiceLauncher;
use App\Http\Requests\PowerAddRequest;
use Illuminate\Http\Request;

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
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request)
    {
        $inputs = $request->all();
    	$inputs['max_usage'] = $this->diceLauncher->rollDices("2D4");
        return $this->repo->store($inputs);
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
     * @param  PowerAddRequest      $request [description]
     * @param  KrakenService        $kraken [description]
     * @return boolean               [description]
     */
    public function isActionValid(PowerAddRequest $request, $kraken)
    {
        $inputs = $request->all();
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