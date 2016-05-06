<?php

	namespace System;
	require_once("Core/API/System/IError.php");
	
	class Error implements IError
	{
		protected $systemError = false;
		protected $displayError = false;
		protected $method;
		protected $file;
		protected $line;
		
		public function __construct($systemError = null, $displayError = null, $method = null, $file = null, $line = null)
		{
			$this->systemError = $systemError;
			$this->displayError = $displayError;
			$this->method = $method;
			$this->file = $file;
			$this->line = $line;
		}
		
		public function getDisplayError()
		{
			return $this->displayError;
		}
		
		public function getSystemError()
		{
			return $this->systemError;
		}
		
		public function getMethod()
		{
			return $this->method;
		}
		
		public function getFile()
		{
			return $this->file;
		}
		
		public function getLine()
		{
			return $this->line;
		}
	}

?>