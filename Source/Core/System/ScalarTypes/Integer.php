<?php

	namespace System\ScalarTypes;
	require_once("Core/System/ScalarTypes/Base.php");
	require_once('Core/System/Error.php');
	require_once('Core/System/ErrorHandler.php');
	use \System;

	abstract class Integer extends Base
	{
		const DATA_TABLE = 'integers';
		
		public function __construct($value)
		{
			if(is_int($value))
			{
				$this->value = $value;
			}
			else
			{
				System\ErrorHandler::addError(new System\Error(
					'Value ('.$value.') is not an integer.', 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
			}
		}
	}

?>