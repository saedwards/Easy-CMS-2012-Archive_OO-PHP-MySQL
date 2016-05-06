<?php

	namespace Data\Items;
	require_once("Core/Data/Items/Base.php");
	
	class Get extends Base
	{
		private $parent = null;
		
		public function byGUID($guid)
		{
			$sql = $this->select.' WHERE guid="'.$guid.'"';
			
			if($result = $this->findByGUID($sql))
			{
				return $this->buildItem($result);
			}
			return false;
		}
		
		public function byPath()
		{
			// SEARCH FOR ITEM BY PATH
		}
	}

?>