<?php
require_once('../../library/serverside_validation.php');
require_once('../../controller/bll_support_poor_student.php');
require_once('../../controller/bll_mail_send.php');

	$validation 			= new Serverside_Validation();
	$support_poor_student 	= new BLL_Beneficiary();
	$mail 					= new BLL_Mail_Send ();
	
	if(isset($_POST['submit'])){
		
		$flag = $validation->check_request_to_resubmit_form_validation($_POST);
		
		if(!$flag){ 
			header("location:request_to_resubmit_form.php");
			die();
		}else{
			extract($_POST);
			
			$row = $support_poor_student->checked_email_cnic_exist($email, $applicant_cnic);
			
			if($row->num_rows > 0){

				$row_status = mysqli_fetch_assoc($row);
				
				if($row_status['is_form_submitted'] == '0'){
					header("location:request_to_resubmit_form.php?msg=You already requested to resubmit the form.Kindly check your email&class=danger");
					die();
				}else{

					$affected_row = $support_poor_student->update_beneficiary_status($email, $applicant_cnic);
					session_destroy();	
					if($affected_row > 0){
						header("location:index.php?msg=Your application request has been submitted successfully. Thank you for your application. You will get an email when your request will approve from our team.&class=success");
						die();	
					}else{
						header("location:request_to_resubmit_form.php?msg=You already requested to resubmit the form. Kindly be patience your application request is in process.&class=danger");
						die();
					}

				}

			}else{

				header("location:request_to_resubmit_form.php?msg=This Email and CNIC does not match&class=danger");
				die();
			}

		}

	}
	elseif(isset($_REQUEST['email']) && isset($_REQUEST['cnic'])){
		extract($_REQUEST);
		$applicant_email 	= base64_decode($email);
		$applicant_cnic 	= base64_decode($cnic);
		$status 			= '0';
		$affected_row = $support_poor_student->update_beneficiary_status($applicant_email, $applicant_cnic, $status);
		
		$row = $support_poor_student->checked_email_cnic_exist($applicant_email,$applicant_cnic);
		$row_status = mysqli_fetch_assoc($row);
		
		if($affected_row > 0){

			$applicant_id = $row_status['beneficiary_id'];

			$path =  substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], "/") );
			$link = $_SERVER['SERVER_NAME'].$path."/index.php?";
			$link .= "email=$email&cnic=$cnic";
			
			$message = "Your request to resubmit the form for Support Poor Students (Monthly) has been approved by admin, kindly click on the link below to get into the form.";
			$message .= "<br/>";
			$message .= "<a target='_blank' href=$link>$link</a>";
			
			$data = array(
							"id" 				=> $applicant_id,
							"applicant_email" 	=> $applicant_email,
							"message"			=> $message
					);

			$mail->resubmit_form_mail_send($data);
		
		}else{
			header("location:../admin/index.php?message=Some thing went wrong&class=danger");
			die();
		}

	}	
?>