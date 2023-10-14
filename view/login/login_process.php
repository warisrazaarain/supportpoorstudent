<?php
	require_once("../../controller/bll_user.php");
	require_once("../../library/session.php");

	if(isset($_POST['submit'])){

		extract($_POST);

		$bll_user 	= new BLL_User();
		$session 	= new Session;

		$bll_user->set_email($email);
		$bll_user->set_password($password);
		
		$result = $bll_user->login();

		if($result->num_rows)
		{
			$record = mysqli_fetch_assoc($result);
			
			$session->set_session($record);

			if($session->is_admin())
			{
				header("location: ../admin/index.php");
			}
			
		}
		else
		{
			header("location: login_form.php?message=Invalid Email/Password Try Again Later!...&class=danger");
			die();
		}

	}	


?>