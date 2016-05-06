<?php

	namespace Data\Layouts;
	include_once('Core/System/Core.php');
	include_once('Core/Data/Layouts/Layout.php');
	use \System;
	
	class Base extends System\Core
	{
		protected $layout = false;
		protected $select = 'SELECT id, label, directory FROM layout_templates';
	
		protected function buildLayout($details)
		{
			return new Layout($details['id'], $details['label'], $details['directory']);
		}
	}

?>