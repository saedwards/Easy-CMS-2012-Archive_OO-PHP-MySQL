<?php

	namespace Data\DataTemplates;
	require_once('Core/API/System/IGUID.php');
	use \System;
	
	class Template implements System\IGUID
	{
		private $details = array();
	
		public function __construct($guid, $parent, $layoutTemplate, $productLayoutTemplateId, $version, $label = 'Not Specified')
		{
			$this->details['guid'] = $guid;
			$this->details['parent'] = $parent;
			$this->details['layout_template_id'] = $layoutTemplate;
			$this->details['product_layout_template_id'] = $productLayoutTemplateId;
			$this->details['version'] = $version;
			$this->details['label'] = $label;
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
		
		public function layoutTemplateId()
		{
			return $this->details['layout_template_id'];
		}
		
		public function productLayoutTemplateId()
		{
			return $this->details['product_layout_template_id'];
		}
		
		public function version()
		{
			return $this->details['version'];
		}
	}

?>