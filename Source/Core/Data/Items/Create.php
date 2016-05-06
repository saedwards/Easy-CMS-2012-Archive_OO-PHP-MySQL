<?php

	namespace Data\Items;
	require_once('Core/Data/Items/Base.php');
	require_once('Core/Data/Fields/Create.php');
	require_once('Core/System/GUID.php');
	use API\Field;
	use \System;
	use API\ValidationTypes;

	class Create extends Base
	{
		private $guid;
		private $complete = false;
	
		public function __construct($label, $parent = null)
		{
			$guidGenerater = new System\GUID();
			$this->guid = $guidGenerater->get();
			
			if($this->insertItem($label))
			{
				$this->item = $this->buildItem(array('guid' => $this->guid, 'parent' => $parent, 'current_version' => 1, 'label' => $label, 'layout_template_id' => 1));
				$this->complete = true;
			}
		}
		
		private function insertItem($label)
		{
			$sql = 'INSERT INTO items SET guid="'.$this->guid.'", label="'.$label.'", current_version=1';

			if(!$this->connection()->query($sql))
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not insert item [SQL: '.mysql_error().']', 
					'An error occured. Could not create item.',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			
			return true;
		}
		
		public function addField(\System\IScalarType $field)
		{
			if($this->complete)
			{
				new \Data\Fields\Create($field, $this->guid);
			}
			else
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not add field to item. Item was not created.', 
					'An error occured. Item not found.',
					__METHOD__, __FILE__, __LINE__));
			}
		}
	}

?>