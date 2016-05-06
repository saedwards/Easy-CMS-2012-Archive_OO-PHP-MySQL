<?php

	namespace API\Pages;
	require_once("Core/System/Resources.php");
	require_once('Core/Data/Layouts/Get.php');
	require_once('Core/Data/Items/Get.php');
	require_once('Core/Data/Items/GetDescendants.php');
	require_once('Core/Operations/PageFunctions/ViewSingleItem/ViewPageGetDescendantsCallback.php');
	use Data\Layouts;
	use Data\Items;
	
	abstract class Page
	{
		protected $buffer = '';
		protected $contentBuffer = '';
		protected $variableFormat = '${VARIABLE_NAME}';
		
		private $getLayout;
		private $currentLevel = 0;
		private $currentLevelBuffer = array();
		private $endLevel = false;
		private $generalContentVar = '${CONTENT}';
		
		protected $primaryItem;
		
		public function getPresentationCode($guid)
		{
			return $this->build($guid);
		}
		
		private function build($guid)
		{
			if(!$this->getLayout)
			{
				$this->getLayout = new Layouts\Get;
			}
			
			$getItem = new Items\Get;
			if(!$item = $getItem->byGUID($guid))
			{
				return false;
			}
			
			$this->primaryItem = $item;
			$this->currentLevelBuffer[$this->currentLevel] = '';
			$this->buildLevelLayout($item, 0);
			
			$callback = new \ViewPageGetDescendantsCallback($this);
			$callback->setGetItemClosure(
				function($thisObj, $item, $y, $x)
				{
					$thisObj->buildLevelLayout($item, $y);
				}
			);
			$callback->setUpLevelClosure(
				function($thisObj)
				{
					$thisObj->up();
				}
			);
			$descendants = new Items\GetDescendants($guid, 0, $callback);
			
			$this->currentLevelBuffer[0] = str_replace('${CONTENT}', '', $this->currentLevelBuffer[0]);

			//preg_match("'<p class=\"review\">(.*?)</p>'si", $source, $match);
			
			$exp = "/{([^}]*)}/";
			
			// \$\{{1}			matches dollar and at least one open curly brace
			// ?}			matches at least one curly brace to end string
			
			// FIND ALL VARIABLE FORMMATED STRINGS AND REMOVE THEM
			$exp = "\\$\{([a-zA-Z_]*})";
						
			$this->currentLevelBuffer[0] = str_replace($exp, '', $this->currentLevelBuffer[0]);
			
			//$this->currentLevelBuffer[0] = eregi_replace($exp, '', $this->currentLevelBuffer[0]);
			
			return $this->currentLevelBuffer[0];
		}
		
		public function up()
		{
			$this->endCurrentLevel();
			$this->currentLevel--;
		}
		
		public function buildLevelLayout(\Data\Items\Item $item, $y)
		{
			$layout = $this->getLayout->byId($item->layoutTemplateId());
			
			if(!$layout)
			{
				echo 'layout not found for item guid: '.$item->guid();
			}
			else
			{
				$html = file_get_contents(\Resources::getRoot().'Templates/'.$layout->directory());
			}
			
			// TESTING #######################################################################
			/*$html = str_replace('${CONTENT}', '[
				Label: '.$item->label().', 
				Level: '.$y.'. 
				Layout id: '.$item->layoutTemplateId().', 
				Layout dir: '.$layout->directory().'],
				GUID: '.$item->guid().',
				Parent: '.$item->parent().' 
				${CONTENT}', $html);*/
			
			if(!isset($this->currentLevelBuffer[$y]))
			{
				$this->currentLevel++;
				$this->resetLevel();
			}
			
			$this->currentLevelBuffer[$y] = str_replace('${CONTENT}', '', $this->currentLevelBuffer[$y]);
			if($layout)
			{
				$this->currentLevelBuffer[$y] .= $html;
			}
		}
		
		private function resetLevel()
		{
			$this->currentLevelBuffer[$this->currentLevel] = '';
		}
		
		private function endCurrentLevel()
		{
			$this->currentLevelBuffer[$this->currentLevel-1] = str_replace('${CONTENT}', 
				$this->currentLevelBuffer[$this->currentLevel], $this->currentLevelBuffer[$this->currentLevel-1]);
				
			unset($this->currentLevelBuffer[$this->currentLevel]);
		}
		
		public function __destruct()
		{
			$this->compile();
		}
		
		protected function compile()
		{
			echo $this->buffer;
		}
		
		protected function templateVar($var)
		{
			return str_replace('VARIABLE_NAME', $var, $this->variableFormat);
		}
	}

?>