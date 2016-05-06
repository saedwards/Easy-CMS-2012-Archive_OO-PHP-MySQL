<?php

	namespace Data\Items;
	require_once('Core/System/GUIDBase.php');
	require_once('Core/Data/Items/Item.php');
	use \System;

	abstract class Base extends \System\GUIDBase
	{
		protected $item;
		protected $select = 'SELECT guid, label, parent, layout_template_id, current_version FROM items';
		
		protected function buildItem($details)
		{
			return new Item($details['guid'], $details['parent'], $details['current_version'], $details['label'], $details['layout_template_id']);
		}
		
		public function getItem()
		{
			return $this->item;
		}
	}

?>