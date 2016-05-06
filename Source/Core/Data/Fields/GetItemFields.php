<?php

	namespace Data\Fields;
	include_once('Core/Data/Fields/Base.php');
	include_once('Core/Data/Fields/Field.php');

	class GetItemFields extends Base
	{
		private $itemGuid;
		private $sqlResults;
		private $catalogueSelectFromWhere = '
			SELECT item_field_catalogue.id, field_type_id, item_guid, data_template_field_catalogue_id, 
				data_table, field_types.label
			FROM item_field_catalogue, field_types
			WHERE item_field_catalogue.field_type_id=field_types.id';

		private $fields = array();
	
		public function __construct($itemGuid)
		{
			$this->itemGuid = $itemGuid;
			
			if($this->retreive())
			{
				$this->findFields();
			}
		}
		
		private function retreive()
		{
			$sql = $this->catalogueSelectFromWhere.'
				AND item_guid='.$this->itemGuid;
				
			$results = $this->connection()->query($sql);
			
			if($results->countRows() > 0)
			{
				$this->sqlResults = $results;
				return true;
			}
			return false;
		}
		
		private function findFields()
		{
			while($row = $this->sqlResults->fetchRow())
			{
				$this->retreiveField($row['id'], $row['data_table'], $row['label']);
			}
		}
		
		private function retreiveField($id, $dataTable, $fieldTypeLabel)
		{
			$sql = '
				SELECT value, version FROM '.$dataTable.'
				WHERE item_field_catalogue_id='.$id;
				
			if($result = $this->connection()->query($sql)->fetchRow())
			{
				$this->fields[] = new Field($id, $dataTable, $fieldTypeLabel, $result['value'], $result['version']);
			}
		}
		
		public function getFields()
		{
			return $this->fields;
		}
	}

?>