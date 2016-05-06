<?php

	namespace System;
	require_once('Core/System/Core.php');
	require_once('Core/System/RandomData.php');

	class GUID extends Core
	{
		private $guid;
	
		public function __construct()
		{
			$this->uniqueGUID();
		}
		
		private function uniqueGUID()
		{
			$guid = $this->formulate();
			$sql = 'SELECT items.guid, data_templates.guid FROM items, data_templates WHERE items.guid="'.$guid.'" OR data_templates.guid="'.$guid.'"';
			
			if($this->connection()->query($sql)->fetchRow())
			{
				$this->uniqueGUID();
				return;
			}
			$this->guid = $guid;
			return;
		}
		
		private function formulate()
		{
			$data = new RandomData;
			$string = ($data->string(8, true).'-'
				.$data->string(4, true).'-'
				.$data->string(4, true).'-'
				.$data->string(4, true).'-'
				.$data->string(12, true));
		
			return $string;
		}
		
		public function get()
		{
			return $this->guid;
		}
	}
	
?>