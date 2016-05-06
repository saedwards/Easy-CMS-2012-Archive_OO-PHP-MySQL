<?php

	require_once('Core/Data/DataTemplates/Get.php');
	require_once('Core/Data/Fields/Types/String.php');
	require_once('Core/Presentation/Types/StandardXHTML.php');
	require_once('Core/Data/Items/Create.php');
	use Data\DataTemplates;
	use API\Pages\Types as PageTypes;
	use Data\Fields\Types as FieldTypes;
	use Data\Items;
	
	class CreateDataTemplate extends PageTypes\StandardXHTML
	{
		public function __construct()
		{
			$guid = 'v5cp6ka5-41ya-nzrt-elp1-ftq5yya823yl';
			
			$this->addHeadItem(new FieldTypes\String('<link rel="stylesheet" href="Assets/CSS/style.css" />'));
			$this->addHeadItem(new FieldTypes\String('<link rel="stylesheet" href="Assets/CSS/testing.css" />'));
			
			$this->contentBuffer .= $this->getPresentationCode($guid);
			
			/*$getTemplate = new DataTemplates\Get;
			if($template = $getTemplate->byGUID('3ewmaubp-q36m-lfdh-e0e7-s5m1mpiqqnd5'))
			{
				$this->addContentItem($item);
			}
			
			$this->addHeadItem(new FieldTypes\String('<link rel="stylesheet" href="Assets/CSS/style.css" />'));
			$this->addHeadItem(new FieldTypes\String('<link rel="stylesheet" href="Assets/CSS/testing.css" />'));*/
		}
	}

?>		