<?php

	namespace Data\Layouts;
	include_once('Core/Data/Layouts/Base.php');
	include_once('Core/System/ErrorHandler.php');
	include_once('Core/System/Error.php');
	use \System;

	class Get extends Base
	{
		private function retreiveLayout($id)
		{
			if(!$id)
			{
				return false;
			}
		
			$sql = $this->select.' 
				WHERE id='.$id;
				
			if(!$result = $this->connection()->query($sql)->fetchRow())
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not retreive layout [SQL: '.mysql_error().']', 
					'An error occured. Could not get layout',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			return $result;
		}
		
		private function retreiveAll()
		{
			$sql = $this->select;
			$result = $this->connection()->query($sql);
			
			if(count($sql) > 0)
			{
				$layouts = array();
				while($row = $result->fetchRow())
				{
					$layouts[] = $this->buildLayout($row);
				}
				return $layouts;
			}
			return false;
		}
		
		public function byId($id)
		{
			if($result = $this->retreiveLayout($id))
			{
				return $this->buildLayout($result);
			}
			return false;
		}
		
		public function all()
		{
			if($results = $this->retreiveAll())
			{
				return $results;
			}
			return false;
		}
	}

?>