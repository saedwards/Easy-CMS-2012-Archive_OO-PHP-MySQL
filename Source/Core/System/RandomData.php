<?php

	namespace System;
	
	class RandomData
	{
		private $alphaCharacters = 'abcdefghijklmnopqrstuvwxyz';
		private $numericCharacters = '0123456789';
	
		public function string($length, $withNumbers = null)
		{
			$string = '';
			$sequence = $this->alphaCharacters;
			if($withNumbers)
			{
				$sequence .= $this->numericCharacters;
			}
			$charLength = strlen($sequence)-1;
			for ($p = 0; $p < $length; $p++)
			{
				$string .= $sequence[mt_rand(0, $charLength)];
			}
			return $string;
		}
		
		public function integer()
		{
			return 'Not yet implemented';
		}
	}

?>