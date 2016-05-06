<?php

	namespace System;
	require_once("Core/System/Core.php");
	
	class GUIDBase extends \System\Core
	{
		private $select;
	
		private function checkQuery($query)
		{
			if($result = $query->fetchRow())
			{
				return $result;
			}
			return false;
		}
		
		protected function findByGUID($sql)
		{
			return $this->checkQuery($this->connection()->query($sql));
		}
	}

?>