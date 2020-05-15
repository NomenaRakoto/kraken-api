<?php

namespace App\Http\Controllers\API\Kraken;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController as APIController;
use App\Services\PowerService;
use App\Services\KrakenService;
use App\Http\Requests\PowerAddRequest;

class PowerController extends APIController
{
    protected $powerService;

    /**
     * Constructor
     * @method __construct
     * @param  PowerService $powerService [description]
     */
    public function __construct(PowerService $powerService)
	{
		$this->powerService = $powerService;
	}
	
	/**
	 * add a power to a kraken
	 * @method add
	 * @param  PowerAddRequest $request [description]
	 * @param  KrakenService   $kraken  [description]
	 * @return \Illuminate\Http\Response
	 */
	public function add(PowerAddRequest $request, KrakenService $kraken)
	{
		if($this->powerService->isActionValid($request->all(), $kraken)) {
			$power = $this->powerService->create($request->all());
			return $this->sendResponse($power, __('messages.add_power_success_message'));
		} else {
			return $this->sendError(__("messages.unauthorised_action_error"), ['error' =>  $this->powerService->getError()], 403);
		}
	}
}
