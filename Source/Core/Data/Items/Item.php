<?php

	namespace Data\Items;
	require_once("Core/Data/Items/Base.php");
	require_once("Core/API/System/IGUID.php");
	use \System;

	class Item implements System\IGUID
	{
		private $details = array();
	
		public function __construct($guid, $parent, $version, $label = 'Not Specified', $layout = null)
		{
			$this->details['guid'] = $guid;
			$this->details['parent'] = $parent;
			$this->details['version'] = $version;
			$this->details['label'] = $label;
			$this->details['layout'] = $layout;
		}
		
		public function guid()
		{
			return $this->details['guid'];
		}
		
		public function label()
		{
			return $this->details['label'];
		}
		
		public function parent()
		{
			return $this->details['parent'];
		}
		
		public function version()
		{
			return $this->details['version'];
		}
		
		public function layoutTemplateId()
		{
			return $this->details['layout'];
		}
	}

?>