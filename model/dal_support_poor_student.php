 <?php
	require_once("../../library/database.php");

	class Support_Poor_Student extends Database
	{
		protected $connection 		= NULL;
		protected $query			= NULL;
		protected $result			= NULL;

		public function __construct()
		{
			$this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

			if(mysqli_connect_errno())
			{
				echo "<p style='color: red'>Database Connection Problem <b>Error No: </b>".mysqli_connect_errno()." <b>Error Message: </b>".mysqli_connect_error()."</p>";
			}
		}

		public function get_all_beneficiary()
		{
			// $this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name, dt.academic_degree_attachment ";
			$this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name ";
			$this->query .= "FROM beneficiary b ";
			$this->query .= "INNER JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
			$this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
			$this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
			// $this->query .= "LEFT JOIN academic_degree_attachment dt ON dt.academic_degree_id = d.academic_degree_id ";
			$this->query .= "ORDER BY b.beneficiary_id DESC ";
		

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;
		}

		public function get_all_beneficiary_degree_attachments($beneficiary_id)
		{
			// $this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name, dt.academic_degree_attachment ";
			$this->query = "SELECT * FROM academic_degree_attachment WHERE beneficiary_id='{$beneficiary_id}' ORDER BY beneficiary_id DESC ";
		
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;
		}
		

		public function add_beneficiary($beneficiary_data = array())
		{
			echo "<pre>";
			print_r($beneficiary_data);
			echo "</pre>";
			
			extract($beneficiary_data);

			$this->query  = "INSERT INTO beneficiary";
			$this->query .= " ( ";	
			$this->query .= " academic_degree_id, applicant_first_name, applicant_middle_name, applicant_last_name, applicant_gender, ";	
			$this->query .= " applicant_contact_number, applicant_email, applicant_date_of_birth, applicant_cnic, applicant_current_address, ";	
			$this->query .= " applicant_permanent_address, ";

			if(isset($stipend_for_non_muslim)){
				$this->query .= "applicant_apply_for_stipend,  ";
			}

			if(isset($eligible_for_zakat)){
				$this->query .= "applicant_eligible_receive_zakat,  ";
			}

			$this->query .= "applicant_reason_receive_zakat, ";

			$this->query .= " is_father_alive, father_cnic, father_first_name, father_middle_name, father_last_name, father_occupation, ";	
			$this->query .= " applicant_currently_enrolled, applicant_university_admission_type,  ";
			
			if(isset($university) && isset($university_year) && isset($degree_completed_year)){
				$this->query .= "unversity_id, current_enrolled_year_id, passing_degree_year, ";
			}

			$this->query .= "expense_Of_education, applicant_currently_working, applicant_how_much_earn_per_month, does_applicant_have_skills, what_applicant_skills, ";
			$this->query .= " applicant_receive_financial_help, how_much_applicant_received_financial_help, from_where, total_number_of_family_member, ";	
			$this->query .= " total_adults, total_childrens, total_monthly_family_income, how_many_earning_family_members, created_at ";	
			$this->query .= " ) ";	
			
			$this->query .= " VALUES ( ";	
			$this->query .= " '".$applicant_highest_academic_degree."' ,  '".$first_name."', '".$middle_name."', '".$last_name."' , '".$gender."', ";	
			$this->query .= " '".$contact_number."' ,  '".$email."', '".$date_of_birth."', '".$applicant_cnic."' , '".htmlspecialchars($current_address,true)."', ";	
			$this->query .= " '".htmlspecialchars($permanent_address,true)."',  ";	
			
			if(isset($stipend_for_non_muslim)){
				$this->query .= " '".$stipend_for_non_muslim."',  ";
			}

			if(isset($eligible_for_zakat)){
				$this->query .= " '".$eligible_for_zakat."',  ";
			}

			$this->query .= "'".$reason_for_zakat."', '".$is_father_alive."' ,  '".$father_cnic."', '".$father_first_name."', '".$father_middle_name."', '".$father_last_name."', ";	
			$this->query .= " '".$father_occupation."' ,  '".$is_currently_enrolled_in_uni."', '".$applicant_university_admission."',  ";	
			
			if(isset($university) && isset($university_year) && isset($degree_completed_year)){
				$this->query .= " '".$university."', '".$university_year."' , '".$degree_completed_year."', ";	
			}

			$this->query .= "'".htmlspecialchars($degree_yearly_expenses,true)."', '".$is_currently_working."', '".$how_much_earning."', ";	
			
			$this->query .= " '".$applicant_skill."' ,  '".$what_skill."', '".$financial_help."', '".htmlspecialchars($how_much_financial_help, true)."', ";	
			$this->query .= " '".htmlspecialchars($from_where_financial_help, true)."' ,  '".htmlspecialchars($total_family_member,true)."', '".htmlspecialchars($adult,true)."', ";	
			
			$this->query .= " '".htmlspecialchars($children_under_age, true)."' ,  '".htmlspecialchars($total_family_monthly_income,true)."', '".htmlspecialchars($how_many_earning_members,true)."' ,  CURRENT_DATE  ";	
			
			$this->query .= " ) ";	

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			

			return $this->result;

		}

        public function set_beneficiary_profile_picture($applicant_picture,
        							$applicant_first_name,$applicant_last_name,$last_insert_id)
        {   
           

            if ($applicant_picture != NULL) {

            	$dir = '../assets/profile_picture';

            	if (!is_dir($dir)) {
            		mkdir($dir);	
            	}
            	
            	$extension = pathinfo($applicant_picture['name'], PATHINFO_EXTENSION);
            	$filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
            	$path = $dir."/".$filename;
                if(move_uploaded_file($applicant_picture['tmp_name'], $path)){

                   $this->query = "UPDATE beneficiary SET applicant_picture = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                   $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
					return $this->result;  
                }
             } 

            return false;
        }

         public function set_beneficiary_student_id_card_image($applicant_student_id_card_image,$last_insert_id)
        {   
           

            if ($applicant_student_id_card_image != NULL) {

            	$dir = '../assets/student_id_card_image';

            	if (!is_dir($dir)) {
            		mkdir($dir);	
            	}
            	
            	$filename = $last_insert_id."_".$applicant_student_id_card_image['name'];
            	$path = $dir."/".$filename;
                if(move_uploaded_file($applicant_student_id_card_image['tmp_name'], $path)){

                   $this->query = "UPDATE beneficiary SET applicant_student_id_card_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                   $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
					return $this->result;  
                }
             } 

            return false;
        }
        public function set_beneficiary_marksheets($applicant_marksheet,$last_insert_id)
        {   
           

            if ($applicant_marksheet != NULL) {

            	$dir = '../assets/marksheets';

            	if (!is_dir($dir)) {
            		mkdir($dir);	
            	}
            	
	            // $this->query = "SELECT academic_degree_id FROM  beneficiary  WHERE beneficiary_id=".$last_insert_id; 
	            // $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

	            // $academic_degree_id =  mysqli_fetch_assoc($this->result);

            	foreach ($applicant_marksheet['name'] as $key => $file) {
            		$filename = $last_insert_id."_".$applicant_marksheet['name'][$key];
	            	$path = $dir."/".$filename;
	                if(move_uploaded_file($applicant_marksheet['tmp_name'][$key], $path)){

	                   $this->query = "INSERT INTO academic_degree_attachment  (beneficiary_id,academic_degree_attachment,created_at) VALUES ('".  $last_insert_id  ."', '". $path ."', CURRENT_DATE  )"; 

	                   $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
				
	                }
            	}
				
				return $this->result;  
            	
             } 

            return false;
        }


        public function set_beneficiary_father_death_certificate($death_certificate,$last_insert_id)
        {   
           
        	if ($death_certificate != NULL) {

            	$dir = '../assets/father_death_certificate';

            	if (!is_dir($dir)) {
            		mkdir($dir);	
            	}
            	$filename = $last_insert_id."_".$death_certificate['name'];
            	$path = $dir."/".$filename;
                if(move_uploaded_file($death_certificate['tmp_name'], $path)){

                   $this->query = "UPDATE beneficiary SET father_death_certificate_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                   $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
					return $this->result;  
                }
             } 

            return false;
        }

        public function set_beneficiary_cnic_picture($cnic_picture,$last_insert_id)
                {   
                   	
                	if ($cnic_picture != NULL) {

                    	$dir = '../assets/applicant_cnic_picture';

                    	if (!is_dir($dir)) {
                    		mkdir($dir);	
                    	}
                    	$filename = $last_insert_id."_".$cnic_picture['name'];
                    	$path = $dir."/".$filename;
                        if(move_uploaded_file($cnic_picture['tmp_name'], $path)){

                           $this->query = "UPDATE beneficiary SET applicant_cnic_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                           $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
        			
        					return $this->result;  
                        }
                     } 

                    return false;
                }


        public function set_beneficiary_financial_help_picture($financial_help_picture,$last_insert_id)
        {   
           
        	if ($financial_help_picture != NULL) {

            	$dir = '../assets/financial_help_picture';

            	if (!is_dir($dir)) {
            		mkdir($dir);	
            	}
            	$filename = $last_insert_id."_".$financial_help_picture['name'];
            	$path = $dir."/".$filename;
                if(move_uploaded_file($financial_help_picture['tmp_name'], $path)){

                   $this->query = "UPDATE beneficiary SET financial_help_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                   $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
					return $this->result;  
                }
             } 

            return false;
        }
		
		public function get_last_id(){

			return mysqli_insert_id($this->connection);

		}

		public function checked_email($email){
			$this->query = "SELECT applicant_email FROM  beneficiary  WHERE applicant_email= '".$email."' "; 
	        $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			return mysqli_num_rows($this->result);
		}

		public function checked_cnic($cnic){
			$this->query = "SELECT applicant_cnic FROM  beneficiary  WHERE applicant_cnic= '".$cnic."' "; 
	        $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			return mysqli_num_rows($this->result);
		}
		
		public function get_single_beneficiary($beneficiary_id)
		{
			
			$this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name ";
			$this->query .= "FROM beneficiary b ";
			$this->query .= "INNER JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
			$this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
			$this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
			$this->query .= "WHERE b.beneficiary_id = $beneficiary_id ";
		    $this->query .= "ORDER BY b.beneficiary_id DESC ";
		

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;
		} 

		public function update_beneficiary($beneficiary_data = array(),$beneficiary_id)
		{
			// echo "<pre>";
			// print_r($beneficiary_data);
			// echo "</pre>";
			// die();
			
			extract($beneficiary_data);


			$this->query  = "UPDATE beneficiary SET";	
			$this->query .= " academic_degree_id = $applicant_highest_academic_degree, applicant_first_name = '{$first_name}', applicant_middle_name = '{$middle_name}', applicant_last_name = '{$last_name}', applicant_gender = '{$gender}', ";	
			$this->query .= " applicant_contact_number = $contact_number, applicant_email = '{$email}', applicant_date_of_birth = '{$date_of_birth}', applicant_cnic = '{$applicant_cnic}', applicant_current_address = '".htmlspecialchars($current_address,true)."', applicant_permanent_address = '".htmlspecialchars($permanent_address,true)."', ";	

			if(isset($stipend_for_non_muslim)){
				$this->query .= "applicant_apply_for_stipend = '{$stipend_for_non_muslim}',  ";
			}

				$this->query .= "applicant_eligible_receive_zakat = '{$eligible_for_zakat}',  ";
			// if(isset($eligible_for_zakat)){
			// }

			$this->query .= "applicant_reason_receive_zakat = '{$reason_for_zakat}', ";

			$this->query .= " is_father_alive = '{$is_father_alive}', father_cnic = '{$father_cnic}', father_first_name = '{$father_first_name}', father_middle_name = '{$father_middle_name}', father_last_name = '{$father_last_name}', father_occupation = '{$father_occupation}', ";	
			$this->query .= " applicant_currently_enrolled = '{$is_currently_enrolled_in_uni}', applicant_university_admission_type = '{$applicant_university_admission}',  ";
			
			

			$this->query .= "expense_Of_education = '".htmlspecialchars($degree_yearly_expenses,true)."', applicant_currently_working = '{$is_currently_working}', applicant_how_much_earn_per_month = '{$how_much_earning}', does_applicant_have_skills = '{$applicant_skill}', what_applicant_skills = '{$what_skill}', ";
			$this->query .= " applicant_receive_financial_help = '{$financial_help}', how_much_applicant_received_financial_help = '".htmlspecialchars($how_much_financial_help, true)."', from_where = '".htmlspecialchars($from_where_financial_help, true)."', total_number_of_family_member = '".htmlspecialchars($total_family_member,true)."', ";	
			$this->query .= " total_adults = '".htmlspecialchars($adult,true)."', total_childrens = '".htmlspecialchars($children_under_age,true)."', total_monthly_family_income = '".htmlspecialchars($total_family_monthly_income,true)."', how_many_earning_family_members = '".htmlspecialchars($how_many_earning_members,true)."'";	
		    $this->query .= " WHERE beneficiary_id = $beneficiary_id ";	
			
				// echo "<br/><hr/>";

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			if ($this->result) {
				
				if(isset($university) && isset($university_year) && isset($degree_completed_year)){
					$this->query = "UPDATE beneficiary SET unversity_id= '{$university}', current_enrolled_year_id = '{$university_year}', passing_degree_year = '{$degree_completed_year}' WHERE beneficiary_id = ".$beneficiary_id;
				}else{
					$this->query = "UPDATE beneficiary SET unversity_id= NULL, current_enrolled_year_id = NULL, passing_degree_year = NULL WHERE beneficiary_id = ".$beneficiary_id;
				}

				$this->result = mysqli_query($this->connection,$this->query);

				// echo $this->query;
			}
			

			return $this->result;

		}


		public function __destruct()
		{
			mysqli_close($this->connection);
		}
	}
?>