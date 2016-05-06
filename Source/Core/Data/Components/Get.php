<?php

	namespace Data\Components;
	require_once('Core/Data/DataTemplates/');
	use Data\DataTemplates;
	
	class Get extends DataTemplates\Get
	{
		protected $select = 'SELECT guid, label, parent, current_version FROM data_templates';
	}

?>