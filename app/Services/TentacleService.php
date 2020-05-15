<?php

namespace App\Services;

use App\Repositories\TentacleRepository;
use App\Lib\DiceLauncher;

class TentacleService extends BaseService
{
    protected $diceLauncher;
    private $error;

    /**
     * Constructor
     * @method __construct
     * @param  TentacleRepository $tentacleRepository [description]
     */
    public function __construct(TentacleRepository $tentacleRepository) 
    {
        $this->repo = $tentacleRepository;
        $this->diceLauncher = new DiceLauncher();
    }

    /**
     * Create a new tentacle
     * @method create
     * @param  array $inputs [description]
     * @return [type]         [description]
     */
    public function create($inputs)
    {
        $inputs['point_de_vie'] = $this->diceLauncher->rollDices("6D6");
        //strength/dexterity/stamina at 2D3 + 10
        $inputs['strength'] = $this->diceLauncher->rollDices("2D3", 10);
        $inputs['dexterity'] = $this->diceLauncher->rollDices("2D3", 10);
        $inputs['stamina'] = $this->diceLauncher->rollDices("2D3", 10);
    	return parent::create($inputs);
    }

    /**
     * delete a kraken tentacle
     * @method delete
     * @param  int $tentacle_id [description]
     * @return [type]              [description]
     */
    public function delete($tentacle_id, $kraken)
    {
        $tentacle = $this->repo->find($tentacle_id);
        if($tentacle) {
           $this->repo->delete($tentacle_id);
           if(!$kraken->isPowerProportionnalTentacle($tentacle->kraken_id)) {
                $kraken->deleteLastPower($tentacle->kraken_id);
           } 
        }
        
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

		if(!$kraken->isAllowedToAddTentacle($inputs['kraken_id'])) {
			$this->error = __('messages.nb_max_tentacle_reached');
			return false;
		}
        return true;
    }

    /**
     * Is action requested can be processed
     * @method getError
     * @return [type]   [description]
     */
    public function getError()
    {
    	return $this->error;
    }
}