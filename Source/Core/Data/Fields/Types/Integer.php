<?php

	namespace Data\Fields\Types;
	require_once("Core/System/ScalarTypes/Integer.php");
	use \System\ScalarTypes;

	class Integer extends ScalarTypes\Integer
	{
		public function __construct($value)
		{
			parent::__construct($value);
		}
	}

?>