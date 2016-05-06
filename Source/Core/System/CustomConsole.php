<?php

	namespace System;

	class CustomConsole
	{
		static private $consoleBuffer = '';
		static private $finishConsoleBuffer = '<div class="console">$_CONSOLE_CONTENT</div>';
	
		public static function buffer($string)
		{
			self::$consoleBuffer .= $string.'<br />';
		}
		
		public static function bufferError($string)
		{
			self::$consoleBuffer .= '<span class="errorLine">'.$string.'</span>';
		}
		
		public static function bufferSQLException($string)
		{
			self::$consoleBuffer .= '<span class="SQLexceptionLine">'.$string.'</span>';
		}
		
		public static function console()
		{
			return str_replace('$_CONSOLE_CONTENT', self::$consoleBuffer, self::$finishConsoleBuffer);
		}
		
		public function __destruct()
		{
			echo 'Destruct';
		}
	}

?>