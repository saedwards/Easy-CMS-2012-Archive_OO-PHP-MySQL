<?php

	require_once('Core/Data/Items/Get.php');
	require_once('Core/Data/Layouts/Get.php');
	require_once('Core/Data/Items/GetDescendants.php');
	require_once('Core/System/Resources.php');
	require_once('Core/Presentation/Types/StandardXHTML.php');
	require_once('Core/Data/Fields/Types/String.php');
	use \System;
	use Data\Items;
	use Data\Layouts;
	use API\Pages\Types as PageTypes;
	use Data\Fields\Types as FieldTypes;

	class ViewSingleItem extends PageTypes\StandardXHTML
	{
		public function __construct($guid)
		{
			$this->addHeadItem(new FieldTypes\String('<link rel="stylesheet" href="Assets/CSS/style.css" />'));
			$this->addHeadItem(new FieldTypes\String('<link rel="stylesheet" href="Assets/CSS/testing.css" />'));
			$this->contentBuffer .= $this->getPresentationCode($guid);
		}
	}

?>		