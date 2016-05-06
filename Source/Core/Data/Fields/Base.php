<?php

	namespace Data\Fields;
	include_once('Core/System/Core.php');
	use \System;
	
	class Base extends System\Core
	{
		protected $allDataTablesSelect = '
			SELECT * FROM
			integers,
			strings,
			booleans,
			dates';
	}

?>