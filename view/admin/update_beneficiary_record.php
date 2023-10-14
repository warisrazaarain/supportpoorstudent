<?php
require_once('../../library/serverside_validation.php');
require_once('../../controller/bll_support_poor_student.php');

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

			// echo "<pre>";
			// print_r( $support_poor_student->get_beneficiary_data());
			// echo "</pre>";

			
			 $flag = $support_poor_student->update_beneficiary( $support_poor_student->get_beneficiary_data(),$_POST['beneficiary_id'] );
			
			if($flag ===  true){
			unset($_SESSION['update-data']);	
				header("location:view_beneficiary_detail.php?beneficiary_id=$beneficiary_id&msg= Applicant Record has been updated successfully.&class=success");
			}else{
					echo "false";
				header("location:view_beneficiary_detail.php?msg=Sorry Applicant Record Not Updated&class=danger");
				die();
			}

		}

	}	
	// elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'checked_email'){
	// 	extract($_REQUEST);
	// 	echo $support_poor_student->checked_email($email);
	// }
	// elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'checked_cnic'){
	// 	extract($_REQUEST);
	// 	echo $support_poor_student->checked_cnic($applicant_cnic);
	// }

?>