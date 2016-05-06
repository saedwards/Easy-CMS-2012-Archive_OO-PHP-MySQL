<?php

	namespace Data\Composition;
	require_once('Core/Data/Composition/Base.php');
	require_once('Core/System/ErrorHandler.php');
	require_once('Core/System/Error.php');
	use \System;

	class Insert extends Base
	{
		private $targetObject = false;
		private $templateVariables = array();
		
		public function target(\System\IGUID $obj)
		{
			exit();
			$this->targetObject = $obj;
			$this->retreiveTemplateVariables();
		}
		
		public function add(\System\IGUID $obj, $templateVariable)
		{
			if(!$this->targetObject)
			{
				System\ErrorHandler::addError(new System\Error(
					'Unable to add has guid composition reference. Target object not set.', 
					'Target not specified.',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			
			if($obj->guid() == $this->targetObject->guid())
			{
				System\ErrorHandler::addError(new System\Error(
					'Cannot add guid reference to itself.', 
					'Cannot add an elemnt to itself.',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			
			$this->insertGUIDToHasGUIDReference($obj->guid(), $templateVariable);
			return true;
		}
		
		private function insertGUIDToHasGUIDReference($guid, $templateVariable)
		{
			if(!isset($this->templateVariables[$templateVariable]))
			{
				return false;
			}
		
			$sql = 'INSERT INTO insert_composition_catalogue SET 
				guid="'.$this->targetObject->guid().'", 
				has_guid="'.$guid.'", 
				layout_template_variable_variable="'.$templateVariable.'"';
			
			if(!$this->connection()->query($sql))
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not add object reference to target object '.$this->targetObject->guid(), 
					'Cannot add a object to target.',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			return true;
		}
		
		private function retreiveTemplateVariables()
		{
			$sql = 'SELECT variable FROM layout_template_variables WHERE layout_template_id="'.$this->targetObject->layoutTemplateId().'"';

			$result = $this->connection()->query($sql);
			
			while($row = $result->fetchRow())
			{
				$this->templateVariables[$row['variable']] = true;
			}
		}
		
		public function getLayoutTemplateVariables()
		{
			return $this->templateVariables;
		}
	}

?>