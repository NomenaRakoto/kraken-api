<?php 
namespace App\Repositories;
use App\Repositories\Traits\Relationable;
/**
 * Bass class for all repository
 */
abstract class Repository
{
	use Relationable;
	public $sortOrder = 'asc';

	/**
	 * Get all
	 * @method all
	 * @return [type] [description]
	 */
	public function all()
	{
	    return $this->model
	        ->with($this->relations)
	        ->get();
	}

    /**
     * Method definition for all repository to store a new data
     * @method store
     * @param  array  $inputs [description]
     * @return [type]       [description]
     */
    public function store(array $inputs)
    {
    	return $this->model->create($inputs);
    }

    /**
     * find by id
     * @method find
     * @param  int $id [description]
     * @return [type]     [description]
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * get one by id with relation
     * @method getWithRelation
     * @param  int          $id [description]
     * @return [type]              [description]
     */
    public function getWithRelation($id)
    {
    	return $this->model
        	->with($this->relations)
        	->find($id);
    }

    /**
	 * Delete 
	 * @method delete
	 * @param  int $id [description]
	 * @return null              [description]
	 */
	public function delete($id)
	{
		$obj = $this->model->find($id);
		if($obj) {
			$obj->delete();
		}
	}
}