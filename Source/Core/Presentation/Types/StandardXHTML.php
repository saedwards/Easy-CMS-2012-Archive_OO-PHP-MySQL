<?php

	namespace API\Pages\Types;
	require_once("Core/Presentation/Page.php");
	use API\Pages;
	use Data\Layouts;
	
	abstract class StandardXHTML extends Pages\Page
	{
		private $template = 'http://localhost:8888/CMS/Website/Core/Presentation/Templates/Standard_XHTML_1.0.html';
		private $metaDataBuffer = '';
		private $headBuffer = '';
		private $title = 'Untitled Document';
		
		public function __destruct()
		{
			$structure = file_get_contents($this->template);
			$this->buffer = str_replace($this->templateVar('META_DATA'), $this->metaDataBuffer, $structure);
			if($this->primaryItem)
			{
				$this->title = $this->primaryItem->label();
			}
			$this->buffer = str_replace($this->templateVar('TITLE'), $this->title, $this->buffer);
			$this->buffer = str_replace($this->templateVar('HEAD'), $this->headBuffer, $this->buffer);
			$this->buffer = str_replace($this->templateVar('BODY'), $this->contentBuffer, $this->buffer);
			parent::__destruct();
		}
		
		protected function addMetaItem(\Data\Fields\Types\String $obj)
		{
			// NEEDS REVISING
			$this->metaDataBuffer .= $obj->getData()."\n";
		}
		
		protected function addHeadItem(\Data\Fields\Types\String $obj)
		{
			// NEEDS REVISING
			$this->headBuffer .= $obj->getData()."\n";
		}
		
		protected function setTitle($title)
		{
			$this->title = $title;
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
		
		protected function addComponentTemplate(\Data\Components\Component $component)
		{
			
		}
		
		protected function addComponent(\Data\Components\Types\IComponentType $component)
		{
			
		}
	}

?>