<?php

namespace App\Services;

/**
 * Base class for all service
 */
abstract class BaseService
{
    protected $repo;

    /**
     * Create
     * @method create
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function create(array $input)
    {
        return $this->repo->store($input);
    }
}