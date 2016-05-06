<?php

	namespace Data\Fields;
	
	class Field
	{
		private $id;
		private $dataTable;
		private $fieldTypeLabel;
		private $value;
		private $version;
		
		public function __construct($id, $dataTable, $fieldTypeLabel, $value, $version)
		{
			$this->id = $id;
			$this->dataTable = $dataTable;
			$this->fieldTypeLabel = $fieldTypeLabel;
			$this->value = $value;
			$this->version = $version;
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function getDataTable()
		{
			return $this->dataTable;
		}
		
		public function getTypeLabel()
		{
			return $this->fieldTypeLabel;
		}
		
		public function getValue()
		{
			return $this->value;
		}
		
		public function getVersion()
		{
			return $this->version;
		}
	}

?>