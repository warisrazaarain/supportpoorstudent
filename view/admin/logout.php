<?php
	require_once("../../library/session.php");

	$session = new Session();

	$session->destroy_session();

	header("location: ../login/login_form.php?message=Logout Successfully&class=success");
?>