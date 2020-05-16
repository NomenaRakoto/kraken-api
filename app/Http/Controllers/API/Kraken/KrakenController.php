<?php

namespace App\Http\Controllers\API\Kraken;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController as APIController;
use App\Services\KrakenService;
use App\Http\Requests\KrakenCreateRequest;
/**
 * Controller for kraken endpoint
*/
class KrakenController extends APIController
{
    protected $krakenService;

    /**
     * constructor
     * @method __construct
     * @param  KrakenService $krakenService [description]
     */
    public function __construct(KrakenService $krakenService)
	{
		$this->krakenService = $krakenService;
	}

	/**
	 * create a new kraken api
	 * @method create
	 * @param  KrakenCreateRequest $request [description]
	 * @return \Illuminate\Http\Response
	 */
	public function create(KrakenCreateRequest $request)
	{
		$kraken = $this->krakenService->create($request);
		return $this->sendResponse($kraken, __('messages.create_kraken_success'));
	}

	/**
	 * Get Kraken summary
	 * @method summary
	 * @return \Illuminate\Http\Response
	 */
	public function summary()
	{
		$kraken = $this->krakenService->all();
		return $this->sendResponse($kraken, __('messages.create_liste_success'));
	}
}
