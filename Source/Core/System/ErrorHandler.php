<?php

	namespace System;
	require_once("Core/System/CustomConsole.php");

	class ErrorHandler
	{
		static private $errors = array();
		static private $useConsole = true;
		static private $throwSQLExceptions = false;
		
		static public function addError(Error $error)
		{
			self::$errors[] = $error;
			
			// SHOULD BE SET IN CONFIG [COULD BE READ FROM RESOURCES]
			if(self::$useConsole)
			{
				CustomConsole::bufferError(self::lineFormat($error));
			}
		}
		
		static public function throwSQLException(Error $error)
		{
			if(self::$throwSQLExceptions)
			{
				throw new \Exception(self::lineFormat($error));
			}
			else
			{
				CustomConsole::bufferSQLException(self::lineFormat($error));
			}
		}
		
		static private function lineFormat($error)
		{
			return $error->getSystemError().' [CLASS METHOD: '.$error->getMethod().'] [FILE: '.$error->getFile().', LINE: '.$error->getLine().']';
		}
		
		static public function getErrors()
		{
			return self::$errors;
		}
	}

?>