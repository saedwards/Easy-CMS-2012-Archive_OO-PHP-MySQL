<?php

	namespace System\ScalarTypes;
	require_once("Core/System/ScalarTypes/Base.php");
	require_once('Core/System/Error.php');
	require_once('Core/System/ErrorHandler.php');
	use \System;

	abstract class String extends Base
	{
		const DATA_TABLE = 'strings';
		
		public function __construct($value)
		{
			if(is_string($value))
			{
				$this->value = $value;
			}
			else
			{
				System\ErrorHandler::addError(new System\Error(
					'Value ('.$value.') is not a string.', 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
			}
		}
	}

?>