<?php

namespace FreightCostCalculator\Core\Helper;

class TokenHelper
{
	public static function generate($maxElements = 10)
	{
		$returnString = '';

		for ($i = 0; $i < $maxElements; $i++) {
			$returnString .= self::getRandomElement();
		}

		return $returnString;
	}

	public static function getRandomElement()
	{
		$elements = range('a','z') + range('0','9');

		return $elements[mt_rand(0, count($elements)-1)];
	}
}