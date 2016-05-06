<?php

	require_once('Core/API/Data/Items/IGetDescendantsCallBack.php');
	use Data\Items;

	class ViewPageGetDescendantsCallback implements Items\IGetDescendantsCallback
	{
		private $elements = array();
		
		public function __construct($targetObject)
		{
			$this->elements['object'] = $targetObject;
			$this->elements['getItemClosure'] = false;
			$this->elements['upLevelClosure'] = false;
			$this->elements['downLevelClosure'] = false;
			$this->elements['nextItemClosure'] = false;
		}
		
		public function setGetItemClosure($method)
		{
			$this->elements['getItemClosure'] = $method;
		}
		
		public function setUpLevelClosure($method)
		{
			$this->elements['upLevelClosure'] = $method;
		}
		
		public function setDownLevelClosure($method)
		{
			$this->elements['downLevelClosure'] = $method;
		}
		
		public function setNextItemClosure($method)
		{
			$this->elements['nextItemClosure'] = $method;
		}
		
		public function getItemClosure()
		{
			return $this->elements['getItemClosure'];
		}
		
		public function upLevelClosure()
		{
			return $this->elements['upLevelClosure'];
		}
		
		public function downLevelClosure()
		{
			return $this->elements['downLevelClosure'];
		}
		
		public function nextItemClosure()
		{
			return $this->elements['nextItemClosure'];
		}
		
		public function object()
		{
			return $this->elements['object'];
		}
	}

?>