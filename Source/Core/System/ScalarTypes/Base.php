<?php

	namespace System\ScalarTypes;
	require_once("Core/API/System/IScalarType.php");
	use \System;

	abstract class Base implements System\IScalarType
	{
		protected $value = false;
		
		public function getData()
		{
			return $this->value;
		}
	}

?>