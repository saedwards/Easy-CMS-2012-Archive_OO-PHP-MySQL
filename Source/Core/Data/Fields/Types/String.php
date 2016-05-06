<?php

	namespace Data\Fields\Types;
	require_once("Core/System/ScalarTypes/String.php");
	use \System\ScalarTypes;

	class String extends ScalarTypes\String
	{
		public function __construct($value)
		{
			parent::__construct($value);
		}
	}

?>