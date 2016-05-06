<?php

	namespace Data\Items;
	require_once('Core/Data/Items/Item.php');
	require_once('Core/System/SearchTree.php');
	use \System;

	class GetDescendants extends System\SearchTree
	{
		private $items = array();
		protected $select = 'SELECT guid, label, parent, current_version, layout_template_id FROM ';
		protected $selectFromTable = 'items';
		protected $callback = null;
		
		public function __construct($guid, $levels = false, \Data\Items\IGetDescendantsCallback $callback = null)
		{
			$this->callback = $callback;
			
			if(!$levels)
			{
				$this->findAll($guid);
			}
			else
			{
				$this->findUntilLevel($guid);
			}
		}
		
		protected function addChildItems($sqlResultRow)
		{
			// NEEDS DYNAMIC LEVELING
			$item = new Item($sqlResultRow['guid'], $sqlResultRow['parent'], $sqlResultRow['current_version'], 
				$sqlResultRow['label'], $sqlResultRow['layout_template_id']);
			
			$this->items[] = $item;
			
			if($this->checkCallBack('getItemClosure'))
			{
				$closure = $this->callback->getItemClosure();
				$closure($this->callback->object(), $item, $this->current_y_dir, $this->current_x_dir);
			}
		}
		
		protected function moveToNext()
		{
			parent::moveToNext();
			if($this->checkCallBack('nextItemClosure'))
			{
				//echo '{Next:'.$this->current_y_dir.$this->current_x_dir.'}';
				$closure = $this->callback->nextItemClosure();
				$closure($this->callback->object(), $this->current_y_dir, $this->current_x_dir);
			}
		}
		
		protected function moveLevelDown()
		{
			parent::moveLevelDown();
			if($this->checkCallBack('downLevelClosure'))
			{
				//echo '{Down:'.$this->current_y_dir.$this->current_x_dir.'}';
				$closure = $this->callback->downLevelClosure();
				$closure($this->callback->object(), $this->current_y_dir, $this->current_x_dir);
			}
		}
		
		protected function moveLevelUp()
		{
			parent::moveLevelUp();
			if($this->checkCallBack('upLevelClosure'))
			{
				//echo '{Up:'.$this->current_y_dir.$this->current_x_dir.'}';
				$closure = $this->callback->upLevelClosure();
				$closure($this->callback->object(), $this->current_y_dir, $this->current_x_dir);
			}
		}
		
		private function checkCallBack($method)
		{
			if(isset($this->callback))
			{
				if($this->callback->{$method}())
				{
					return true;
				}
			}
			return false;
		}
		
		protected function loopCheckCurrentItem()
		{
			$this->addChildItems($this->pending_dir_items[$this->current_y_dir][$this->current_x_dir]);
			return parent::loopCheckCurrentItem();
		}
		
		public function get()
		{
			return $this->items;
		}
	}

?>