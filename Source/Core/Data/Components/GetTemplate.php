<?php

	namespace Data\Components;
	require_once('Core/Data/Components/Base.php');
	use Data\DataTemplates;
	
	class GetTemplate extends Base
	{
		protected $select = '
			SELECT data_templates.guid, data_templates.label, data_templates.parent, data_templates.current_version, 
				data_templates.layout_template_id,
				data_templates.product_layout_template_id,
				component_types.label as component_label, 
				component_types.definition
			FROM data_templates, components_data_templates_catalogue, component_types ';
			
		public function byGUID($guid)
		{
			$sql = $this->select.' 
				WHERE data_templates.current_version=(SELECT MAX(current_version) FROM data_templates) 
				AND data_templates.guid="'.$guid.'"
				AND components_data_templates_catalogue.data_template_guid=data_templates.guid
				AND components_data_templates_catalogue.component_type_id=component_types.id';
			
			if($result = $this->findByGUID($sql))
			{
				$templateResult = array();
				$templateResult['guid'] = $result['guid'];
				$templateResult['label'] = $result['label'];
				$templateResult['parent'] = $result['parent'];
				$templateResult['layout_template_id'] = $result['layout_template_id'];
				$templateResult['product_layout_template_id'] = $result['product_layout_template_id'];
				$templateResult['current_version'] = $result['current_version'];
				$this->template = $this->buildTemplate($templateResult);
				return $this->buildComponent($result);
			}
			return false;
		}
	}

?>