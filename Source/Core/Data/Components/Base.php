<?php

	namespace Data\Components;
	require_once('Core/Data/DataTemplates/Base.php');
	require_once("Core/Data/Components/Component.php");
	use Data\DataTemplates;
	use Data\Components;
	
	abstract class Base extends DataTemplates\Base
	{
		protected $component;
		
		protected function buildComponent($details)
		{
			return new Components\Component(
				$details['guid'], 
				$details['parent'], 
				$details['layout_template_id'], 
				$details['product_layout_template_id'], 
				$details['current_version'], 
				$details['label'], 
				$details['component_label'], 
				$details['definition']);
		}
		
		public function getComponent()
		{
			return $this->component;
		}
	}

?>