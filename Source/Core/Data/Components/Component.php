<?php

	namespace Data\Components;
	require_once('Core/API/System/IGUID.php');
	use \System;

	class Component implements System\IGUID
	{
		private $details = array();
	
		public function __construct($guid, $parent, $layoutTemplateId, $productLayoutTemplateId, $version, $label = 'Not Specified', $componentLabel = 'Not Specified', $definition)
		{
			$this->details['guid'] = $guid;
			$this->details['parent'] = $parent;
			$this->details['layout_template_id'] = $layoutTemplateId;
			$this->details['product_layout_template_id'] = $productLayoutTemplateId;
			$this->details['version'] = $version;
			$this->details['label'] = $label;
			$this->details['component_label'] = $componentLabel;
			$this->details['definition'] = $definition;
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
		
		public function componentLabel()
		{
			return $this->details['component_label'];
		}
		
		public function definition()
		{
			return $this->details['definition'];
		}
	}

?>