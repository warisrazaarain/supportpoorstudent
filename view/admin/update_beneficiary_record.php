<?php
require_once('../../library/serverside_validation.php');
require_once('../../controller/bll_support_poor_student.php');
require_once('../../controller/bll_mail_send.php');
// require_once('../../controller/bll_beneficiary_essential_documents.php');

$mail 		= new BLL_Mail_Send ();
$validation = new Serverside_Validation();
$support_poor_student = new BLL_Beneficiary();

	if(isset($_POST['update'])){

		$flag = $validation->check_validation_for_update_record($_POST);
		
		//False Come When Validation Not Proper
		if(!$flag){ 
			header("location:view_beneficiary_detail.php?beneficiary_id=".$_POST['beneficiary_id']);
			die();
		}else{

			extract($_POST);

			
			$total_family_member =  $_SESSION['total_family_member']??'';
			
		/*-------------------------------------------------------------------------*/
			$support_poor_student->set_first_name($first_name);
			$support_poor_student->set_middle_name($middle_name);
			$support_poor_student->set_last_name($last_name);
			$support_poor_student->set_gender($gender);
			$support_poor_student->set_contact_number($contact_number);
			$support_poor_student->set_email($email);
			$support_poor_student->set_date_of_birth($date_of_birth);
			$support_poor_student->set_applicant_cnic($applicant_cnic);
			$support_poor_student->set_current_address($current_address);
			$support_poor_student->set_permanent_address($permanent_address);
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_applicant_highest_academic_degree($applicant_highest_academic_degree);
		
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_stipend_for_non_muslim($stipend_for_non_muslim??null);

			if (isset($eligible_for_zakat)){

                if ($eligible_for_zakat == 'Yes') {
			       $support_poor_student->set_reason_for_zakat($reason_for_zakat);
                }
				$support_poor_student->set_eligible_for_zakat($eligible_for_zakat);
			}
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_is_father_alive($is_father_alive);
			$support_poor_student->set_father_cnic($father_cnic);
			$support_poor_student->set_father_first_name($father_first_name);
			$support_poor_student->set_father_middle_name($father_middle_name);
			$support_poor_student->set_father_last_name($father_last_name);
			$support_poor_student->set_father_occupation($father_occupation);
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_applicant_university_admission($applicant_university_admission);
			$support_poor_student->set_is_currently_enrolled_in_uni($is_currently_enrolled_in_uni);
			if ($is_currently_enrolled_in_uni == 'Yes') {
				$support_poor_student->set_univerity($university);
				$support_poor_student->set_univerity_year($university_year);
				$support_poor_student->set_degree_completed_year($degree_completed_year);
				$support_poor_student->set_degree_yearly_expenses($degree_yearly_expenses);
			}else{
				$support_poor_student->set_univerity(NULL);
				$support_poor_student->set_univerity_year(NULL);
				$support_poor_student->set_degree_completed_year(NULL);
				$support_poor_student->set_degree_yearly_expenses(NULL);
			}
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_is_currently_working($is_currently_working);
			if ($is_currently_working == 'Yes') {
				$support_poor_student->set_how_much_earning($how_much_earning);
			}else{
				$support_poor_student->set_how_much_earning(Null);
			}
			if ($applicant_skill == 'Yes') {
				$support_poor_student->set_what_skill($what_skill);
			}else{
				$support_poor_student->set_what_skill(Null);	
			}
			$support_poor_student->set_applicant_skill($applicant_skill);
		/*---------------------------------------------------------------------------*/
			
			if ($financial_help == 'Yes') {
				$support_poor_student->set_how_much_financial_help($how_much_financial_help);
				$support_poor_student->set_from_where_financial_help($from_where_financial_help);
			}else{
				$support_poor_student->set_how_much_financial_help(Null);
				$support_poor_student->set_from_where_financial_help(Null);
			}
			$support_poor_student->set_financial_help($financial_help);
			
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_adult($adult);
			$support_poor_student->set_children_under_age($children_under_age);
			$support_poor_student->set_total_family_member($total_family_member);
			$support_poor_student->set_total_family_monthly_income($total_family_monthly_income);
			$support_poor_student->set_how_many_earning_members($how_many_earning_members);

			/*---------------------------------------------------------------------------*/
			$support_poor_student->set_bank_name($bank_name);
			$support_poor_student->set_bank_branch_name($bank_branch_name);
			$support_poor_student->set_bank_account_title($bank_account_title);
			$support_poor_student->set_bank_account_number($bank_account_number);

			$flag = $support_poor_student->update_beneficiary_from_admin( $support_poor_student->get_beneficiary_data(),$_POST['beneficiary_id'] );
			
			if($flag ===  true){
				unset($_SESSION['update-data']);	
				header("location:view_beneficiary_detail.php?beneficiary_id=$beneficiary_id&msg= Applicant ID $beneficiary_id record has been updated successfully.&class=success");
			}else{
				
				header("location:view_beneficiary_detail.php?beneficiary_id=$beneficiary_id&msg=Sorry Applicant record not updated&class=danger");
				die();
			}

		}

	}	
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'checked_email'){
		extract($_REQUEST);
		echo $support_poor_student->checked_email($email,$applicant_id);
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'checked_cnic'){
		extract($_REQUEST);
		
		echo $support_poor_student->checked_cnic($applicant_cnic,$applicant_id);
	
	}
	elseif(isset($_POST['save']) && $_POST['action'] == 'essential_doc'){
		extract($_POST);
		extract($_FILES);
		
		$flag = $validation->check_validation_for_essential_docs($_FILES);

		if(!$flag){ 
			header("location:view_beneficiary_status.php?beneficiary_id=".$_POST['beneficiary_id']);
			die();
		}else{

			if($nadra_family_registration_certificate['error'] == 0){
				$support_poor_student->set_nadra_family_registration_certificate($nadra_family_registration_certificate); //File
			}

			if($income_document['error'] == 0){
				$support_poor_student->set_income_document($income_document);
			}

			if($father_national_id_card['error'] == 0){
				$support_poor_student->set_father_national_id_card($father_national_id_card);
			}

			$support_poor_student->upload_nadra_family_registration_certificate( $support_poor_student->get_nadra_family_registration_certificate(),$b_first_name,
										  $b_last_name, $beneficiary_id );

			$support_poor_student->upload_income_document( $support_poor_student->get_income_document(),$b_first_name,
										  $b_last_name, $beneficiary_id );

			$support_poor_student->upload_father_national_id_card( $support_poor_student->get_father_national_id_card(),$b_first_name,
										  $b_last_name, $beneficiary_id );

			header("location:view_beneficiary_status.php?beneficiary_id=".$beneficiary_id."&msg=Applicant ID $beneficiary_id essential documents uploaded successfully&class=success");
			
		}

	}
	elseif (isset($_POST['save_status']) && $_POST['action'] == 'applicant_status') {
		extract($_POST);

		if($support_start != "" && $support_stop != ""){	
	    	if( ! ($support_stop > $support_start ) ){
	    		header("location:view_beneficiary_status.php?beneficiary_id=$beneficiary_id&stop=Note: Support Stop date must be greater than Support Start date.&tab_2=1");
				die();
			}
   		}
		$status_flag = $support_poor_student->update_beneficiary_application_status($applicant_status,$comment,$written_test_marks,$beneficiary_id);

		if($status_flag === true){
		
		$email_result = $support_poor_student->get_email_for_mail_sending_Status($beneficiary_id);
		$email_row = mysqli_fetch_assoc($email_result);
		$applicant_first_name = $email_row['applicant_first_name'];
		$applicant_last_name = $email_row['applicant_last_name'];
		$applicant_email = $email_row['applicant_email'];
		$applicant_gender = $email_row['applicant_gender'];

			if ($applicant_gender == 'Male') {
				$applicant_gender ="Mr";
			}else{
				$applicant_gender ="Miss";
			}

			if(($support_start != "" && $support_amount == "") || ($support_start == "" && $support_amount != "") ){
				header("location:view_beneficiary_status.php?beneficiary_id=$beneficiary_id&start=This field is required.&amount=This field is required.&tab_2=1");
				die();

			}else{
				
				$last_support_exist = $support_poor_student->get_applicant_last_support_record($beneficiary_id);
				
				if($last_support_exist->num_rows > 0){

						// if ($_POST['support_stop'] != "") {
							$update_flag = $support_poor_student->update_beneficiary_support($_POST);	
							if($update_flag === true){
								
								$support_status = 2;
								if($_POST['support_stop'] != "" ){
									$support_status = 3;
								}

								$support_poor_student->update_beneficiary_support_status($beneficiary_id, $support_status);

								$data = array(
												"beneficiary_id" => $beneficiary_id,
												"support_start" => $support_start,
												"support_stop" => $support_stop,
												"support_amount" => $support_amount,
												"applicant_email" => $applicant_email,
												"applicant_first_name" => $applicant_first_name,
												"applicant_last_name" => $applicant_last_name,
												"applicant_gender" => $applicant_gender
											);

								$mail->support_start_stop_mail_send($data);

								header("location:view_beneficiary_status.php?beneficiary_id=$beneficiary_id&msg=Applicant ID $beneficiary_id support status updated successfully&class=success&tab_2=1");
								die();
							}
						// }
				}else{

					if(($support_start != "" && $support_amount != "")){

						$add_flag = $support_poor_student->add_beneficiary_support($_POST);					
						if($add_flag === true):

							$support_poor_student->update_beneficiary_support_status($beneficiary_id, 2);
							
							$data = array(
											"beneficiary_id" => $beneficiary_id,
											"support_start" => $support_start,
											"support_stop" => $support_stop,
											"support_amount" => $support_amount,
											"applicant_email" => $applicant_email,
											"applicant_first_name" => $applicant_first_name,
											"applicant_last_name" => $applicant_last_name,
											"applicant_gender" => $applicant_gender
										);


							$mail->support_start_stop_mail_send($data);

							header("location:view_beneficiary_status.php?beneficiary_id=$beneficiary_id&msg=Applicant ID $beneficiary_id support start successfully &class=success&tab_2=1");
							die();
						else:
							header("location:view_beneficiary_status.php?beneficiary_id=$beneficiary_id&msg=Some thing went wrong&class=danger&tab_2=1");
							die();
						endif;	

					}

				}
				
			}
	
			$data = array(
							"applicant_status" 		=> $applicant_status,
							"comment" 				=> $comment,
							"beneficiary_id" 		=> $beneficiary_id,
							"applicant_email" 		=> $applicant_email,
							"applicant_first_name" 	=> $applicant_first_name,
							"applicant_last_name" 	=> $applicant_last_name,
							"applicant_gender"		=> $applicant_gender
						);

			$mail->approve_reject_mail_send($data);

			header("location:view_beneficiary_status.php?beneficiary_id=$beneficiary_id&msg=Applicant ID $beneficiary_id application status updated successfully&class=success&tab_2=1");
			// die();

		}else{
			header("location:view_beneficiary_status.php?beneficiary_id=$beneficiary_id&msg=Some thing went wrong while update application status&class=danger&tab_2=1");
			die();			
		}

	}

?>