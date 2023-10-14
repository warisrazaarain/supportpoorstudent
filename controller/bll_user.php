<?php
	require_once("../../model/dal_user.php");

	class BLL_User extends DAL_User
	{
		protected $first_name			= NULL;
		protected $last_name 			= NULL;
		protected $email 				= NULL;
		protected $password 			= NULL;
		

		public function set_first_name($first_name)
		{
			$this->first_name = $first_name;
		}

		public function set_last_name($last_name)
		{
			$this->last_name = $last_name;
		}

		public function set_email($email)
		{
			$this->email = $email;
		}

		public function set_password($password)
		{
			$this->password = $password;
		}

		public function get_first_name()
		{
			return $this->first_name;
		}

		public function get_last_name()
		{
			return $this->last_name;
		}

		public function get_email()
		{
			return $this->email;
		}

		public function get_password()
		{
			return $this->password;
		}

		public function login()
		{
			$this->result = $this->login_process($this->get_email(), $this->get_password());
		
			return $this->result;
		}
	}
?>