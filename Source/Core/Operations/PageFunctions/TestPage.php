<?php

	require_once('Core/System/Resources.php');
	require_once('Core/FunctionTests/System/IFunctionTest.php');
	require_once('Core/Presentation/Types/StandardXHTML.php');
	require_once('Core/Data/Items/Get.php');
	require_once('Core/Data/DataTemplates/Get.php');
	require_once('Core/Data/DataTemplates/Create.php');
	require_once('Core/Data/Items/Create.php');
	require_once('Core/Data/Fields/Types/String.php');
	require_once('Core/Data/Fields/Types/Integer.php');
	require_once('Core/Data/Components/GetTemplate.php');
	require_once('Core/Data/Components/Types/SelectField.php');
	require_once('Core/Data/Components/Create.php');
	require_once('Core/Data/Layouts/Get.php');
	require_once('Core/Data/Items/GetDescendants.php');
	require_once('Core/Data/Composition/Insert.php');
	//require_once('Core/Data/Items/GetRoot.php');
	//require_once('Core/FunctionTests/System/SearchTree.php');
	//require_once('Core/System/SearchTree.php');
	//require_once('Core/Data/Fields/GetItemFields.php');
	//require_once('Core/Data/Items/ItemFactory.php');
	//require_once('Core/FunctionTests/System/SearchTree.php');
	//require_once('Core/FunctionTests/Items/GetDescendants.php');
	//require_once('Core/Data/Fields/Field.php');
	//require_once('Core/System/CustomConsole.php');
	use \System;
	use Data\Fields;
	use Data\Items;
	use Data\DataTemplates;
	use Data\Components;
	use Data\Layouts;
	use Data\Composition;
	use FunctionTests\System as SystemTests;
	//use FunctionTests\Items as ItemTests;
	//use \System;
	use API\Pages\Types as PageTypes;
	//use FunctionTests\Items;

	class TestPage extends PageTypes\StandardXHTML implements SystemTests\IFunctionTest
	{
		public function __construct()
		{
			$this->addHeadItem(new Fields\Types\String('<link rel="stylesheet" href="Assets/CSS/style.css" />'));
			$this->addHeadItem(new Fields\Types\String('<link rel="stylesheet" href="Assets/CSS/testing.css" />'));
		
			$this->setTitle('Index Testing Page');

			/*System\CustomConsole::buffer('--- DISPLAY ITEM ---');
			$getItem = new Items\Get;
			if($item = $getItem->byGUID('1hnf16gb-6s62-gtx9-a7uz-obfol5z9y7aq'))
			{
				System\CustomConsole::buffer('GUID: '.$item->guid());
				System\CustomConsole::buffer('Label: '.$item->label());
				System\CustomConsole::buffer('Version: '.$item->version());
				System\CustomConsole::buffer('Parent: '.$item->parent());
			}*/
			//$getItems = new Items\GetDescendants('1hnf16gb-6s62-gtx9-a7uz-obfol5z9y7aq');
			
			//echo count($getItems->get());
			//System\CustomConsole::buffer('--- END DISPLAY ITEM ---');
			
			//System\CustomConsole::buffer('');
			System\CustomConsole::buffer('--- DISPLAY DATA TEMPLATE ---');
			$getTemplate = new DataTemplates\Get;
			if($template = $getTemplate->byGUID('dtc1aqj2-8skc-5jt9-ppey-8qser5sngjt9'))
			{
				System\CustomConsole::buffer('GUID: '.$template->guid());
				System\CustomConsole::buffer('Label: '.$template->label());
				System\CustomConsole::buffer('Version: '.$template->version());
				System\CustomConsole::buffer('Parent: '.$template->parent());
			}
			System\CustomConsole::buffer('--- END DISPLAY DATA TEMPLATE ---');
			
			/*System\CustomConsole::buffer('');
			System\CustomConsole::buffer('--- DISPLAY COMPONENT TEMPLATE ---');
			$getComponent = new Components\GetTemplate;
			if($component = $getComponent->byGUID('px2es5f7-qx0m-9etf-74dg-ko0rbl6sh4q0'))
			{
				System\CustomConsole::buffer('GUID: '.$component->guid());
				System\CustomConsole::buffer('Label: '.$component->label());
				System\CustomConsole::buffer('Version: '.$component->version());
				System\CustomConsole::buffer('Parent: '.$component->parent());
				System\CustomConsole::buffer('Layout Id: '.$component->layoutTemplateId());
				System\CustomConsole::buffer('Product Layout Id: '.$component->productLayoutTemplateId());
				System\CustomConsole::buffer('Parent: '.$component->parent());
				System\CustomConsole::buffer('Component Label: '.$component->componentLabel());
				System\CustomConsole::buffer('Definition: '.$component->definition());
			}*/
			/*$getLayout = new Layouts\Get;
			if($layoutObj = $getLayout->byId($template->layoutTemplateId()))
			{
				System\CustomConsole::buffer(file_get_contents(Resources::getRoot().'Templates/'.$layoutObj->directory()));
				
			}
			if($productLayoutObj = $getLayout->byId($template->productLayoutTemplateId()))
			{
				System\CustomConsole::buffer(file_get_contents(Resources::getRoot().'Templates/'.$productLayoutObj->directory()));
			}*/
			/*System\CustomConsole::buffer('--- END DISPLAY COMPONENT TEMPLATE ---');
			
			System\CustomConsole::buffer('');
			System\CustomConsole::buffer('--- INSERT COMPOSITION OF COMPONENT, TEMPLATE OR ITEM ---');
			$insert = new Composition\Insert;
			$insert->target($template);
			$insert->add($component, 'CONTENT');
			System\CustomConsole::buffer('--- END INSERT COMPOSITION OF COMPONENT, TEMPLATE OR ITEM ---');*/
			
			/*System\CustomConsole::buffer('');
			System\CustomConsole::buffer('--- CREATE NEW COMPONENT ---');
			$createComponent = new Data\Components\Create('Test Component');
			System\CustomConsole::buffer('--- END CREATE NEW COMPONENT ---');*/
			
			/*System\CustomConsole::buffer('');
			System\CustomConsole::buffer('--- CREATE ITEM TEMPLATE AND DISPLAY IT ---');
			$template = new DataTemplates\Create('Test Template');
			$template->addFieldTypeReference('Test Field', 1);
			System\CustomConsole::buffer('GUID: '.$template->getTemplate()->guid());
			System\CustomConsole::buffer('Label: '.$template->getTemplate()->label());
			System\CustomConsole::buffer('Version: '.$template->getTemplate()->version());
			System\CustomConsole::buffer('Parent: '.$template->getTemplate()->parent());
			System\CustomConsole::buffer('--- END CREATE ITEM TEMPLATE AND DISPLAY IT ---');*/
			
			/*System\CustomConsole::buffer('--- DISPLAY ALL ROOT ITEMS ---');
			$getItems = new Items\GetRoot;
			$items = $items->all();
			foreach($items as $item)
			{
				System\CustomConsole::buffer('GUID: '.$item->guid());
				System\CustomConsole::buffer('Label: '.$item->label());
				System\CustomConsole::buffer('Version: '.$item->version());
				System\CustomConsole::buffer('Parent: '.$item->parent());
			}
			System\CustomConsole::buffer('--- END DISPLAY ALL ROOT ITEMS ---');*/
			
			/*System\CustomConsole::buffer('--- DISPLAY ALL ROOT ITEMS WITH AN ITEM TEMPLATE ---');
			$getItems = new Items\GetRoot;
			$items = $getItems->allWithTemplate();
			foreach($items as $item)
			{
				System\CustomConsole::buffer('GUID: '.$item->guid());
				System\CustomConsole::buffer('Label: '.$item->label());
				System\CustomConsole::buffer('Version: '.$item->version());
				System\CustomConsole::buffer('Parent: '.$item->parent());
			}
			System\CustomConsole::buffer('--- END DISPLAY ALL ROOT ITEMS WITH AN ITEM TEMPLATE ---');*/
			
			/*$class = 'System\GUID';
			$one = new $class();
			echo $one->get();*/
			
			/*
			System\CustomConsole::buffer('--- CONSTRUCT SAMPLE DESCENDANTS TREE ---');
			$items = new Items\GetDescendants(1);
			System\CustomConsole::buffer('--- END CONSTRUCT SAMPLE DESCENDANTS TREE ---');
			*/
			
			/*
			$this->buffer('--- SEARCH DESCENDANTS TREE ---');
			$items = new System\SearchTree;
			$items->findAll(1);
			$this->buffer($items->console());
			$this->buffer('--- END SEARCH TREE DESCENDANTS ---');
			*/

			/*
			$this->buffer('--- GET FIELD BY ITEM TEST ---');
			$fields = new Fields\GetItemFields(1);
			foreach($fields->getFields() as $key=>$field)
			{
				$this->buffer($field->getId().' '.$field->getDataTable().' '.$field->getTypeLabel().' '.$field->getValue().' '.$field->getVersion());
			}
			$this->buffer('--- END GET FIELD BY ITEM TEST ---');
			*/
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