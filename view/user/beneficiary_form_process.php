<?php
require_once('../../library/serverside_validation.php');
require_once('../../controller/bll_support_poor_student.php');

$validation = new Serverside_Validation();
$support_poor_student = new BLL_Beneficiary();
/*echo "<pre>";
echo count($_POST);
print_r($_POST);
print_r($_FILES);
echo "</pre>";*/

	if(isset($_POST['submit'])){
		$flag = $validation->check_validation($_POST,$_FILES);
		
		//False Come When Validation Not Proper
		if(!$flag){ 
			header("location:index.php");
			die();
		}else{
			extract($_POST);
			extract($_FILES);
			
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
			
			$support_poor_student->set_applicant_highest_academic_degree($applicant_highest_academic_degree);
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
			
			$support_poor_student->set_applicant_university_admission($applicant_university_admission);
			$support_poor_student->set_is_currently_enrolled_in_uni($is_currently_enrolled_in_uni);
			if ($is_currently_enrolled_in_uni == 'Yes') {
				$support_poor_student->set_univerity($univerity);
				$support_poor_student->set_univerity_year($univerity_year);
				$support_poor_student->set_degree_completed_year($degree_completed_year);
				$support_poor_student->set_degree_yearly_expenses($degree_yearly_expenses);
			}else{
				$support_poor_student->set_univerity(NULL);
				$support_poor_student->set_univerity_year(NULL);
				$support_poor_student->set_degree_completed_year(NULL);
			}
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_is_currently_working($is_currently_working);
			$support_poor_student->set_how_much_earning($how_much_earning);
			$support_poor_student->set_applicant_skill($applicant_skill);
			$support_poor_student->set_what_skill($what_skill);
		/*---------------------------------------------------------------------------*/
			
			$support_poor_student->set_financial_help($financial_help);
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

			
			$flag = $support_poor_student->add_beneficiary( $support_poor_student->get_beneficiary_data() );
			$last_insert_id = $support_poor_student->get_last_id();
			$first_name = $support_poor_student->get_first_name();
			$last_name = $support_poor_student->get_last_name();
			
			if($flag ===  true){

				$support_poor_student->set_beneficiary_profile_picture( $support_poor_student->get_applicant_picture(),$first_name,
										  $last_name,$last_insert_id);
				$support_poor_student->set_beneficiary_student_id_card_image( $support_poor_student->get_applicant_student_id_card_image(),$last_insert_id);

				$support_poor_student->set_beneficiary_marksheets( $support_poor_student->get_applicant_marksheet_images(), $last_insert_id );

				$support_poor_student->set_beneficiary_father_death_certificate( $support_poor_student->get_applicant_father_death_certificate(), $last_insert_id );
				//$support_poor_student->set_beneficiary_father_cnic_picture( $support_poor_student->get_applicant_father_cnic_picture(), $last_insert_id );
				$support_poor_student->set_beneficiary_cnic_picture( $support_poor_student->get_applicant_cnic_picture(), $last_insert_id );


				$support_poor_student->set_beneficiary_financial_help_picture( $support_poor_student->get_financial_help_image(), $last_insert_id );
				session_destroy();	

				header("location:index.php?msg=Your application has been submitted successfully. Thank you for your application. Our HR team will get back to you as soon as possible.&class=success");
				die();
			}else{

				header("location:index.php?msg=Something Went Wrong&class=danger");
				die();
			}

		}

	}	
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'checked_email'){
		extract($_REQUEST);
		echo $support_poor_student->checked_email($email);
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'checked_cnic'){
		extract($_REQUEST);
		echo $support_poor_student->checked_cnic($applicant_cnic);
	}

?>