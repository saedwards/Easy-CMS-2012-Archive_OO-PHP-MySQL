<?php

	namespace Data\Items;
	require_once("Core/Data/Items/Base.php");
	
	class GetRoot extends Base
	{
		private $items = array();
		
		public function all()
		{
			$this->retreiveAll();
			return $this->items;
		}
		
		public function allWithTemplate()
		{
			$this->retreiveAllWithTemplate();
			return $this->items;
		}
		
		public function allWithoutTemplate()
		{
			$this->retreiveAllWithoutTemplate();
			return $this->items;
		}
		
		private function retreiveAll()
		{
			$sql = $this->select.' 
				WHERE parent IS NULL';
			$this->checkQuery($this->connection()->query($sql));
		}
		
		private function retreiveAllWithTemplate()
		{
			$sql = $this->select.' 
				WHERE parent IS NULL
				AND data_template_guid IS NOT NULL';
			$this->checkQuery($this->connection()->query($sql));
		}
		
		private function retreiveAllWithoutTemplate()
		{
			$sql = $this->select.' 
				WHERE parent IS NULL
				AND data_template_guid IS NULL';
			$this->checkQuery($this->connection()->query($sql));
		}
		
		private function checkQuery($results)
		{
			if(($results->countRows()) > 0)
			{
				while($row = $results->fetchRow())
				{
					$this->items[] = $this->buildItem($row);
				}
				return true;
			}
			return false;
		}
	}

?>