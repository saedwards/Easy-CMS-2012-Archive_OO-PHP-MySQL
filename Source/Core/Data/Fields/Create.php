<?php

	namespace Data\Fields;
	require_once('Core/Data/Fields/Base.php');
	require_once('Core/System/Error.php');
	require_once('Core/System/ErrorHandler.php');
	use \System;
	
	class Create extends Base
	{
		private $field;
		private $itemGuid;
		private $itemFieldCatalogueID;
	
		public function __construct(\System\IScalarType $fieldType, $itemGuid)
		{
			$this->itemGuid = $itemGuid;
			if(!$this->validate($fieldType))
			{
				return false;
			}
			
			if($this->insertFieldToItemCatalogueReference())
			{
				$this->doInsert($fieldType);
			}
		}
		
		private function insertFieldToItemCatalogueReference()
		{
			$sql = 'INSERT INTO item_field_catalogue SET field_type_id=1, item_guid="'.$this->itemGuid.'"';
			
			if(!$this->itemFieldCatalogueID = $this->connection()->query($sql)->getInsertID())
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not add item to field reference in table item_field_catalogue.', 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			return true;
		}
		
		protected function validate($fieldType)
		{
			if(!$value = $fieldType->getData())
			{
				System\ErrorHandler::addError(new System\Error(
					'Value not set.', 
					'An error occured. Value not found',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			return true;
		}
		
		protected function doInsert($fieldType)
		{
			$sql = 
				'INSERT INTO '.$fieldType::DATA_TABLE.' SET item_field_catalogue_id='.$this->itemFieldCatalogueID.', value="'.$fieldType->getData().'", version=1';
			
			if(!$this->connection()->query($sql))
			{
				System\ErrorHandler::addError(new System\Error(
					'Unable to insert value into raw data table.', 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
			}
		}
	}

?>