<?php 

	require_once('Core/FunctionTests/System/IFunctionTest.php');
	require_once('Core/Presentation/Types/StandardXHTML.php');
	require_once('Core/Data/Fields/Types/String.php');
	require_once('Core/Data/Fields/Types/Integer.php');
	require_once('Core/Data/Items/Create.php');
	
	use Data\Items;
	use Data\Fields;
	use FunctionTests\System as SystemTests;
	use API\Pages\Types as PageTypes;
	
	/**
	* Create an item. Then add a string and integer to the item.
	*/
	
	class CreateAnItemAddFields extends PageTypes\StandardXHTML implements SystemTests\IFunctionTest
	{
		public function __construct()
		{
			$this->addHeadItem(new Fields\Types\String('<link rel="stylesheet" href="Assets/CSS/style.css" />'));
			$this->addHeadItem(new Fields\Types\String('<link rel="stylesheet" href="Assets/CSS/testing.css" />'));
			$this->setTitle('TEST: Create an item');
		
			$class = 'Data\Fields\Types\String';
			$class2 = 'Data\Fields\Types\Integer';
			System\CustomConsole::buffer('--- CREATE AN ITEM ---');
			$item = new Items\Create('Label');
			$item->addField(new $class('Test String'));
			$item->addField(new $class2(123));
			System\CustomConsole::buffer('GUID: '.$item->getItem()->guid());
			System\CustomConsole::buffer('Label: '.$item->getItem()->label());
			System\CustomConsole::buffer('Version: '.$item->getItem()->version());
			System\CustomConsole::buffer('Parent: '.$item->getItem()->parent());
			System\CustomConsole::buffer('--- END CREATE AN ITEM ---');
		}
		
		public function __destruct()
		{
			$this->contentBuffer .= System\CustomConsole::console();
			
			$this->contentBuffer .= '
			<ul>
				<li><a href="edit.php">Requests</a></li>
				<li><a href="view.php">View Page</a></li>
				<li><a href="view_rss.php">View RSS Page</a></li>
				<li><a href="create_data_template.php">Create Data Template</a></li>
			</ul>';
			
			// ALWAYS CALL PARENT DESCTRUCT LAST
			parent::__destruct();
		}
	}

?>