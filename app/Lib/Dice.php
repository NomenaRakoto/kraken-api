<?php

namespace App\Lib;

/**
 * class to represent a dice
*/
class Dice
{
	/**
	 * nb face of the dice
	 * @var [type]
	 */
    protected $nbFace;

    const MIN_DICE_FACE_VALUE = 1;
    /**
     * [__construct description]
     * @method __construct
     * @param  [type]      $nbFace [description]
     */
    public function __construct($nbFace)
	{
		$this->nbFace = intval($nbFace);
	}

	/**
	 * roll the dice to obtain a random number between 1 to nb face
	 * @method roll
	 * @return [type] [description]
	 */
	public function roll()
	{
		return rand(self::MIN_DICE_FACE_VALUE, $this->nbFace);
	}
}
