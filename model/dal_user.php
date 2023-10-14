<?php
	require_once("../../library/database.php");

	class DAL_User extends Database
	{
		protected $connection 		= NULL;
		protected $query			= NULL;
		protected $result			= NULL;

		public function __construct()
		{
			$this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

			if(mysqli_connect_errno())
			{
				echo "<p style='color: red'>Database Connection Problem <b>Error No: </b>".mysqli_connect_errno()." <b>Error Message: </b>".mysqli_connect_error()."</p>";
			}
		}

		public function login_process($email, $password)
		{
			$this->query = "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'";
			
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;
		} 

		public function __destruct()
		{
			mysqli_close($this->connection);
		}
	}
?>