<?php
	require_once("../../library/database.php");

	class University extends Database
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

		public function get_all_university()
		{
			$this->query = "SELECT * FROM university";
		
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;
		}

		public function __destruct()
		{
			mysqli_close($this->connection);
		}
	}
?>