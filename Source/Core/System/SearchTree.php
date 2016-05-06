<?php

	namespace System;
	require_once("Core/System/Core.php");
	require_once("Core/Data/Items/Base.php");
	use Data\Items;
	use Library;
	
	abstract class SearchTree extends Core
	{
		// ARRAY OF ITEM OBJECTS
		protected $seekDepthXPositions = array(); // HOLDS THE CURRENT X NAVIGATION OF EACH LEVEL
		protected $seekDepthXPositionTotals = array();
		protected $current_x_dir = 0; // 1 IS THE FIRST ITEM OF THE ITEM GUID LEVEL
		protected $current_y_dir = 0; // 1 IS THE FIRST CHILD DIRECTORY LEVEL OF THE CONSTRUCT ITEM GUID
		protected $pending_dir_items = array();
		protected $finished = false;
		protected $select = false; // MUST HAVE VALUE
		protected $selectFromTable = false; // MUST HAVE A VALUE
		protected $resetX = true;
	
		public function findAll($guid)
		{
			$this->working = true;
			
			if($results = $this->find($guid))
			{
				$this->loop($results, $this->current_y_dir+1);
				
				$this->seekDepthXPositions[1] = 1;
				$this->seek();
			}
		}
		
		protected function findUntilLevel($guid)
		{
			// TO IMPLEMENT
		}
		
		protected function loop($results, $y)
		{
			$x = 1;
			
			while($result = $results->fetchRow())
			{
				$this->addPendingDirs($result, $y, $x);
				$x++;
			}
		}
		
		protected function loopCheckCurrentItem()
		{
			$this->seekDepthXPositions[$this->current_y_dir] = $this->current_x_dir;
			
			if($results = $this->find($this->pending_dir_items[$this->current_y_dir][$this->current_x_dir]['guid']))
			{
				$this->loop($results, $this->current_y_dir+1);
				return true;
			}
			return false;
		}
		
		protected function seek()
		{
			if(!$this->loopCheckLevelDown())
			{
				if(!$this->loopCheckNextItem())
				{
					$this->loopCheckLevelUp();
				}
			}
		}
		
		protected function loopCheckNextItem()
		{
			if(isset($this->pending_dir_items[$this->current_y_dir][$this->current_x_dir+1]))
			{
				$this->moveToNext();
				if(!$this->loopCheckCurrentItem())
				{
					$this->resetX = false;
				}
				$this->seek();
				return true;
			}
			return false;
		}
		
		protected function moveToNext()
		{
			$this->resetX = true;
			$this->current_x_dir++;
		}
		
		protected function loopCheckLevelDown()
		{
			if($this->resetX)
			{
				$this->current_x_dir = 1;
			}
			
			if(isset($this->pending_dir_items[$this->current_y_dir+1][$this->current_x_dir]))
			{
				$this->moveLevelDown();
				$this->seek();
				return true;
			}
			return false;
		}
		
		protected function moveLevelDown()
		{
			$this->current_y_dir++;
			$this->loopCheckCurrentItem();
		}
		
		protected function loopCheckLevelUp()
		{
			$this->moveLevelUp();
			if($this->current_y_dir == 0)
			{
				$this->stop();
				return false;
			}
			
			$this->current_x_dir = $this->seekDepthXPositions[$this->current_y_dir];
			$this->seek();
		}
		
		protected function moveLevelUp()
		{
			$this->resetX = false;
			$this->removeLevel();
			$this->current_y_dir--;
		}
		
		protected function stop()
		{
			$this->working = false;
		}
		
		protected function removeLevel()
		{
			unset($this->seekDepthXPositions[$this->current_y_dir]);
			unset($this->pending_dir_items[$this->current_y_dir]);
		}
		
		protected function find($guid)
		{
			$sql = $this->select.$this->selectFromTable.'
				WHERE parent="'.$guid.'"';
				
			$results = $this->connection()->query($sql);

			if($results->countRows() > 0)
			{
				return $results;
			}
			return false;
		}
		
		protected function addPendingDirs($sqlResultRow, $y, $x)
		{
			if(!isset($this->pending_dir_items[$this->current_y_dir]))
			{
				$this->pending_dir_items[$this->current_y_dir] = array();
			}
			
			$this->pending_dir_items[$y][$x] = $sqlResultRow;
		}
	}

?>