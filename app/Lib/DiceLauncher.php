<?php

namespace App\Lib;

/**
 * class to represent a dice
*/
class DiceLauncher
{
	/**
	 * extract nb dice from an expression (6D6,2D4,...)
	 * @method nbDiceFromExpression
	 * @param  string               $expr [description]
	 * @return int                     [description]
	 */
	private function nbDiceFromExpression($expr)
	{
		$infos = explode('D', strtoupper($expr));
		if(!empty($infos[0])) {
			return intval($infos[0]);
		}

		return 1;//one dice ex : D6 -> 1 dice with six faces
	}

	/**
	 * extract dice nb face from expression
	 * @method nbFaceFromExpression
	 * @param  string               $expr expression of the form (2D6,2D4)
	 * @return int                  [description]
	 */
	private function nbFaceFromExpression($expr)
	{
		$infos = explode('D', strtoupper($expr));
		return intval($infos[1]);
	}

	/**
	 * roll all dices
	 * @method rollDices
	 * @param  integer   $modifier modifier to add with the result
	 * @return int                 random number
	 */
	public function rollDices($expr, $modifier = 0)
	{
		$nbDice = $this->nbDiceFromExpression($expr);
		$nbFace = $this->nbFaceFromExpression($expr);

		$result = 0;
		for ($i=0; $i < $nbDice; $i++) { 
			$result += (new Dice($nbFace))->roll();
		}

		return $result + $modifier;
	}
}
