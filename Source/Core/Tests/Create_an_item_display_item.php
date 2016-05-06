<?php 

	require_once('Core/FunctionTests/System/IFunctionTest.php');
	require_once('Core/Presentation/Types/StandardXHTML.php');
	require_once('Core/Data/Items/Create.php');
	
	use Data\Items;
	use FunctionTests\System as SystemTests;
	use API\Pages\Types as PageTypes;
	
	/**
	* Create an item. Then add a string and integer to the item.
	*/
	
	class CreateAnItemDisplayItem extends PageTypes\StandardXHTML implements SystemTests\IFunctionTest
	{
		public function __construct()
		{
			$this->addHeadItem(new Fields\Types\String('<link rel="stylesheet" href="Assets/CSS/style.css" />'));
			$this->addHeadItem(new Fields\Types\String('<link rel="stylesheet" href="Assets/CSS/testing.css" />'));
			$this->setTitle('TEST: Create an item and display it');
		
			System\CustomConsole::buffer('--- DISPLAY ITEM ---');
			$getItem = new Items\Get;
			if($item = $getItem->byGUID('1hnf16gb-6s62-gtx9-a7uz-obfol5z9y7aq'))
			{
				System\CustomConsole::buffer('GUID: '.$item->guid());
				System\CustomConsole::buffer('Label: '.$item->label());
				System\CustomConsole::buffer('Version: '.$item->version());
				System\CustomConsole::buffer('Parent: '.$item->parent());
			}
			$getItems = new Items\GetDescendants('1hnf16gb-6s62-gtx9-a7uz-obfol5z9y7aq');
			
			echo count($getItems->get());
			System\CustomConsole::buffer('--- END DISPLAY ITEM ---');
		}
	}

?>