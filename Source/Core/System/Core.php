<?php

	namespace System;
	
	require_once('Core/Library/MySQL.php');
	require_once('../../CMS_config.php');
	use Library;

	abstract class Core
	{
		private $options;
		private $sql_connection = false;
		protected $debug = false;
		
		private function connect()
		{
		    $config = new Config();

		    // EXAMPLE Config:
            /*$config = (object) [
                'user' => 'username',
                'password' => 'password',
                'database' => 'example_database',
                'host' => 'localhost:1234',
            ];*/

            $this->sql_connection = new Library\MySQL($config->getConfig());
		}
		
		protected function connection()
		{
			if(!$this->sql_connection)
			{
				$this->connect();
			}
			return $this->sql_connection;
		}
	}

?>