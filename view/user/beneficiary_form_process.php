<?php
require_once('../../library/serverside_validation.php');
require_once('../../controller/bll_support_poor_student.php');

$validation = new Serverside_Validation();
$support_poor_student = new BLL_Beneficiary();

	if(isset($_POST['submit']) || isset($_POST['save'])){

		$is_add = true;
		if(isset($_POST['action']) && $_POST['action'] == 'edit'){
			$is_add = false;
		}elseif (isset($_POST['action']) && $_POST['action'] == 'save') {
			$is_add = false;
		}

		if (isset($_POST['hidden_value']) && $_POST['hidden_value'] == 1) {
			
			$flag = $validation->check_save_form_validation($_POST,$_FILES,$is_add);
			
		}else{
			
			$flag = $validation->check_validation($_POST,$_FILES,$is_add);

			/*if (isset($_SESSION['data-file']['applicant_father_death_certificate']) && $_SESSION['data-file']['applicant_father_death_certificate']['error'] != 4) {
				$_SESSION['death_certificate_flag'] = true;
			}*/	
		}

		//Server Side Validation False Come When Validation Not Proper
		if(!$flag){ 
			
			if($is_add){
				header("location:index.php");
				die();
			}else{
				if (isset($_POST['action']) && $_POST['action'] == 'save') {
					$applicant_email = base64_encode($_POST['email']);
					header("location:index.php?email=$applicant_email");
					die();
				}else{
					$applicant_email = base64_encode($_POST['email']);
					$applicant_cnic  = base64_encode($_POST['applicant_cnic']);
					header("location:index.php?email=$applicant_email&cnic=$applicant_cnic");
					die();
				}
			}
			
		}else{
			extract($_POST);
			extract($_FILES);

				/*if (isset($_SESSION['data-file']['applicant_father_death_certificate']) && $_SESSION['data-file']['applicant_father_death_certificate']['error'] != 4) {
					$father_death_certificate = $_SESSION['data-file']['applicant_father_death_certificate'];
				}*/	
			
			
			$total_family_member =  $_SESSION['total_family_member']??'';
			
		/*-------------------------------------------------------------------------*/
			if(isset($_POST['action']) && $_POST['action'] == 'edit'){
				$support_poor_student->set_hidden_value(0);
			}else{

				$support_poor_student->set_hidden_value($hidden_value);
			}
			
			$support_poor_student->set_first_name($first_name);
			$support_poor_student->set_middle_name($middle_name);
			$support_poor_student->set_last_name($last_name);
			$support_poor_student->set_gender($gender);
			$support_poor_student->set_contact_number($contact_number);
			$support_poor_student->set_email($email);
			$support_poor_student->set_date_of_birth($date_of_birth);
			
			$support_poor_student->set_current_address($current_address);
			$support_poor_student->set_permanent_address($permanent_address);

		/*---------------------------------------------------------------------------*/
			
			if (isset($hidden_value) && $hidden_value == 0) {
				
			$support_poor_student->set_applicant_cnic($applicant_cnic);

			}else if(isset($hidden_value) && $hidden_value == 1 && isset($applicant_cnic)){

				$support_poor_student->set_applicant_cnic($applicant_cnic);
			}else{
				// $support_poor_student->set_applicant_highest_academic_degree(NULL);
			}

		/*---------------------------------------------------------------------------*/

			if($applicant_picture['error'] == 0){
				$support_poor_student->set_applicant_picture($applicant_picture);//File
			}

			if($applicant_cnic_picture['error'] == 0){
				$support_poor_student->set_applicant_cnic_picture($applicant_cnic_picture); //File
			}

			if($applicant_student_id_card_image['error'] == 0){
				$support_poor_student->set_applicant_student_id_card_image($applicant_student_id_card_image);//File
			}


		/*---------------------------------------------------------------------------*/
			if (isset($hidden_value) && $hidden_value == 0) {
				
			$support_poor_student->set_applicant_highest_academic_degree($applicant_highest_academic_degree);

			}else if(isset($hidden_value) && $hidden_value == 1 && isset($applicant_highest_academic_degree)){

				$support_poor_student->set_applicant_highest_academic_degree($applicant_highest_academic_degree);
			}else{
				// $support_poor_student->set_applicant_highest_academic_degree(NULL);
			}
			
			// $support_poor_student->set_applicant_highest_academic_degree($applicant_highest_academic_degree);
			if($applicant_marksheet_images['error'][0] == 0){
				$support_poor_student->set_applicant_marksheet_images($applicant_marksheet_images);//File
			}
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_stipend_for_non_muslim($stipend_for_non_muslim??null);
			$support_poor_student->set_eligible_for_zakat($eligible_for_zakat??null);
			$support_poor_student->set_reason_for_zakat($reason_for_zakat);
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_is_father_alive($is_father_alive);
			if($applicant_father_death_certificate['error'] == 0){
				$support_poor_student->set_applicant_father_death_certificate($applicant_father_death_certificate); //File
			}

			$support_poor_student->set_father_cnic($father_cnic);
			
			$support_poor_student->set_father_first_name($father_first_name);
			$support_poor_student->set_father_middle_name($father_middle_name);
			$support_poor_student->set_father_last_name($father_last_name);
			$support_poor_student->set_father_occupation($father_occupation);
		/*---------------------------------------------------------------------------*/
		//$support_poor_student->set_applicant_university_admission($applicant_university_admission);

			if (isset($hidden_value) && $hidden_value == 0) {	
				$support_poor_student->set_applicant_university_admission($applicant_university_admission);

			}else if(isset($hidden_value) && $hidden_value == 1 && isset($applicant_university_admission)){

				$support_poor_student->set_applicant_university_admission($applicant_university_admission);
				
			}else{
				// $support_poor_student->set_applicant_university_admission(Null);
			}

		/*---------------------------------------------------------------------------*/

		// $support_poor_student->set_is_currently_enrolled_in_uni($is_currently_enrolled_in_uni);

			if (isset($hidden_value) && $hidden_value == 0) {
				
			$support_poor_student->set_is_currently_enrolled_in_uni($is_currently_enrolled_in_uni);

			}else if(isset($hidden_value) && $hidden_value == 1 && isset($is_currently_enrolled_in_uni)){

				$support_poor_student->set_is_currently_enrolled_in_uni($is_currently_enrolled_in_uni);
			}else{
				$is_currently_enrolled_in_uni = NUll;
				$support_poor_student->set_is_currently_enrolled_in_uni($is_currently_enrolled_in_uni);
			}
			
			/*---------------------------------------------------------------------------*/
			
			if ($is_currently_enrolled_in_uni == 'Yes') {

				if (isset($hidden_value) && $hidden_value == 0) {
					
				$support_poor_student->set_univerity($univerity);

				}else if(isset($hidden_value) && $hidden_value == 1 && isset($is_currently_enrolled_in_uni)){

					$support_poor_student->set_univerity($univerity);
				}else{
					// $univerity = NUll;
					// $support_poor_student->set_univerity($univerity);
				}

				$support_poor_student->set_univerity_year($univerity_year);
				$support_poor_student->set_degree_completed_year($degree_completed_year);
				$support_poor_student->set_degree_yearly_expenses($degree_yearly_expenses);
			}else{
				$support_poor_student->set_univerity(NULL);
				$support_poor_student->set_univerity_year(NULL);
				$support_poor_student->set_degree_completed_year(NULL);
			}
		/*---------------------------------------------------------------------------*/
			if (isset($hidden_value) && $hidden_value == 0) {
				
			$support_poor_student->set_is_currently_working($is_currently_working);

			}else if(isset($hidden_value) && $hidden_value == 1 && isset($is_currently_working)){

				$support_poor_student->set_is_currently_working($is_currently_working);
			}else{

				$support_poor_student->set_is_currently_working(NULL);
			}

			if (isset($hidden_value) && $hidden_value == 0) {
				
			$support_poor_student->set_applicant_skill($applicant_skill);

			}else if(isset($hidden_value) && $hidden_value == 1 && isset($applicant_skill)){

				$support_poor_student->set_applicant_skill($applicant_skill);

			}else{
				$support_poor_student->set_applicant_skill(NULL);
			}

			
			$support_poor_student->set_how_much_earning($how_much_earning);
			$support_poor_student->set_what_skill($what_skill);
		/*---------------------------------------------------------------------------*/
			if (isset($hidden_value) && $hidden_value == 0) {
				
			$support_poor_student->set_financial_help($financial_help);

			}else if(isset($hidden_value) && $hidden_value == 1 && isset($financial_help)){

				$support_poor_student->set_financial_help($financial_help);

			}else{
				$support_poor_student->set_financial_help(NULL);
			}

			
			$support_poor_student->set_how_much_financial_help($how_much_financial_help);
			$support_poor_student->set_from_where_financial_help($from_where_financial_help);
			
			if($financial_help_image['error'] == 0){
				$support_poor_student->set_financial_help_image($financial_help_image); //File
			}
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_total_family_member($total_family_member);
			$support_poor_student->set_adult($adult);
			$support_poor_student->set_children_under_age($children_under_age);
			$support_poor_student->set_total_family_monthly_income($total_family_monthly_income);
			$support_poor_student->set_how_many_earning_members($how_many_earning_members);
		/*---------------------------------------------------------------------------*/
			$support_poor_student->set_bank_name($bank_name);
			$support_poor_student->set_bank_branch_name($bank_branch_name);
			$support_poor_student->set_bank_account_title($bank_account_title);
			$support_poor_student->set_bank_account_number($bank_account_number);

			if($is_add === true){ /*For Insert*/
				$flag = $support_poor_student->add_beneficiary( $support_poor_student->get_beneficiary_data() );
				$last_insert_id = $support_poor_student->get_last_id();
			}else{ /*For Update*/

				$support_poor_student->set_beneficiary_id($beneficiary_id);

				$flag = $support_poor_student->update_beneficiary( $support_poor_student->get_beneficiary_data() );
				
				$last_insert_id = $beneficiary_id;
				
			}

			$first_name = $support_poor_student->get_first_name();
			$last_name = $support_poor_student->get_last_name();
			
			if($flag ===  true){

				$support_poor_student->set_beneficiary_profile_picture( $support_poor_student->get_applicant_picture(),$first_name,
										  $last_name,$last_insert_id);
			
				$support_poor_student->set_beneficiary_student_id_card_image( $support_poor_student->get_applicant_student_id_card_image(),$first_name,
										  $last_name,$last_insert_id,$is_add);

				$support_poor_student->set_beneficiary_marksheets( $support_poor_student->get_applicant_marksheet_images(),$first_name,
										  $last_name, $last_insert_id, $is_add );

				$support_poor_student->set_beneficiary_father_death_certificate( $support_poor_student->get_applicant_father_death_certificate(),$first_name,
										  $last_name, $last_insert_id, $is_add);
				
				$support_poor_student->set_beneficiary_cnic_picture( $support_poor_student->get_applicant_cnic_picture(),$first_name,
										  $last_name, $last_insert_id, $is_add );


				$support_poor_student->set_beneficiary_financial_help_picture( $support_poor_student->get_financial_help_image(),$first_name,
										  $last_name, $last_insert_id, $is_add );

			/*---------------------------------------------------------------------------*/

				if($nadra_family_registration_certificate['error'] == 0){
					$support_poor_student->set_nadra_family_registration_certificate($nadra_family_registration_certificate); //File
				}

				if($income_document['error'] == 0){
					$support_poor_student->set_income_document($income_document);
				}

				if($father_national_id_card['error'] == 0){
					$support_poor_student->set_father_national_id_card($father_national_id_card);
				}

				$support_poor_student->upload_nadra_family_registration_certificate( $support_poor_student->get_nadra_family_registration_certificate(),
					$first_name,$last_name, $last_insert_id);

				$support_poor_student->upload_income_document( $support_poor_student->get_income_document(),$first_name,$last_name,$last_insert_id);

				$support_poor_student->upload_father_national_id_card( $support_poor_student->get_father_national_id_card(),$first_name,$last_name,$last_insert_id);


				// session_destroy();	
					if (isset($_SESSION['error'])) {
						unset($_SESSION['error']);
					}

					if (isset($_SESSION['data'])) {
						unset($_SESSION['data']);
					}
				
				if($is_add){
					if (isset($hidden_value) && $hidden_value == 1) {
						header("location:index.php?msg=Your application has been saved successfully, kindly complete the submission process of your application as soon as possible so that our team can consider it for further processing.&class=success");
							die();
					}else{
					header("location:index.php?msg=Your application has been submitted successfully. Thank you for your application. Our team will get back to you as soon as possible.&class=success");
					die();

					}
				}else{
					if (isset($hidden_value) && $hidden_value == 1){
						header("location:index.php?msg=Your application has been saved successfully, kindly complete the submission process of your application as soon as possible so that our team can consider it for further processing.&class=success");
							die();
					}else{

						header("location:index.php?msg=Your resubmit application has been updated successfully&class=success");
						die();
					}
				}
				
			}else{

				header("location:index.php?msg=Some thing went wrong&class=danger");
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

?>