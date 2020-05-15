<?php

namespace App\Services;

use App\Repositories\KrakenRepository;

class KrakenService extends BaseService
{
    /**
     * Constructor
     * @method __construct
     * @param  KrakenRepository $krakenRepository [description]
     */
    public function __construct(KrakenRepository $krakenRepository) 
    {
        $this->repo = $krakenRepository;
    }

    /**
     * check if it is possible to add a tentacle to a kraken
     * @method isAllowedToAddTentacle
     * @param  int                 $id [description]
     * @return boolean                    [description]
     */
    public function isAllowedToAddTentacle($id)
    {
        $this->repo->setRelations(['tentacles', 'powers']);
        $kraken = $this->repo->getWithRelation($id);
        return ($kraken->tentacles->count() < config("kraken.nb_max_tentacle"));
    }

    /**
     * Check if kraken nb power is proportionnal with his tentacle number
     * to respect the constraint 1 power for all 4 tentacle
     * @method isPowerProportionnalTentacle
     * @param  int                       $id [description]
     * @return boolean                          [description]
     */
    public function isPowerProportionnalTentacle($id)
    {
        $nbPowers = $this->getNbPowers($id);
        return $this->nbPowerAllowed($id) >= $nbPowers;
    }

    /**
     * get kraken's power number
     * @method getNbPowers
     * @param  int      $id [description]
     * @return int          [description]
     */
    private function getNbPowers($id)
    {
        $this->repo->setRelations(['powers']);
        return $this->repo->getWithRelation($id)->powers->count();
    }

    /**
     * get kraken's tentacle number
     * @method getNbTentacle
     * @param  int        $id [description]
     * @return int            [description]
     */
    private function getNbTentacle($id)
    {
        $this->repo->setRelations(['tentacles']);
        return $this->repo->getWithRelation($id)->tentacles->count();
    }

    /**
     * get nb power allowed for a kraken by his number of tentacle
     * @method nbPowerAllowed
     * @param  int         $id [description]
     * @return int             [description]
     */
    private function nbPowerAllowed($id)
    {
        $nbTentacles = $this->getNbTentacle($id);
        return (floor($nbTentacles / config("kraken.nb_tentacle_power")));
    }

    /**
     * Check if it is possible to add a power to a kraken
     * @method isAllowedToAddPower
     * @param  int            $id [description]
     * @return boolean                [description]
     */
    public function isAllowedToAddPower($id)
    {
        $nbPowers = $this->getNbPowers($id);
        return $this->nbPowerAllowed($id) > $nbPowers;
    }

    /**
     * check if the kraken exist
     * @method isExist
     * @param  int  $id [description]
     * @return boolean     [description]
     */
    public function isExist($id)
    {
        return !is_null($this->repo->find($id));
    }

    /**
     * get all krakens
     * @method all
     * @return [type] [description]
     */
    public function all()
    {
        $this->repo->setRelations(['tentacles', 'powers']);
        return $this->repo->all();
    }

    /**
     * delete the last power added
     * @method deleteLastPower
     * @return null/         [description]
     */
    public function deleteLastPower($id)
    {
        $this->repo->setRelations(['powers']);
        $powers = $this->repo->getWithRelation($id)->powers;
        $powers->last()->delete();
    }

    
}