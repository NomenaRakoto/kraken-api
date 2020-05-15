<?php

namespace App\Repositories\Traits;

trait Relationable
{
    public $relations = [];

    /**
     * set relations attribut
     * @method setRelations
     * @param  array       $relations [description]
     */
    public function setRelations($relations = null)
    {
        $this->relations = $relations;
    }
}