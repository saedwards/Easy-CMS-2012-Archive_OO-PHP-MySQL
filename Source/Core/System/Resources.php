<?php

	/**
	* RESOURCES TO LOAD IN CUSTOM REFERENCES FOR THE API SUCH AS NON-SECURE PATHS 
	*
	* DO NOT INCLUDE SECURE INFORMATION SUCH AS MYSQL OR LOGIN INFORMATION.
	*/
	
	class Resources
	{
		static private $paths = array();
		static private $root = 'http://localhost:8888/CMS/Website/';
		//static private $root = 'http://127.0.0.1/~shaneedwards/CMS/Website/';
		static private $isSetup = false;
		
		static private function setup()
		{
			/**
			* PARSE CONFIG FILE NODES?
			*
			* OR READ DATABASE FOR CUSTOM SETUP?
			*/
			//$this->paths[] = 'Core/Data/Fields/Types/String.php'; // TEST CLASS, WILL NEED TO REMOVE
		}
		
		static private function check()
		{
			if(!self::$isSetup)
			{
				self::setup();
				self::$isSetup = true;
			}
		}
		
		static public function getPaths()
		{
			self::check();
			return self::$paths;
		}
		
		static public function getRoot()
		{
			self::check();
			return self::$root;
		}
	}
	
	foreach(Resources::getPaths() as $path)
	{
		require_once($path);
	}
	
?>