<?php 
require_once('../../library/serverside_validation.php');
require_once('../../controller/bll_support_poor_student.php');
require_once('../../controller/bll_mail_send.php');

	$validation 			= new Serverside_Validation();
	$support_poor_student 	= new BLL_Beneficiary();
	$mail 					= new BLL_Mail_Send();
	
	if (isset($_REQUEST['submit'])) {
		$flag = $validation->check_request_to_save_form_validation($_POST);

		if(!$flag){ 
			header("location:request_to_save_form.php");
			die();
		}else{
			extract($_POST);
			$row = $support_poor_student->checked_email_exist($email);
			
			if ($row->num_rows > 0) {
				$row_status = mysqli_fetch_assoc($row);
			
				if ($row_status['is_form_saved']=='0'){
					header("location:request_to_save_form.php?msg=You'r form is already submitted.&class=danger&form=save_form");
					die();
				
				}else{
				 		$applicant_email 	= base64_encode($email);
				 		
				 		$path =  substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], "/") );
						$link = $_SERVER['SERVER_NAME'].$path."/index.php?";
						$link .= "email=$applicant_email";


						$message = "Your request to resubmit the form for Support Poor Students (Monthly) has been approved by admin, kindly click on the link below to get into the form.";
						$message .= "<a target='_blank' href=$link>$link</a>";
						
						$data = array(
										"applicant_email" 	=> $applicant_email,
										"message"			=> $message
								);

						$mail->resubmit_save_form_mail_send($data);
						
				}
			
			}else{
				header("location:request_to_save_form.php?msg=This Email  does not match&class=danger");
				die();
			}
			
		}
		
	}


?>