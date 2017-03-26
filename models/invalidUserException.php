<?php
	class InvalidUserExceptions extends Exception
	{
		protected $message = 'Invalid User, Acces Denied';
		public function get_message() { return $this->message; }
	}
?>