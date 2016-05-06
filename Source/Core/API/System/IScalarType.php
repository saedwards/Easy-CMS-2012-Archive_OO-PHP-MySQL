<?php

	namespace System;

	interface IScalarType
	{
		const DATA_TABLE = '';
		public function __construct($value);
		public function getData();
	}

?>