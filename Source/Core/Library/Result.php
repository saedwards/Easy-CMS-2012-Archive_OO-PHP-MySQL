<?php
    
	namespace Library;
	
    class Result
	{
        private $output;
        private $mysql;
        private $result;
        private $conId;
        
        public function __construct($mysql, $result, $conId)
        {
            $this->mysql = $mysql;
            $this->result = $result;
            $this->conId = $conId;
        }
        
        // FETCH ROW
        public function fetchRow()
        {
            return mysql_fetch_array($this->result, MYSQL_ASSOC);
        }
        
        // COUNT ROWS
        public function countRows()
		{
            if(!$rows = mysql_num_rows($this->result))
            {
                return false;
            }
            return $rows;
        }
        
        // COUNT AFFECTED ROW
        public function countAffectedRows()
        {
            if(!$rows = mysql_affected_rows($this->conId))
            {
                return 0;
            }
            return $rows;
        }
        
        // GET ID FROM THE LAST INSERTED ROW
        public function getInsertID()
        {
            if(($id = mysql_insert_id($this->conId)) == 0)
            {
                return '0';
            }
            if(!$id = mysql_insert_id($this->conId))
            {
                throw new Exception('Error getting ID');
            }
            return $id;
        }

        // SEEK ROW
        public function seekRow($row = 0)
        {
            if(!mysql_data_seek($this->result, $row))
            {
                throw new Exception('Error seeking data');
            }
        }
    }
?>