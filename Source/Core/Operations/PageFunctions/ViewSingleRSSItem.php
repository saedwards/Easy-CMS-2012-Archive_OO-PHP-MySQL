<?php

	require_once('Core/Data/Items/Get.php');
	require_once('Core/Data/Layouts/Get.php');
	require_once('Core/Data/Items/GetDescendants.php');
	require_once('Core/System/Resources.php');
	require_once('Core/Presentation/Types/StandardRSS.php');
	require_once('Core/Data/Fields/Types/String.php');
	use \System;
	use Data\Items;
	use Data\Layouts;
	use API\Pages\Types as PageTypes;
	use Data\Fields\Types as FieldTypes;

	class ViewSingleItem extends PageTypes\StandardRSS
	{
		public function __construct($guid)
		{
			$this->contentBuffer .= $this->getPresentationCode($guid);
		}
	}

?>		