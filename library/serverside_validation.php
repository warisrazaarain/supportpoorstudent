<?php
 session_start();	
 class Serverside_Validation
 {
 	protected $alpha_pattern 			= "/^[A-Z]{1}[a-z]{2,}$/";	//Ali
    protected $email_pattern 			= "/^[a-z]{2,}\w*[@]{1}[a-z]{2,}[.]{1}[a-z]{2,6}$/";//ali9@yahoo.pk
    protected $cnic_pattern  			= "/^\d{5}[0-9]{7}\d{1}$/";	//4130312345671
    protected $contact_number_pattern 	= "/^[92]{2}\d{3}\d{7}$/";	//923001234567
    protected $flag						= true;
    protected $extensions				= ['png','jpg','jpeg'];


   public function check_validation($post,$files){
 		
 			$_SESSION['data'] = $post;
 			$_SESSION['data-file'] = $files;
 			extract($post);
 			
 			$_SESSION['flag_for_address'] = ($current_address === $permanent_address)?true:false;

 			$adult_member    = $adult;
 			$under_18_member = $children_under_age;

 			settype($adult_member,'int');
 			settype($under_18_member,'int');

 			$total_family_member = ($adult_member+$under_18_member);

 			// echo  $total_family_member;

 			if ($total_family_member > 0) {
 				$_SESSION['data']['total_family_member'] = $total_family_member;
 			}else{
 				$total_family_member = "";
 			}

 			$_SESSION['total_family_member'] = $total_family_member;

 			// echo "<pre>";
 			// print_r($_POST);
 			// print_r($_FILES);
 			// echo "</pre>";

 			// die();

 			/*Applicant FirstName Validation:Start*/
	 			if ($first_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['first_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $first_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['first_name'] = "First Name must be like eg: Ali ...";
	 			        }
	 			}
 			/*Applicant FirstName Validation:End*/

 			/*Applicant MiddleName Validation:Start*/
	 			if ($middle_name != "") {
	 			    
	 			    if (!preg_match($this->alpha_pattern, $middle_name)) {
	 			        $this->flag = false;   
	 			        $_SESSION['error']['middle_name'] = "Middle Name must be like eg: Ali ...";
	 			    }
	 			}
 			/*Applicant MiddleName Validation:End*/

 			/*Applicant LastName Validation:Start*/
	 			if ($last_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['last_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $last_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['last_name'] = "Last Name must be like eg: Khan ...";
	 			        }
	 			}
 			/*Applicant LastName Validation:End*/

 			/*Applicant Gender Validation:Start*/
	 			if (!isset($gender)) {
	 			    $this->flag = false;
		 			$_SESSION['error']['gender'] = "This field is required.";
	 			}
 			/*Applicant Gender Validation:End*/

 			/*Applicant ContactNumber Validation:Start*/
	 			if ($contact_number == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['contact_number'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->contact_number_pattern, $contact_number)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['contact_number'] = "Contact Numbers must be like eg: 923001234567";
	 			        }
	 			}
 			/*Applicant ContactNumber Validation:End*/

 			/*Applicant Email Validation:Start*/
	 			if ($email == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['email'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->email_pattern, $email)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['email'] = "Email must be like eg: ali9@yahoo.pk";
	 			        }
	 			}
 			/*Applicant Email Validation:End*/

 			/*Applicant DOB Validation:Start*/
	 			if ($date_of_birth == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['dob'] = "This field is required.";
	 			}
 			/*Applicant DOB Validation:End*/

 			/*Applicant CNIC Validation:Start*/
	 			if ($applicant_cnic == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['app_cnic'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->cnic_pattern, $applicant_cnic)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['app_cnic'] = "CNIC Numbers must be like eg: 4130312345671";
	 			        }
	 			}
 			/*Applicant CNIC Validation:End*/

 			/*Applicant Picture CNIC Validation Validation:Start*/
 				if($files['applicant_cnic_picture']['error'] == 4){
	 				$this->flag = false;
		 				$_SESSION['error']['applicant_cnic_picture'] = "This field is required.";
	 				
	 			}else{
	 				$file_extension = pathinfo($files['applicant_cnic_picture']['name'],PATHINFO_EXTENSION);	
	 				if(! (in_array(strtolower($file_extension),$this->extensions)) ){
	 					$this->flag = false;
		 				$_SESSION['error']['applicant_cnic_picture'] = "File extension must be eg: (png | jpg | jpeg)";
	 				}
	 			}
	 		/*Applicant Picture CNIC Validation Validation:End*/



 			/*Applicant CurrentAddress Validation:Start*/
	 			if ($current_address == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['current_address'] = "This field is required.";
	 			}
 			/*Applicant CurrentAddress Validation:End*/

 			/*Applicant PermanentAdress Validation:Start*/
	 			if ($current_address == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['permanent_address'] = "This field is required.";
	 			}
 			/*Applicant PermanentAdress Validation:End*/
 			

 			/*Applicant Picture Extension Validation:Start*/
	 			if($files['applicant_picture']['error'] == 4){
	 				$this->flag = false;
		 				$_SESSION['error']['applicant_picture'] = "This field is required.";
	 				
	 			}else{
	 				$file_extension = pathinfo($files['applicant_picture']['name'],PATHINFO_EXTENSION);	
	 				if(! (in_array(strtolower($file_extension),$this->extensions)) ){
	 					$this->flag = false;
		 				$_SESSION['error']['applicant_picture'] = "File extension must be eg: (png | jpg | jpeg)";
	 				}
	 			}
 			/*Applicant Picture Extension Validation:End*/

 			/*Applicant Student ID Card Image Extension Validation:Start*/
	 			if($files['applicant_student_id_card_image']['error'] == 4){
	 				$this->flag = false;
		 				$_SESSION['error']['applicant_student_id_card_image'] = "This field is required.";
	 				
	 			}else{
	 				$file_extension = pathinfo($files['applicant_student_id_card_image']['name'],PATHINFO_EXTENSION);	
	 				if(! (in_array(strtolower($file_extension),$this->extensions)) ){
	 					$this->flag = false;
		 				$_SESSION['error']['applicant_student_id_card_image'] = "File extension must be eg: (png | jpg | jpeg)";
	 				}
	 			}
 			/*Applicant Student ID Card Image Extension Validation:End*/
 			
 			/*Applicant HighestAcademic Degree Validation:Start*/
	 			if ($applicant_highest_academic_degree == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['highest_degree'] = "This field is required.";
	 			}
 			/*Applicant HighestAcademic Degree Validation:End*/

 			/*Applicant Marksheet Images Extension Validation:Start*/
	 			$count = 0;
	 			if( $files['applicant_marksheet_images']['error'][0] == 0 ){ //Condition:True Means No Files

	 				if(count($files['applicant_marksheet_images']['error']) < 2){
	 					$this->flag = false;
		 				$_SESSION['error']['applicant_marksheet_images'] = "Atleast Select 2 Marksheets";
		 			}else{
		 				foreach ($files['applicant_marksheet_images']['name'] as $key => $file) {
		 					$file_extension = pathinfo($files['applicant_marksheet_images']['name'][$key] , PATHINFO_EXTENSION);	
			 				if(! (in_array(strtolower($file_extension),$this->extensions)) ){
			 					$count++;
			 					break;
			 				}
		 				}

		 				if($count > 0){
		 					$this->flag = false;
				 			$_SESSION['error']['applicant_marksheet_images'] = "File extension must be eg: (png | jpg | jpeg)";
		 				}
		 			}
	 			}
 			/*Applicant Marksheet Images Extension Validation:End*/

 			/*Applicant Reason For Zakat Validation:Start*/
	 			if (isset($eligible_for_zakat) && $eligible_for_zakat == "Yes") {
	 			    
	 				if($reason_for_zakat == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['reason_for_zakat'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Reason For Zakat Validation:End*/

 			/*Applicant Death Certificate Validation:Start*/
	 			if(!isset($is_father_alive)){
	 				$this->flag = false;
			 		$_SESSION['error']['is_father_alive'] = "This field is required.";
	 			}
	 			elseif(isset($is_father_alive) && $is_father_alive == "No") {
	 			    
		 			if($files['applicant_father_death_certificate']['error'] !== 4){
		 				$file_extension = pathinfo($files['applicant_father_death_certificate']['name'],PATHINFO_EXTENSION);	
		 				if(! (in_array(strtolower($file_extension),$this->extensions)) ){
		 					$this->flag = false;
			 				$_SESSION['error']['death_certificate'] = "File extension must be eg: (png | jpg | jpeg)";
		 				}
		 			}
	 			}
 			/*Applicant Death Certificate Validation:End*/

 			/*Applicant Father CNIC Validation:Start*/
	 			if ($father_cnic == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['father_cnic'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->cnic_pattern, $father_cnic)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['father_cnic'] = "CNIC Numbers must be like eg: 4130312345671";
	 			        }
	 			}
 			/*Applicant Father CNIC Validation:End*/
 			
 			
 			/*Applicant Father FirstName Validation:Start*/
	 			if ($father_first_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['father_first_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $father_first_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['father_first_name'] = "First Name must be like eg: Ali ...";
	 			        }
	 			}
 			/*Applicant Father FirstName Validation:End*/

 			/*Applicant Father MiddleName Validation:Start*/
	 			if ($father_middle_name != "") {
	 			    
	 			    if (!preg_match($this->alpha_pattern, $father_middle_name)) {
	 			        $this->flag = false;   
	 			        $_SESSION['error']['father_middle_name'] = "Middle Name must be like eg: Ali ...";
	 			    }
	 			}
 			/*Applicant Father MiddleName Validation:End*/

 			/*Applicant Father LastName Validation:Start*/
	 			if ($father_last_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['error']['father_last_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $father_last_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['error']['father_last_name'] = "Last Name must be like eg: Khan ...";
	 			        }
	 			}
 			/*Applicant Father LastName Validation:End*/

 			/*Applicant Father Occupation Validation:Start*/
	 			if($father_occupation == ""){
		 			$this->flag = false;
			 		$_SESSION['error']['father_occupation'] = "This field is required.";
		 		}
 			/*Applicant Father Occupation Validation:End*/

 			/*Applicant Currently Enrolled At University Validation:Start*/
	 			if(!isset($is_currently_enrolled_in_uni)){
	 				$this->flag = false;
			 		$_SESSION['error']['is_currently_enrolled_in_uni'] = "This field is required.";
	 			}
	 			elseif(isset($is_currently_enrolled_in_uni) && $is_currently_enrolled_in_uni == "Yes") {
	 			    
		 			if($univerity == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['univerity'] = "This field is required.";
	 				}

	 				if($univerity_year == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['univerity_year'] = "This field is required.";
	 				}

	 				if($degree_completed_year == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['degree_completed_year'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Currently Enrolled At University Validation:End*/
 			
 			/*Applicant University Admission Validation:Start*/
	 			if (!isset($applicant_university_admission)) {
	 			    $this->flag = false;
		 			$_SESSION['error']['applicant_university_admission'] = "This field is required.";
	 			}
 			/*Applicant University Admission Validation:End*/

 			/*Applicant Currently Working Validation:Start*/
	 			if(!isset($is_currently_working)){
	 				$this->flag = false;
			 		$_SESSION['error']['is_currently_working'] = "This field is required.";
	 			}
	 			elseif(isset($is_currently_working) && $is_currently_working == "Yes") {
	 			    
		 			if($how_much_earning == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['how_much_earning'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Currently Working Validation:End*/
 			
 			/*Applicant Skill Validation:Start*/
	 			if(!isset($applicant_skill)){
	 				$this->flag = false;
			 		$_SESSION['error']['applicant_skill'] = "This field is required.";
	 			}
	 			elseif(isset($applicant_skill) && $applicant_skill == "Yes") {
	 			    
		 			if($what_skill == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['what_skill'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Skill Validation:End*/ 			

 			/*Applicant Currently Enrolled At University Validation:Start*/
	 			if(!isset($financial_help)){
	 				$this->flag = false;
			 		$_SESSION['error']['financial_help'] = "This field is required.";
	 			}
	 			elseif(isset($financial_help) && $financial_help == "Yes") {
	 			    
		 			if($how_much_financial_help == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['how_much_financial_help'] = "This field is required.";
	 				}

	 				if($from_where_financial_help == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['from_where_financial_help'] = "This field is required.";
	 				}

	 				if($files['financial_help_image']['error'] == 4){
	 					$this->flag = false;
		 				$_SESSION['error']['financial_help_image'] = "This field is required.";
	 				}
	 				else{
	 					$file_extension = pathinfo($files['financial_help_image']['name'],PATHINFO_EXTENSION);	
		 				if(! (in_array(strtolower($file_extension),$this->extensions)) ){
		 					$this->flag = false;
			 				$_SESSION['error']['financial_help_image'] = "File extension must be eg: (png | jpg | jpeg)";
		 				}
	 				}
	 			}
	 		/*Applicant Currently Enrolled At University Validation:End*/

	 		/*Applicant Total Number of Family Members Validation:Start*/
	 			if($total_family_member == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['total_family_member'] = "This field is required.";
	 				}

 				if($adult == ""){
 					$this->flag = false;
	 				$_SESSION['error']['adult'] = "This field is required.";
 				}

 				if($children_under_age == ""){
 					$this->flag = false;
	 				$_SESSION['error']['children_under_age'] = "This field is required.";
 				}
 			/*Applicant Total Number of Family Members Validation:End*/

 			/*Applicant Total Monthly Family Income Validation:Start*/
	 			if($total_family_monthly_income == ""){
	 					$this->flag = false;
		 				$_SESSION['error']['total_family_monthly_income'] = "This field is required.";
	 				}

 				if($how_many_earning_members == ""){
 					$this->flag = false;
	 				$_SESSION['error']['how_many_earning_members'] = "This field is required.";
 				}
 			/*Applicant Total Monthly Family Income Validation:End*/

 			/*Applicant Agreement Validation:Start*/
	 			if (!isset($agreement)) {
	 			    $this->flag = false;
		 			$_SESSION['error']['agreement'] = "You must agree before submitting.";
	 			}
 			/*Applicant Agreement Validation:End*/

 			/*Applicant Form Submit Button Message Validation:Start*/

	 			if ($this->flag == false) {
	 				$_SESSION['error']['appropriate'] = "To Submit Your Application, Please fill out the form appropriately.";
	 			}
 			
 			/*Applicant Form Submit Button Message Validation:End*/

 			return $this->flag;	  
 	}

 	public function check_validation_for_update_record($post){

 		   unset($_SESSION['update-error']);
 		
 			$_SESSION['update-data'] = $post;
 			extract($post);
 			
 			$_SESSION['flag_for_address'] = ($current_address === $permanent_address)?true:false;

 			$adult_member    = $adult;
 			$under_18_member = $children_under_age;

 			settype($adult_member,'int');
 			settype($under_18_member,'int');

 			$total_family_member = ($adult_member+$under_18_member);

 			if ($total_family_member > 0) {
 				$_SESSION['update-data']['total_family_member'] = $total_family_member;
 				$_SESSION['total_family_member'] = $total_family_member;
 			}else{
 				$total_family_member = "";
 			}

 			/*Applicant FirstName Validation:Start*/
	 			if ($first_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['first_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $first_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['first_name'] = "First Name must be like eg: Ali ...";
	 			        }
	 			}
 			/*Applicant FirstName Validation:End*/

 			/*Applicant MiddleName Validation:Start*/
	 			if ($middle_name != "") {
	 			    
	 			    if (!preg_match($this->alpha_pattern, $middle_name)) {
	 			        $this->flag = false;   
	 			        $_SESSION['update-error']['middle_name'] = "Middle Name must be like eg: Ali ...";
	 			    }
	 			}
 			/*Applicant MiddleName Validation:End*/

 			/*Applicant LastName Validation:Start*/
	 			if ($last_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['last_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $last_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['last_name'] = "Last Name must be like eg: Khan ...";
	 			        }
	 			}
 			/*Applicant LastName Validation:End*/

 			/*Applicant Gender Validation:Start*/
	 			if (!isset($gender)) {
	 			    $this->flag = false;
		 			$_SESSION['update-error']['gender'] = "This field is required.";
	 			}
 			/*Applicant Gender Validation:End*/

 			/*Applicant ContactNumber Validation:Start*/
	 			if ($contact_number == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['contact_number'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->contact_number_pattern, $contact_number)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['contact_number'] = "Contact Numbers must be like eg: 923001234567";
	 			        }
	 			}
 			/*Applicant ContactNumber Validation:End*/

 			/*Applicant Email Validation:Start*/
	 			if ($email == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['email'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->email_pattern, $email)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['email'] = "Email must be like eg: ali9@yahoo.pk";
	 			        }
	 			}
 			/*Applicant Email Validation:End*/

 			/*Applicant DOB Validation:Start*/
	 			if ($date_of_birth == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['dob'] = "This field is required.";
	 			}
 			/*Applicant DOB Validation:End*/

 			/*Applicant CNIC Validation:Start*/
	 			if ($applicant_cnic == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['app_cnic'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->cnic_pattern, $applicant_cnic)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['app_cnic'] = "CNIC Numbers must be like eg: 4130312345671";
	 			        }
	 			}
 			/*Applicant CNIC Validation:End*/

 		

 			/*Applicant CurrentAddress Validation:Start*/
	 			if ($current_address == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['current_address'] = "This field is required.";
	 			}
 			/*Applicant CurrentAddress Validation:End*/

 			/*Applicant PermanentAdress Validation:Start*/
	 			if ($current_address == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['permanent_address'] = "This field is required.";
	 			}
 			/*Applicant PermanentAdress Validation:End*/

 			
 			/*Applicant HighestAcademic Degree Validation:Start*/
	 			if ($applicant_highest_academic_degree == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['highest_degree'] = "This field is required.";
	 			}
 			/*Applicant HighestAcademic Degree Validation:End*/


 			/*Applicant Reason For Zakat Validation:Start*/
	 			if (isset($eligible_for_zakat) && $eligible_for_zakat == "Yes") {
	 			    
	 				if($reason_for_zakat == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['reason_for_zakat'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Reason For Zakat Validation:End*/

 			/*Applicant Death Certificate Validation:Start*/
	 			if(!isset($is_father_alive)){
	 				$this->flag = false;
			 		$_SESSION['update-error']['is_father_alive'] = "This field is required.";
	 			}
 			/*Applicant Death Certificate Validation:End*/

 			/*Applicant Father CNIC Validation:Start*/
	 			if ($father_cnic == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['father_cnic'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->cnic_pattern, $father_cnic)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['father_cnic'] = "CNIC Numbers must be like eg: 4130312345671";
	 			        }
	 			}
 			/*Applicant Father CNIC Validation:End*/
 			
 			
 			/*Applicant Father FirstName Validation:Start*/
	 			if ($father_first_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['father_first_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $father_first_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['father_first_name'] = "First Name must be like eg: Ali ...";
	 			        }
	 			}
 			/*Applicant Father FirstName Validation:End*/

 			/*Applicant Father MiddleName Validation:Start*/
	 			if ($father_middle_name != "") {
	 			    
	 			    if (!preg_match($this->alpha_pattern, $father_middle_name)) {
	 			        $this->flag = false;   
	 			        $_SESSION['update-error']['father_middle_name'] = "Middle Name must be like eg: Ali ...";
	 			    }
	 			}
 			/*Applicant Father MiddleName Validation:End*/

 			/*Applicant Father LastName Validation:Start*/
	 			if ($father_last_name == "") {
	 			    $this->flag = false;
	 				$_SESSION['update-error']['father_last_name'] = "This field is required.";
	 			}else{
	 					if (!preg_match($this->alpha_pattern, $father_last_name)) {
	 			            $this->flag = false;   
	 			            $_SESSION['update-error']['father_last_name'] = "Last Name must be like eg: Khan ...";
	 			        }
	 			}
 			/*Applicant Father LastName Validation:End*/

 			/*Applicant Father Occupation Validation:Start*/
	 			if($father_occupation == ""){
		 			$this->flag = false;
			 		$_SESSION['update-error']['father_occupation'] = "This field is required.";
		 		}
 			/*Applicant Father Occupation Validation:End*/

 			/*Applicant Currently Enrolled At University Validation:Start*/
	 			if(!isset($is_currently_enrolled_in_uni)){
	 				$this->flag = false;
			 		$_SESSION['update-error']['is_currently_enrolled_in_uni'] = "This field is required.";
	 			}
	 			elseif(isset($is_currently_enrolled_in_uni) && $is_currently_enrolled_in_uni == "Yes") {
	 			    
		 			if($university == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['university'] = "This field is required.";
	 				}

	 				if($university_year == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['university_year'] = "This field is required.";
	 				}

	 				if($degree_completed_year == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['degree_completed_year'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Currently Enrolled At University Validation:End*/
 			
 			/*Applicant University Admission Validation:Start*/
	 			if (!isset($applicant_university_admission)) {
	 			    $this->flag = false;
		 			$_SESSION['update-error']['applicant_university_admission'] = "This field is required.";
	 			}
 			/*Applicant University Admission Validation:End*/

 			/*Applicant Currently Working Validation:Start*/
	 			if(!isset($is_currently_working)){
	 				$this->flag = false;
			 		$_SESSION['update-error']['is_currently_working'] = "This field is required.";
	 			}
	 			elseif(isset($is_currently_working) && $is_currently_working == "Yes") {
	 			    
		 			if($how_much_earning == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['how_much_earning'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Currently Working Validation:End*/
 			
 			/*Applicant Skill Validation:Start*/
	 			if(!isset($applicant_skill)){
	 				$this->flag = false;
			 		$_SESSION['update-error']['applicant_skill'] = "This field is required.";
	 			}
	 			elseif(isset($applicant_skill) && $applicant_skill == "Yes") {
	 			    
		 			if($what_skill == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['what_skill'] = "This field is required.";
	 				}
	 			}
 			/*Applicant Skill Validation:End*/ 			

 			/*Applicant Financial Validation:Start*/
	 			if(!isset($financial_help)){
	 				$this->flag = false;
			 		$_SESSION['update-error']['financial_help'] = "This field is required.";
	 			}
	 			elseif(isset($financial_help) && $financial_help == "Yes") {
	 			    
		 			if($how_much_financial_help == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['how_much_financial_help'] = "This field is required.";
	 				}

	 				if($from_where_financial_help == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['from_where_financial_help'] = "This field is required.";
	 				}	 				
	 			}
	 		/*Applicant Financial Validation:End*/

	 		/*Applicant Total Number of Family Members Validation:Start*/
	 			if($total_family_member == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['total_family_member'] = "This field is required.";
	 				}

 				if($adult == ""){
 					$this->flag = false;
	 				$_SESSION['update-error']['adult'] = "This field is required.";
 				}

 				if($children_under_age == ""){
 					$this->flag = false;
	 				$_SESSION['update-error']['children_under_age'] = "This field is required.";
 				}
 			/*Applicant Total Number of Family Members Validation:End*/

 			/*Applicant Total Monthly Family Income Validation:Start*/
	 			if($total_family_monthly_income == ""){
	 					$this->flag = false;
		 				$_SESSION['update-error']['total_family_monthly_income'] = "This field is required.";
	 				}

 				if($how_many_earning_members == ""){
 					$this->flag = false;
	 				$_SESSION['update-error']['how_many_earning_members'] = "This field is required.";
 				}
 			/*Applicant Total Monthly Family Income Validation:End*/

 			/*Applicant Agreement Validation:Start*/
	 			/*if (!isset($agreement)) {
	 			    $this->flag = false;
		 			$_SESSION['error']['agreement'] = "You must agree before submitting.";
	 			}*/
 			/*Applicant Agreement Validation:End*/

 			/*Applicant Form Submit Button Message Validation:Start*/

	 			if ($this->flag == false) {
	 				$_SESSION['update-error']['appropriate'] = "To Submit Your Application, Please fill out the form appropriately.";
	 			}
 			
 			/*Applicant Form Submit Button Message Validation:End*/

 			return $this->flag;	  
 	}
 

 }
?>