<?php
	
	namespace Library;
	require_once('Core/Library/Result.php');
	require_once('Core/System/Error.php');
	require_once('Core/System/ErrorHandler.php');
	use \System;

	class MySQL
	{
        private $conId;
        private $host;
        private $user;
		private $password;
        private $database;
		private $throwExceptions = false;
    
        public function __construct($options=array())
		{
            // VALIDARTE PARAMETERS
            if(count($options) < 4)
			{
				System\ErrorHandler::throwSQLException(new System\Error(
					'Invalid number of connection parameters', 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
            }
            foreach($options as $parameter => $value)
			{
                if(!$parameter || !$value)
				{
					System\ErrorHandler::throwSQLException(new System\Error(
						'Invalid connection parameters', 
						'An error occured.',
						__METHOD__, __FILE__, __LINE__));
                }
                $this->{$parameter} = $value;
            }
            // CONNECT TO MySQL
            $this->connectDB();
    
        }
    
        // CONNECT TO MYSQL AND SELECT DATABASE
        private function connectDB()
		{
            if(!$this->conId = mysql_connect($this->host, $this->user, $this->password))
			{
				System\ErrorHandler::throwSQLException(new System\Error(
					'Error connecting to the server', 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
				exit();
            }
            if(!mysql_select_db($this->database, $this->conId))
			{
				System\ErrorHandler::throwSQLException(new System\Error(
					'Error selecting database', 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
				exit();
            }
        }
    
        // PERFORM QUERY
        public function query($query)
		{
            if(!$this->result = mysql_query($query, $this->conId))
			{
				System\ErrorHandler::throwSQLException(new System\Error(
					'Error performing query '.$query.': '.mysql_error(), 
					'An error occured.',
					__METHOD__, __FILE__, __LINE__));
				return false;
            }
            // RETURN NEW OBJECT
            return new Result($this, $this->result, $this->conId);
        }
    }

?>