<?php

	namespace System;
	
	interface IGUID
	{
		public function guid();
		public function label();
		public function parent();
		public function layoutTemplateId();
		public function version();
	}

?>