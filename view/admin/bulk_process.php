<?php  

	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../controller/bll_support_poor_student.php");
	require_once('../../controller/bll_mail_send.php');

	$session 		= new Session();
	$beneficiary 	= new BLL_Beneficiary();
	$session->admin_session();


if (isset($_REQUEST['bulk_action'])){

	$status = $_REQUEST['application_status'];
	$count  = $_REQUEST['checkbox'];
	
	foreach ($count as $key => $value) {
		$mail 			= new BLL_Mail_Send ();
		$email_result 	 = $beneficiary->get_email_for_mail_sending_Status($value);
		
		$email_row    	 = mysqli_fetch_assoc($email_result);
		$applicant_first_name = $email_row['applicant_first_name'];
		$applicant_last_name = $email_row['applicant_last_name'];
		$applicant_email = $email_row['applicant_email'];
		$applicant_gender = $email_row['applicant_gender'];

		if ($applicant_gender == 'Male') {
			$applicant_gender ="Mr";
		}else{
			$applicant_gender ="Miss";
		}
	
		/*------------*/
		$data = array(
				"applicant_email" => $applicant_email,
				"applicant_first_name" => $applicant_first_name,
				"applicant_last_name" => $applicant_last_name,
				"applicant_gender" => $applicant_gender
			);
		/*------------*/


		if ($status == '2' || $status == '3') {
			
			$last_support_exist = $beneficiary->get_applicant_last_support_record($value);

			if ($last_support_exist->num_rows > 0) {
				
				if ($status =='3') {
		
				$update_flag = $beneficiary->bulk_update_beneficiary_application_support_status_stop($value);
				if ($update_flag) {
					$result_flag = $beneficiary->update_beneficiary_support_status($value, $status);
					
					$data['status'] = $status;
					$mail->bulk_support_start_stop_mail_send($data);
				 }
				}else{

					$update_flag = $beneficiary->bulk_update_beneficiary_application_support_status($value);
					if ($update_flag) {
						$result_flag = $beneficiary->update_beneficiary_support_status($value, $status);

						$data['status'] = $status;
						$mail->bulk_support_start_stop_mail_send($data);
					}
				}	
			}else{
				
				if ($status == 3) {
						
					$status_flag= $beneficiary->check_bulk_record_support_end_date_exist($value);

					if ($status_flag) {

						header("location:index.php?message=Application status has not been updated &class=danger");
					}
				}else{
					$add_flag = $beneficiary->bulk_add_beneficiary_records($value, $status);
					if ($add_flag) {
						$result_flag = $beneficiary->update_beneficiary_support_status($value,$status);

						$data['status'] = $status;						
						$mail->bulk_support_start_stop_mail_send($data);
					}
				}
			}
		}else{
			
			$result_flag = $beneficiary->update_beneficiary_support_status($value, $status);
			
			$data['status'] = $status;

			$mail->bulk_approve_reject_mail_send($data);
		}
			
	}		
	if ($result_flag) {
		header("location:index.php?message=Application status updated successfully.&class=success");
		die();
	}
	else{
		header("location:index.php?message=Application status has not been updated.&class=danger");
		die();
	}
}


?>