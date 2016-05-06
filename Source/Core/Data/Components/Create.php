<?php

	namespace Data\Components;
	require_once('Core/Data/Components/Base.php');
	require_once('Core/System/GUID.php');
	use \System;

	class Create extends Base
	{
		protected $guid;
		private $isCreated;
		
		public function __construct($label, $parent = null)
		{
			$guidGenerater = new System\GUID();
			$this->guid = $guidGenerater->get();
			
			if($this->insertTemplate($label))
			{
				if($this->insertComponentToTemplateReference())
				{
					$this->component = $this->buildComponent(array(
						'guid' => $this->guid, 
						'parent' => $parent, 
						'layout_template_id' => null, 
						'product_layout_template_id' => null,
						'current_version' => 1, 
						'label' => $label, 
						'component_label' => 'Select Box', 
						'definition' => 'SelectField'));
				}
				else
				{
					$this->failedOperationRemoveTemplate();
				}
			}
		}
		
		private function insertComponentToTemplateReference()
		{
			$sql = 'INSERT INTO components_data_templates_catalogue SET data_template_guid="'.$this->guid.'", component_type_id=1';
			
			if($this->connection()->query($sql))
			{
				return true;
			}
			return false;
		}
	}

?>