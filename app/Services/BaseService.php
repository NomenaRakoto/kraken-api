<?php

namespace App\Services;
use Illuminate\Http\Request;
/**
 * Base class for all service
 */
abstract class BaseService
{
    protected $repo;

    /**
     * Create
     * @method create
     * @param  Request  $request [description]
     * @return [type]        [description]
     */
    public function create(Request $request)
    {
        return $this->repo->store($request->all());
    }
}