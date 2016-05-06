<?php

	namespace API\Pages\Types;
	require_once("Core/Presentation/Page.php");
	require_once('Core/Data/Items/Get.php');
	use API\Pages;
	use Data\Layouts;
	
	abstract class StandardRSS extends Pages\Page
	{
		private $template = 'http://127.0.0.1/~shaneedwards/CMS/Website/Core/Presentation/Templates/RSS_test.xml';
		private $metaDataBuffer = '';
		private $headBuffer = '';
		
		public function __destruct()
		{
			$structure = file_get_contents($this->template);
			$this->buffer = $structure;
			//$this->buffer = str_replace($this->templateVar('BODY'), $this->contentBuffer, $this->buffer);
			parent::__destruct();
		}
		
		protected function addTitle(\Data\Fields\Types\String $obj)
		{
			$this->metaDataBuffer .= $obj->getData()."\n";
		}
		
		protected function addItem()
		{
			
		}
		
		/*protected function addContentItem(\Data\Items\Item $item)
		{
			if(!$layoutId = $item->layoutTemplateId())
			{
				return false;
			}
		
			$getLayout = new Layouts\Get();
			$layout = $getLayout->byId($layoutId);
			
			$html = file_get_contents(\Resources::getRoot().'Templates/'.$layout->directory());
			
			$this->contentBuffer .= $html;
		}*/
	}

?>