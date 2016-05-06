<?php

	namespace System;
	
	interface IError
	{
		public function getDisplayError();
		public function getSystemError();
		public function getMethod();
		public function getFile();
		public function getLine();
	}

?>