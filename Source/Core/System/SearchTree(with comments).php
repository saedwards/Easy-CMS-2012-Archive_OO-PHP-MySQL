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
			
			// IF THERE ARE CHILD ITEMS ENTER LOOP
			if($results = $this->find($guid))
			{
				$this->loop($results, $this->current_y_dir+1);
				
				// SET FIRST DEPTH X POSITION
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
			
			echo '(Number of rows under '.($this->current_y_dir.$this->current_x_dir).' is '.$results->countRows().')';
			
			while($result = $results->fetchRow())
			{
				$this->addPendingDirs($result, $y, $x);
				$x++;
			}
		}
		
		protected function loopCheckCurrentItem()
		{
			// ASSIGN CURRENT X POSITION WITHIN CURRENT LEVEL
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
			echo '(Seeking)';
			if(!$this->loopCheckLevelDown())
			{
				if(!$this->loopCheckNextItem())
				{
					echo ' -About to go up a level from: '.$this->current_y_dir.''.$this->current_x_dir.'- ';
					$this->loopCheckLevelUp();
				}
			}
		}
		
		protected function loopCheckNextItem()
		{
			// CHECK NEXT X DIR
			echo '[Checking for next item '.$this->current_y_dir.($this->current_x_dir+1).']';
			if(isset($this->pending_dir_items[$this->current_y_dir][$this->current_x_dir+1]))
			{
				$this->moveToNext();
				echo '[Checking for children under next item: '.$this->current_y_dir.$this->current_x_dir.']';
				if(!$this->loopCheckCurrentItem())
				{
					$this->resetX = false;
					//return false;
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
			// CHECK NEXT Y DIR DOWN
			if($this->resetX)
			{
				echo '--Resetting X to 1--';
				$this->current_x_dir = 1;
			}
			
			if(isset($this->pending_dir_items[$this->current_y_dir+1][$this->current_x_dir]))
			{
				$this->moveLevelDown();
				echo '[Going down to: '.$this->current_y_dir.']';
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
		
		/*protected function seekUp()
		{
			if(!$this->loopCheckNextItem())
			{
				echo 'hmm';
				$this->loopCheckLevelUp();
				return;
			}
			$this->loopCheckLevelDown(true);
		}*/
		
		protected function loopCheckLevelUp()
		{
			$this->moveLevelUp();
			echo '[Going up to: '.$this->current_y_dir.']';
			if($this->current_y_dir == 0)
			{
				$this->stop();
				return false;
			}
			
			$this->current_x_dir = $this->seekDepthXPositions[$this->current_y_dir];
			
			echo '{{Seek level X adjust to '.$this->seekDepthXPositions[$this->current_y_dir].'}}';
			
			/*if(!$this->loopCheckNextItem())
			{*/
				$this->seek();
			//}
			
			
			/*if(isset($this->pending_dir_items[$this->current_y_dir][$this->seekDepthXPositions[$this->current_y_dir]+1]))
			{
				$this->current_x_dir = $this->seekDepthXPositions[$this->current_y_dir]+1;
				$this->seek();
			}*/
			
			
			
			// NEEDS REVISION!!!
			/*echo '(here2 '.$this->current_y_dir.')';
			if(!isset($this->pending_dir_items[$this->current_y_dir][$this->seekDepthXPositions[$this->current_y_dir]+1]))
			{
				$this->moveLevelUp();
				$this->loopCheckLevelUp();
				return;
			}
			
			echo '(here3 '.($this->seekDepthXPositions[$this->current_y_dir]+1).')';
			$this->current_x_dir = $this->seekDepthXPositions[$this->current_y_dir]+1;
			$this->loopCheckCurrentItem();
			$this->seek();
			return true;*/
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
			echo '(Remove level '.$this->current_y_dir.')';
			unset($this->seekDepthXPositions[$this->current_y_dir]);
			unset($this->pending_dir_items[$this->current_y_dir]);
		}
		
		protected function find($guid)
		{
			$sql = $this->select.$this->selectFromTable.'
				WHERE parent="'.$guid.'"';
				
			$results = $this->connection()->query($sql);

			//echo '--(GUID: '.$guid.' has '.$results->countRows().' items)--';

			if($results->countRows() > 0)
			{
				return $results;
			}
			return false;
		}
		
		protected function addPendingDirs($sqlResultRow, $y, $x)
		{
			// IF LEVEL DOESN'T EXIST CREATE NEW LEVEL
			if(!isset($this->pending_dir_items[$this->current_y_dir]))
			{
				$this->pending_dir_items[$this->current_y_dir] = array();
			}
			
			$this->pending_dir_items[$y][$x] = $sqlResultRow;
		}
	}

?>