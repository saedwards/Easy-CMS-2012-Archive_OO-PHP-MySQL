<?php

	namespace Data\Items;
	
	interface IGetDescendantsCallback
	{
		public function __construct($targetObject);
		public function getItemClosure();
		public function upLevelClosure();
		public function downLevelClosure();
		public function nextItemClosure();
		public function object();
		public function setGetItemClosure($method);
		public function setUpLevelClosure($method);
		public function setDownLevelClosure($method);
		public function setNextItemClosure($method);
	}

?>