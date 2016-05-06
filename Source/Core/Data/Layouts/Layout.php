<?php

	namespace Data\Layouts;
	
	class Layout
	{
		private $details = array();
	
		public function __construct($id, $label, $directory)
		{
			$this->details['id'] = $id;
			$this->details['label'] = $label;
			$this->details['directory'] = $directory;
		}
		
		public function id()
		{
			return $this->details['id'];
		}
		
		public function label()
		{
			return $this->details['label'];
		}
		
		public function directory()
		{
			return $this->details['directory'];
		}
	}

?>