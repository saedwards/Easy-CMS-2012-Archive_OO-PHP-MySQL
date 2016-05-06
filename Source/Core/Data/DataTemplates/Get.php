<?php

	namespace Data\DataTemplates;
	require_once("Core/Data/DataTemplates/Base.php");
	
	class Get extends Base
	{
		private $parent = null;
		
		public function byGUID($guid)
		{
			$sql = $this->select.' WHERE current_version=(SELECT MAX(current_version) FROM data_templates) AND guid="'.$guid.'"';
			
			if($result = $this->findByGUID($sql))
			{
				return $this->buildTemplate($result);
			}
			return false;
		}
	}

?>