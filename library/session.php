<?php
	session_start();

	class Session
	{
		public function set_session($user_data)
		{
			$_SESSION["user"] = $user_data;
		}

		public function is_admin()
		{
			if(isset($_SESSION["user"]))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function admin_session()
		{
			if(!(isset($_SESSION["user"])))
			{
				$this->destroy_session();

				header("location: ../login/login_form.php?message=Please Login Into Your Account&class=danger");
				die();
			}
		}

		public function destroy_session()
		{
			session_destroy();
		}
	}
?>