<?php

	namespace FunctionTests\System;
	require_once("Core/System/SearchTree.php");
	require_once("Core/FunctionTests/System/IFunctionTest.php");
	use \System;

	class SearchTree extends \System\SearchTree implements IFunctionTest
	{
		private $consoleBuffer;
		protected $selectFromTable = 'items';
		
		public function __construct()
		{
			$this->debug = true;
		}
		
		public function findAll($guid)
		{
			$this->buffer('<ul class="searchTree">');
			parent::findAll($guid);
			$this->buffer('</ul>');
		}
		
		protected function loop($results, $y)
		{
			$this->buffer('Amount of items '.count($results).'<br />');
			$this->buffer('Found items under '.$this->current_y_dir.' '.$this->current_x_dir.'<br />');
			parent::loop($results, $y);
		}
		
		protected function loopCheckCurrentItem()
		{
			$this->buffer('Seek depth x position: '.$this->current_x_dir.'<br />');
			return parent::loopCheckCurrentItem();
		}
		
		protected function seek()
		{
			$this->buffer('Check level down under item.<br />');
			parent::seek();
		}
		
		protected function loopCheckLevelDown()
		{
			$this->buffer('Test here: '.($this->current_y_dir+1).' 1<br />');
			return parent::loopCheckLevelDown();
		}
		
		protected function moveLevelDown()
		{
			$this->buffer('Checking under guid: '.$this->pending_dir_items[$this->current_y_dir+1][$this->current_x_dir]['guid'].'<br />');
			$this->buffer('<ul>');
			parent::moveLevelDown();
		}
		
		protected function loopCheckLevelUp()
		{
			$this->buffer('</ul>');
			$this->buffer('Check level up ['.$this->current_y_dir.']<br />');
			parent::loopCheckLevelUp();
		}
		
		protected function moveLevelUp()
		{
			$this->buffer('Didnt find next item. Going up again.<br />');
			parent::moveLevelUp();
		}
		
		protected function stop()
		{
			$this->buffer('Root level found. Stopping');
			parent::stop();
		}
		
		protected function removeLevel()
		{
			$this->buffer('Next item not found. Removing current level<br />');
			parent::removeLevel();
		}
		
		protected function addPendingDirs($sqlResultRow, $y, $x)
		{
			$this->buffer('<li class="searchTreeGuid">');
			parent::addPendingDirs($sqlResultRow, $y, $x);
			$this->buffer('Guid '.$sqlResultRow['guid'].' '.$sqlResultRow['label'].'<br />');
			$this->buffer('</li>');
		}
		
		public function buffer($string)
		{
			$this->consoleBuffer .= $string;
		}
		
		public function console()
		{
			return $this->consoleBuffer;
		}
		
		/*public function method($methodPath)
		{
			$array = explode('::', $methodPath);
			return $array[1];
		}*/
	}

?>