<?php

	namespace Data\Layouts;
	include_once('Core/Data/Layouts/Base.php');

	class Create extends Layouts\Base
	{
		private $id = false;
		private $layout = false;
	
		public function __construct($label, $dir)
		{
			if($this->insert($label, $dir))
			{
				$this->buildLayout(array('id' => $this->id, 'label' => $label, 'directory' => $dir));
			}
		}
		
		private function insert($label, $dir)
		{
			$sql = '
				INSERT INTO layouts_templates SET 
				label="'.$label.'", 
				directory="'.$dir.'"';
				
			if(!$this->id = $this->connection()->query($sql))
			{
				System\ErrorHandler::addError(new System\Error(
					'Could not insert layout [SQL: '.mysql_error().']', 
					'An error occured. Could not create layout',
					__METHOD__, __FILE__, __LINE__));
				return false;
			}
			return true;
		}
		
		public function getLayout()
		{
			return $this->layout;
		}
	}

?>