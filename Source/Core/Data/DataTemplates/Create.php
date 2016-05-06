<?php

	namespace Data\DataTemplates;
	require_once("Core/Data/DataTemplates/Base.php");
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
				$this->template = $this->buildTemplate(array('guid' => $this->guid, 'parent' => $parent, 'layout_template_id' => null, 'product_layout_template_id' => null,  'current_version' => 1, 'label' => $label, 'layout' => 1));
				$this->isCreated = true;
			}
		}
		
		private function insertFieldTypeToTemplateCatalogueReference($label, $fieldTypeId)
		{
			$sql = 'INSERT INTO data_template_field_type_catalogue SET label="'.$label.'", field_type_id="'.$fieldTypeId.'", data_template_guid="'.$this->guid.'", version=1';
			
			if(!$this->connection()->query($sql))
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not add field type reference to template [SQL: '.mysql_error().']', 
					'An error occured. Could not add field type to template',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			
			return true;
		}
		
		public function addFieldTypeReference($label, $fieldTypeId)
		{
			if($this->isCreated)
			{
				$this->insertFieldTypeToTemplateCatalogueReference($label, $fieldTypeId);
			}
			else
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not add field type to template. Template was not created.', 
					'An error occured. Not able to add field type to template.',
					__METHOD__, __FILE__, __LINE__));
			}
		}
		
		public function addComponent()
		{
			// TO IMPLEMENT
		}
	}

?>