<?php

	namespace Data\DataTemplates;
	require_once("Core/System/GUIDBase.php");
	require_once("Core/Data/DataTemplates/Template.php");
	include_once('Core/System/ErrorHandler.php');
	include_once('Core/System/Error.php');
	use \System;

	abstract class Base extends \System\GUIDBase
	{
		protected $template;
		protected $select = 'SELECT guid, label, parent, layout_template_id, product_layout_template_id, current_version FROM data_templates';
		
		protected function buildTemplate($details)
		{
			return new Template(
				$details['guid'], 
				$details['parent'], 
				$details['layout_template_id'], 
				$details['product_layout_template_id'], 
				$details['current_version'], 
				$details['label']);
		}
		
		protected function insertTemplate($label)
		{
			$sql = 'INSERT INTO data_templates SET guid="'.$this->guid.'", label="'.$label.'", current_version=1';
			
			if(!$this->connection()->query($sql))
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not create template [SQL: '.mysql_error().']', 
					'An error occured. Could not create item',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			
			return true;
		}
		
		public function getTemplate()
		{
			return $this->template;
		}
		
		protected function failedOperationRemoveTemplate()
		{
			if($this->guid)
			{
				$sql = 'DELETE FROM data_templates WHERE guid="'.$this->guid.'"';
				$this->connection()->query($sql);
			}
		}
	}

?>