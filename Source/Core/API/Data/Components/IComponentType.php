<?php

	namespace Data\Components\Types;

	interface IComponentType
	{
		public function create();
		public function validate();
	}

?>