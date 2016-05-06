<?php

	namespace Library;

	class EventDispatcher
	{
		private $map;
		
		public function addListener($arg1, $arg2 = null)
		{
			if (is_a($arg1, 'BindableListener'))
			{
				return $arg1->bindListeners($this);
			}
			$this->map[$arg1][] = $arg2;
		}
		
		public function dispatchEvent($eventName, $data = null)
		{
			foreach ($this->map[$eventName] as $callback)
			{
				call_user_func_array($callback, array($data));
			}
		}
	}
	
	interface BindableListener
	{
		public function bindListeners(EventDispatcher $dispatcher);
	}

?>