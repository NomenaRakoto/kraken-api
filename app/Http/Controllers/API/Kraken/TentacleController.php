<?php

namespace App\Http\Controllers\API\Kraken;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TentacleService;
use App\Services\KrakenService;
use App\Http\Requests\TentacleAddRequest;
use App\Http\Controllers\API\APIController as APIController;

/**
 * Controller for tentacle endpoints
 */
class TentacleController extends APIController
{
    protected $tentacleService;

    /**
     * Constructor
     * @method __construct
     * @param  TentacleService $tentacleService [description]
     */
    public function __construct(TentacleService $tentacleService)
	{
		$this->tentacleService = $tentacleService;
	}
	
	/**
	 * [add description]
	 * @method add
	 * @param  TentacleAddRequest $request [description]
	 * @param  KrakenService      $kraken  [description]
	 * @return \Illuminate\Http\Response
	 */
	public function add(TentacleAddRequest $request, KrakenService $kraken)
	{
		if($this->tentacleService->isActionValid($request, $kraken)) {
			$power = $this->tentacleService->create($request);
			return $this->sendResponse($power, __('messages.add_tentacle_success_message'));
		} else {
			return $this->sendError(__("messages.unauthorised_action_error"), ['error' =>  $this->tentacleService->getError()], 403);
		}
		
	}

	/**
	 * Delete a kraken tentacle
	 * @method delete
	 * @return \Illuminate\Http\Response
	*/
	public function delete($tentacle_id, KrakenService $kraken)
	{
		if(is_numeric($tentacle_id)) {
			$this->tentacleService->delete(intval($tentacle_id), $kraken);
			return $this->sendResponse(null, __('messages.delete_tentacle_success_message'));
		} else {
			return $this->sendError(__("messages.unauthorised_action_error"), ['error' =>   __('messages.delete_tentacle_error_message')], 403);
		} 
		
	}
}
