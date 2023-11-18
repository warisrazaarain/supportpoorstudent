 <?php
	require_once("../../library/database.php");

	class Support_Poor_Student extends Database
	{
		protected $connection 		= NULL;
		protected $query			= NULL;
		protected $result			= NULL;

		public function __construct()
		{
			mysqli_report(false);
      $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

			if(mysqli_connect_errno())
			{
				echo "<p style='color: red'>Database Connection Problem <b>Error No: </b>".mysqli_connect_errno()." <b>Error Message: </b>".mysqli_connect_error()."</p>";
			}
		}

		/* Get Beneficiary records on behalf of user assigned university: Start*/
        public function get_all_beneficiary($user_id=null,$user_type=null)
        {
          if(isset($user_type) && $user_type == 0){
              $x = "WHERE is_form_saved = '0' AND s.user_id = $user_id ";
          }else{
            $x = " WHERE is_form_saved = '0' ";
          }
          $this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name,s.* ";
          $this->query .= "FROM beneficiary b ";
          $this->query .= "LEFT JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
          $this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
          $this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
          $this->query .= "LEFT JOIN user_university s ON b.unversity_id = s.university_id ";
          $this->query .= $x;
          $this->query .= "ORDER BY b.is_form_submitted DESC , b.application_status ASC ";
          
          $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
          
          return $this->result;
        }
    /* Get Beneficiary records on behalf of user assigned university: End*/

		/*Get marksheets images of a beneficiary id :Start*/
		public function get_all_beneficiary_degree_attachments($beneficiary_id)
		{
			// $this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name, dt.academic_degree_attachment ";
			$this->query = "SELECT * FROM academic_degree_attachment WHERE beneficiary_id='{$beneficiary_id}' ORDER BY beneficiary_id DESC ";
		
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;
		}
		/*Get marksheets images of a beneficiary id :End*/
			
    /**/
    public function add_beneficiary($beneficiary_data = array())
      {
        // echo "<pre>";
        // print_r($beneficiary_data);
        // echo "</pre>";
        // echo "yes i m";
        // die();
        
        extract($beneficiary_data);

        $this->query  = "INSERT INTO beneficiary";
        $this->query .= " ( ";

        if(isset($applicant_highest_academic_degree) && $applicant_highest_academic_degree !=''){
           $this->query .= "academic_degree_id,  ";
        }

        $this->query .= "applicant_first_name, applicant_middle_name, applicant_last_name, applicant_gender, "; 
        $this->query .= " applicant_contact_number, applicant_email, applicant_date_of_birth, ";  

        if(isset($applicant_cnic)){
           $this->query .= "applicant_cnic,  ";
        }

        $this->query .= "applicant_current_address, applicant_permanent_address, ";

        if(isset($stipend_for_non_muslim)){
          $this->query .= "applicant_apply_for_stipend,  ";
        }

        if(isset($eligible_for_zakat)){
          $this->query .= "applicant_eligible_receive_zakat,  ";
        }

        $this->query .= "applicant_reason_receive_zakat, ";

        $this->query .= " is_father_alive, father_cnic, father_first_name, father_middle_name, father_last_name, father_occupation, ";  
        $this->query .= " applicant_currently_enrolled, applicant_university_admission_type,  ";
        
        /*if(isset($university) && $university !='' && isset($university_year) && isset($degree_completed_year)){
          $this->query .= "unversity_id, current_enrolled_year_id, passing_degree_year, ";
        }*/

        if (isset($university) && $university !='') {
          $this->query .= "unversity_id,";
        }

        if (isset($university_year) && $university_year !='') {
          $this->query .= "current_enrolled_year_id,";
        }

        if (isset($degree_completed_year) && $degree_completed_year !='1970-01-01') {
          $this->query .= "passing_degree_year,";
        }

        $this->query .= "expense_Of_education, applicant_currently_working, applicant_how_much_earn_per_month, does_applicant_have_skills, what_applicant_skills, ";
        $this->query .= " applicant_receive_financial_help, how_much_applicant_received_financial_help, from_where, total_number_of_family_member, "; 
        $this->query .= " total_adults, total_childrens, total_monthly_family_income, how_many_earning_family_members, created_at, is_form_submitted "; 

        if ($bank_name !='') {
          $this->query .= ", bank_name";
        }
        if ($bank_branch_name !='') {
          $this->query .= ", bank_branch_name";
        }
        if ($bank_account_title !='') {
          $this->query .= ", bank_account_title";
        }
        if ($bank_account_number !='') {
          $this->query .= ", bank_account_number";
        }
        $this->query .= ", is_form_saved"; 
        $this->query .= " ) ";  
        
        $this->query .= " VALUES ( "; 

        if(isset($applicant_highest_academic_degree) && $applicant_highest_academic_degree !=''){
           $this->query .= " '".$applicant_highest_academic_degree."', ";
        }

        $this->query .= "'".ucfirst(strtolower($first_name))."', '".ucfirst(strtolower($middle_name))."', '".ucfirst(strtolower($last_name))."' , '".$gender."', "; 

        $this->query .= " '".$contact_number."' ,  '".$email."', '".$date_of_birth."',";

        if(isset($applicant_cnic) && $applicant_cnic !=''){
           $this->query .= " '".$applicant_cnic."', ";
        }else{
          $this->query .= "NULL,";
        }

        $this->query .= " '".htmlspecialchars($current_address,true)."','".htmlspecialchars($permanent_address,true)."',  ";  
        
        if(isset($stipend_for_non_muslim)){
          $this->query .= " '".$stipend_for_non_muslim."',  ";
        }

        if(isset($eligible_for_zakat)){
          $this->query .= " '".$eligible_for_zakat."',  ";
        }

        $this->query .= "'".$reason_for_zakat."', '".$is_father_alive."' ,  '".$father_cnic."', '".ucfirst(strtolower($father_first_name))."', '".ucfirst(strtolower($father_middle_name))."', '".ucfirst(strtolower($father_last_name))."', "; 
        $this->query .= " '".$father_occupation."' ,  '".$is_currently_enrolled_in_uni."', '".$applicant_university_admission."',  "; 
        
        /*if(isset($university) && $university !='' && isset($university_year) && isset($degree_completed_year)){
          $this->query .= " '".$university."', '".$university_year."' , '".$degree_completed_year."', ";  
        }*/

        if (isset($university) && $university !='') {
          $this->query .= " '".$university."',";
        }

        if (isset($university_year) && $university_year !='') {
          $this->query .= "'".$university_year."' , ";
        }

        if (isset($degree_completed_year) && $degree_completed_year !='1970-01-01') {
          $this->query .= "'".$degree_completed_year."', ";
        }

        $this->query .= "'".htmlspecialchars($degree_yearly_expenses,true)."', '".$is_currently_working."', '".$how_much_earning."', "; 
        
        $this->query .= " '".$applicant_skill."' ,  '".$what_skill."', '".$financial_help."', '".htmlspecialchars($how_much_financial_help, true)."', ";  
        $this->query .= " '".htmlspecialchars($from_where_financial_help, true)."' ,  '".htmlspecialchars($total_family_member,true)."', '".htmlspecialchars($adult,true)."', ";  
        
        $this->query .= " '".htmlspecialchars($children_under_age, true)."' ,  '".htmlspecialchars($total_family_monthly_income,true)."', '".htmlspecialchars($how_many_earning_members,true)."' ,  CURRENT_DATE, '1',  "; 


        if ($bank_name !='') {
          $this->query .= " '".htmlspecialchars($bank_name, true)."' ,";
        }
        if ($bank_branch_name !='') {
          $this->query .= " '".htmlspecialchars($bank_branch_name, true)."' ,";
        }
        if ($bank_account_title !='') {
          $this->query .= " '".htmlspecialchars($bank_account_title, true)."' ,";
        }
        if ($bank_account_number !='') {
          $this->query .= " '".htmlspecialchars($bank_account_number, true)."' ,";
        }
        $this->query .= "'".$hidden_value."'";
        
         $this->query .= " ) ";
        /* echo $this->query;
          die(); */    

        $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
        

        return $this->result;

      }
    /**/
		
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

    public function set_beneficiary_student_id_card_image($applicant_student_id_card_image,$applicant_first_name,$applicant_last_name,$last_insert_id,$is_add = true)
    {   
       
    	if ($applicant_student_id_card_image != NULL) {

        	$dir = '../assets/student_id_card_image';

        	if (!is_dir($dir)) {
        		mkdir($dir);	
        	}
        	
        	/**/
        	$extension = pathinfo($applicant_student_id_card_image['name'], PATHINFO_EXTENSION);
        	$filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
        	/**/

          /*For delete the picture :Start*/
          if(!$is_add){
              $row = $this->get_all_picture_from_beneficiary_table($last_insert_id);
              if($row->num_rows > 0){
                  $data = mysqli_fetch_assoc($row);
                  if(file_exists($data['applicant_student_id_card_image'])){
                    unlink($data['applicant_student_id_card_image']);
                  }
              }
          }
          /*For delete the picture :End*/
        	
        	// $filename = $last_insert_id."_".$applicant_student_id_card_image['name'];
        	
        	$path = $dir."/".$filename;
            if(move_uploaded_file($applicant_student_id_card_image['tmp_name'], $path)){

              $this->query = "UPDATE beneficiary SET applicant_student_id_card_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

              $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
	
			       return $this->result;  
            }
         } 

        return false;
    }
    
    public function set_beneficiary_marksheets($applicant_marksheet,$applicant_first_name,$applicant_last_name,$last_insert_id,$is_add = true)
    {   
       
    	if ($applicant_marksheet != NULL) {

        	$dir = '../assets/marksheets';

        	if (!is_dir($dir)) {
        		mkdir($dir);	
        	}
        	
        	/*For delete the picture :Start*/
        	if(!$is_add){
          	
        		$this->delete_attachments($last_insert_id);
          	$rows = $this->get_all_beneficiary_degree_attachments($last_insert_id);
          	if($rows->num_rows > 0){
          		while($data = mysqli_fetch_assoc($rows)){
          			unlink($data['academic_degree_attachment']);
          		}
          	}
          }
        	/*For delete the picture :End*/


        	foreach ($applicant_marksheet['name'] as $key => $file) {
        		
        		/**/
        		$extension = pathinfo($applicant_marksheet['name'][$key], PATHINFO_EXTENSION);
        		$filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name."_".$key."_".time()."."."$extension";
        		/**/

        		// $filename = $last_insert_id."_".$applicant_marksheet['name'][$key];
          	
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


    public function set_beneficiary_father_death_certificate($death_certificate,$applicant_first_name,$applicant_last_name,$last_insert_id,$is_add = true)
    {   
       
    	if ($death_certificate != NULL) {

        	$dir = '../assets/father_death_certificate';

        	if (!is_dir($dir)) {
        		mkdir($dir);	
        	}

        	/**/
        	$extension = pathinfo($death_certificate['name'], PATHINFO_EXTENSION);
        	$filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
        	/**/
        	
        	// $filename = $last_insert_id."_".$death_certificate['name'];
        	 /*For delete the picture :Start*/
            if(!$is_add){
               $row = $this->get_all_picture_from_beneficiary_table($last_insert_id);
               if($row->num_rows > 0){
                  $data = mysqli_fetch_assoc($row);
                  if(file_exists($data['father_death_certificate_image'])){ unlink($data['father_death_certificate_image']); }
               }
            }
            /*For delete the picture :End*/



        	$path = $dir."/".$filename;
            if(move_uploaded_file($death_certificate['tmp_name'], $path)){

              $this->query = "UPDATE beneficiary SET father_death_certificate_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

              $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
	
			         return $this->result;  
            }
         } 

        return false;
    }

    public function set_beneficiary_cnic_picture($cnic_picture,$applicant_first_name,$applicant_last_name,$last_insert_id,$is_add = true)
    {   
       	
    	if ($cnic_picture != NULL) {

        	$dir = '../assets/applicant_cnic_picture';

        	if (!is_dir($dir)) {
        		mkdir($dir);	
        	}

        	/**/
        	$extension = pathinfo($cnic_picture['name'], PATHINFO_EXTENSION);
        	$filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
        	/**/

          /*For delete the picture :Start*/
          if(!$is_add){
              $row = $this->get_all_picture_from_beneficiary_table($last_insert_id);
            if($row->num_rows > 0){
                $data = mysqli_fetch_assoc($row);
                if(file_exists($data['applicant_cnic_image'])){
                  unlink($data['applicant_cnic_image']);
                }
            }
          }
          /*For delete the picture :End*/
        	
        	// $filename = $last_insert_id."_".$cnic_picture['name'];
        	
        	$path = $dir."/".$filename;
            if(move_uploaded_file($cnic_picture['tmp_name'], $path)){

              $this->query = "UPDATE beneficiary SET applicant_cnic_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

              $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
	
			return $this->result;  
            }
         } 

        return false;
    }


    public function set_beneficiary_financial_help_picture($financial_help_picture,$applicant_first_name,$applicant_last_name,$last_insert_id,
    	$is_add = true )
    {   
       
    	if ($financial_help_picture != NULL) {

        	$dir = '../assets/financial_help_picture';

        	if (!is_dir($dir)) {
        		mkdir($dir);	
        	}

        	/**/
        	$extension = pathinfo($financial_help_picture['name'], PATHINFO_EXTENSION);
        	$filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
        	/**/

          /*For delete the picture :Start*/
          if(!$is_add){
                $row = $this->get_all_picture_from_beneficiary_table($last_insert_id);
                if($row->num_rows > 0){
                    $data = mysqli_fetch_assoc($row);
                    if(file_exists($data['financial_help_image'])){
                     unlink($data['financial_help_image']); 
                    }
                }
          }
          /*For delete the picture :End*/

        	// $filename = $last_insert_id."_".$financial_help_picture['name'];
        	
        	$path = $dir."/".$filename;
            if(move_uploaded_file($financial_help_picture['tmp_name'], $path)){

              $this->query = "UPDATE beneficiary SET financial_help_image = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

              $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
	
			return $this->result;  
            }
         } 

        return false;
    }

		/*get last beneficiary id :Start*/
		public function get_last_id(){
			return mysqli_insert_id($this->connection);
		}
		/*get last beneficiary id :End*/


		/*search beneficiary record date wise :Start*/
		public function search_records_from_date_to_date($from_date,$to_date, $user_id=null,$user_type=null){
				
        $x = null;
        if(isset($user_type) && $user_type == 0){
            $x = "AND s.user_id = $user_id ";
        }
				$this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name,s.* ";
				$this->query .= "FROM beneficiary b ";
				$this->query .= "LEFT JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
				$this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
        $this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
        $this->query .= "LEFT JOIN user_university s ON b.unversity_id = s.university_id ";
				$this->query .= "WHERE b.`created_at` BETWEEN  '".$from_date."' AND '".$to_date."' AND is_form_saved ='0' ";
        $this->query .= $x;
       $this->query .= "ORDER BY b.beneficiary_id DESC ";

				$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
				
				return $this->result;
		}
		/*search beneficiary record date wise :End*/

		/*total count is_form_submitted =2 :Start*/
		public function total_count_is_form_submitted($user_id=null,$user_type=null){
      $x = null;
      if(isset($user_type) && $user_type == 0){
          $x = "AND s.user_id = $user_id ";
      }
                 
      $this->query = "SELECT COUNT(beneficiary_id) AS Total_Form_Submitted FROM beneficiary b ";
      $this->query .= "LEFT JOIN user_university s ON b.unversity_id = s.university_id ";
      $this->query .= "WHERE is_form_submitted = '2' ";
      $this->query .= "AND is_form_saved ='0' ";
      $this->query .= $x;
    
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			return $this->result;
		}
		/*total count is_form_submitted =2 :End*/

		/*total count is_form_submitted date wise :Start*/
		public function search_total_count_is_form_submitted($from_date,$to_date,$user_id=null,$user_type=null){

      $x = null;
      if(isset($user_type) && $user_type == 0){
          $x = "AND s.user_id = $user_id ";
      }

		  $this->query = "SELECT COUNT(beneficiary_id) AS Total_Form_Submitted ";
		  $this->query .= "FROM beneficiary b ";
		  $this->query .= "LEFT JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
		  $this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
		  $this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
			$this->query .= "LEFT JOIN user_university s ON b.unversity_id = s.university_id ";
		  $this->query .= "WHERE b.`created_at` BETWEEN  '".$from_date."' AND '".$to_date."'AND is_form_submitted = '2' AND is_form_saved = '0' ";
		  $this->query .= $x;
		  $this->query .= "ORDER BY b.beneficiary_id DESC ";
      // die();
	      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			return $this->result;
		}
		/*total count is_form_submitted date wise :End*/

		/*Checked email for a row exist :Start*/
		public function checked_email($email,$id){
			if($id === ''){
        $this->query = "SELECT applicant_email FROM  beneficiary  WHERE applicant_email= '".$email."' "; 
      }else{
        $this->query = "SELECT applicant_email FROM  beneficiary  WHERE applicant_email= '".$email."' && beneficiary_id != '". $id ."' "; 
      }
	    $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			return mysqli_num_rows($this->result);
		}
		/*Checked email for a row exist :End*/


		/*Checked cnic for a row exist :Start*/
		public function checked_cnic($cnic,$id){
			// echo var_dump($id);
      if($id === ''){
        $this->query = "SELECT applicant_cnic FROM  beneficiary  WHERE applicant_cnic= '".$cnic."'"; 
      }else{
        $this->query = "SELECT applicant_cnic FROM  beneficiary  WHERE applicant_cnic= '".$cnic."' && beneficiary_id != '". $id ."' "; 
      }

      // $this->query;
      // die;
	   $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			return mysqli_num_rows($this->result);
		}
		/*Checked cnic for a row exist :End*/


		/*Checked email && cnic for a row exist :Start*/
		public function checked_email_cnic_exist($email = null,$cnic = null)
    {
			$this->query = "SELECT * FROM  beneficiary  WHERE applicant_email= '".$email."' && applicant_cnic= '".$cnic."' "; 
	        	$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
	        	return $this->result;
		}
		/*Checked email && cnic for a row exist :End*/

		/*Update the beneficiary status column :Start*/
		public function update_beneficiary_status($email = null,$cnic = null, $status = '2'){
			$this->query = "UPDATE  beneficiary SET is_form_submitted = '".$status."'  WHERE applicant_email= '".$email."' && applicant_cnic= '".$cnic."' "; 
	        
	        $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
	        return mysqli_affected_rows($this->connection);

		}
		/*Update the beneficiary status column :End*/


		/*Update beneficiary table data :Start*/ 
		public function update_beneficiary($beneficiary_data = array())
		{
      // echo "<pre>";
      // print_r($beneficiary_data);
      // echo "</pre>";
      // die();
			extract($beneficiary_data);

			$this->query  = "UPDATE beneficiary SET";
      if(isset($applicant_highest_academic_degree) && $applicant_highest_academic_degree !='')
      {
       $this->query .= " academic_degree_id    = '".$applicant_highest_academic_degree."', ";
      }
			// $this->query .= " SET  academic_degree_id 		= '".$applicant_highest_academic_degree."', ";	
			$this->query .= " applicant_first_name 	  		= '".ucfirst(strtolower($first_name))."', ";	
			$this->query .= " applicant_middle_name   		=  '".ucfirst(strtolower($middle_name))."', ";	
			$this->query .= " applicant_last_name     		=  '".ucfirst(strtolower($last_name))."', ";	
			$this->query .= " applicant_gender        		=  '".$gender."', ";	
			$this->query .= " applicant_contact_number      =  '".$contact_number."', ";	
			$this->query .= " applicant_email      			=  '".$email."', ";	
			$this->query .= " applicant_date_of_birth      	=  '".$date_of_birth."', ";	
			$this->query .= " applicant_cnic      			=  '".$applicant_cnic."', ";	
			$this->query .= " applicant_current_address     =  '".htmlspecialchars($current_address,true)."', ";
			
			$this->query .= " applicant_permanent_address   =  '".htmlspecialchars($permanent_address,true)."', ";

			if(isset($stipend_for_non_muslim)){
				$this->query .= "applicant_apply_for_stipend = '".$stipend_for_non_muslim."',  ";
			}

			if(isset($eligible_for_zakat)){
				$this->query .= "applicant_eligible_receive_zakat = '".$eligible_for_zakat."',  ";
			}

			$this->query .= "applicant_reason_receive_zakat = '".$reason_for_zakat."', ";
			$this->query .= "is_father_alive 				= '".$is_father_alive."', ";
			$this->query .= "father_cnic 					= '".$father_cnic."', ";
			$this->query .= "father_first_name 				= '".ucfirst(strtolower($father_first_name))."', ";
			$this->query .= "father_middle_name 			= '".ucfirst(strtolower($father_middle_name))."', ";
			$this->query .= "father_last_name 			  = '".ucfirst(strtolower($father_last_name))."', ";
			$this->query .= "father_occupation 			    = '".$father_occupation."', ";
			$this->query .= "applicant_currently_enrolled 	= '".$is_currently_enrolled_in_uni."', ";
			$this->query .= "applicant_university_admission_type 	= '".$applicant_university_admission."', ";

			// if(isset($university) && isset($university_year) && isset($degree_completed_year)){
			// 	$this->query .= "unversity_id =  '".$university."', ";
			// 	$this->query .= "current_enrolled_year_id = '".$university_year."', ";
			// 	$this->query .= "passing_degree_year = '".$degree_completed_year."', ";
			// }

      if (isset($university) && $university !='') {
        $this->query .= "unversity_id =  '".$university."',";
      }

      if (isset($university_year) && $university_year !='') {
       $this->query .= "current_enrolled_year_id = '".$university_year."', ";
      }

      if (isset($degree_completed_year) && $degree_completed_year !='1970-01-01') {
        $this->query .= "passing_degree_year = '".$degree_completed_year."', ";
      }
			
			$this->query .= "expense_Of_education = '".htmlspecialchars($degree_yearly_expenses,true)."', ";
			$this->query .= "applicant_currently_working 		= '".$is_currently_working."', ";
			$this->query .= "applicant_how_much_earn_per_month 	= '".$how_much_earning."', ";
			$this->query .= "does_applicant_have_skills 		= '".$applicant_skill."', ";
			$this->query .= "what_applicant_skills 				= '".$what_skill."', ";
			$this->query .= "applicant_receive_financial_help 	= '".$financial_help."', ";
			$this->query .= "how_much_applicant_received_financial_help = '".htmlspecialchars($how_much_financial_help, true)."', ";

			$this->query .= "from_where = '".htmlspecialchars($from_where_financial_help, true)."', ";
			
			$this->query .= "total_number_of_family_member = '".htmlspecialchars($total_family_member,true)."', ";
			
			$this->query .= "total_adults 		= '".htmlspecialchars($adult,true)."', ";
			$this->query .= "total_childrens 	= '".htmlspecialchars($children_under_age, true)."', ";
			$this->query .= "total_monthly_family_income 	= '".htmlspecialchars($total_family_monthly_income,true)."', ";
			
			$this->query .= "how_many_earning_family_members 	= '".htmlspecialchars($how_many_earning_members,true)."', ";

			$this->query .= "created_at = CURRENT_DATE, ";
			$this->query .= "is_form_submitted = '1' ,";

      if ($bank_name !='') {
        $this->query .= "bank_name = '".htmlspecialchars($bank_name, true)."' ,";
      }
      if ($bank_branch_name !='') {
        $this->query .= "bank_branch_name = '".htmlspecialchars($bank_branch_name, true)."' ,";
      }
      if ($bank_account_title !='') {
        $this->query .= "bank_account_title = '".htmlspecialchars($bank_account_title, true)."' ,";
      }
      if ($bank_account_number !='') {
        $this->query .= "bank_account_number = '".htmlspecialchars($bank_account_number, true)."' ,";
      }



      $this->query .= "is_form_saved = '".$hidden_value."' ";
			
		  $this->query .= "WHERE beneficiary_id = '". $beneficiary_id ."' ";

     //  echo $this->query;
     // die("ys ok");
      

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;

		}
		/*Update beneficiary table data :End*/

		/*get all picture path from beneficiary table :Start*/
		public function get_all_picture_from_beneficiary_table($beneficiary_id){
			
			$this->query = "SELECT applicant_picture, applicant_student_id_card_image, father_death_certificate_image, applicant_cnic_image, financial_help_image, father_national_id_card, income_document, nadra_family_registration_certificate FROM beneficiary WHERE beneficiary_id=".$beneficiary_id;

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;  
                
		}
		/*get all picture path from beneficiary table :End*/

		/*delete attachment of a beneficiary :Start*/
		public function delete_attachments($beneficiary_id){
			$this->query = "DELETE FROM academic_degree_attachment WHERE beneficiary_id = $beneficiary_id";
			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;  
		}
		/*delete attachment of a beneficiary :End*/

			public function get_single_beneficiary($beneficiary_id)
		{
			
			$this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name ";
			$this->query .= "FROM beneficiary b ";
			$this->query .= "LEFT JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
			$this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
			$this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
			$this->query .= "WHERE b.beneficiary_id = $beneficiary_id ";
		    $this->query .= "ORDER BY b.beneficiary_id DESC ";
		

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
			
			return $this->result;
		} 

		public function update_beneficiary_from_admin($beneficiary_data = array(),$applicant_id)
		{
			
			extract($beneficiary_data);


			$this->query  = "UPDATE beneficiary SET";	
			$this->query .= " academic_degree_id = $applicant_highest_academic_degree, applicant_first_name = '".ucfirst(strtolower($first_name))."', applicant_middle_name = '".ucfirst(strtolower($middle_name))."', applicant_last_name = '".ucfirst(strtolower($last_name))."', applicant_gender = '{$gender}', ";	
			$this->query .= " applicant_contact_number = $contact_number, applicant_email = '{$email}', applicant_date_of_birth = '{$date_of_birth}', applicant_cnic = '{$applicant_cnic}', applicant_current_address = '".htmlspecialchars($current_address,true)."', applicant_permanent_address = '".htmlspecialchars($permanent_address,true)."', ";	

			if(isset($stipend_for_non_muslim)){
				$this->query .= "applicant_apply_for_stipend = '{$stipend_for_non_muslim}',  ";
			}

				$this->query .= "applicant_eligible_receive_zakat = '{$eligible_for_zakat}',  ";
			// if(isset($eligible_for_zakat)){
			// }

			$this->query .= "applicant_reason_receive_zakat = '{$reason_for_zakat}', ";

			$this->query .= " is_father_alive = '{$is_father_alive}', father_cnic = '{$father_cnic}', father_first_name = '".ucfirst(strtolower($father_first_name))."', father_middle_name = '".ucfirst(strtolower($father_middle_name))."', father_last_name = '".ucfirst(strtolower($father_last_name))."', father_occupation = '{$father_occupation}', ";	
			$this->query .= " applicant_currently_enrolled = '{$is_currently_enrolled_in_uni}', applicant_university_admission_type = '{$applicant_university_admission}',  ";
			
			

			$this->query .= "expense_Of_education = '".htmlspecialchars($degree_yearly_expenses,true)."', applicant_currently_working = '{$is_currently_working}', applicant_how_much_earn_per_month = '{$how_much_earning}', does_applicant_have_skills = '{$applicant_skill}', what_applicant_skills = '{$what_skill}', ";
			$this->query .= " applicant_receive_financial_help = '{$financial_help}', how_much_applicant_received_financial_help = '".htmlspecialchars($how_much_financial_help, true)."', from_where = '".htmlspecialchars($from_where_financial_help, true)."', total_number_of_family_member = '".htmlspecialchars($total_family_member,true)."', ";	
			$this->query .= " total_adults = '".htmlspecialchars($adult,true)."', total_childrens = '".htmlspecialchars($children_under_age,true)."', total_monthly_family_income = '".htmlspecialchars($total_family_monthly_income,true)."', how_many_earning_family_members = '".htmlspecialchars($how_many_earning_members,true)."' ";	
       if ($bank_name !='') {
        $this->query .= ", bank_name = '".htmlspecialchars($bank_name, true)."'";
      }
      if ($bank_branch_name !='') {
        $this->query .= ", bank_branch_name = '".htmlspecialchars($bank_branch_name, true)."' ";
      }
      if ($bank_account_title !='') {
        $this->query .= ", bank_account_title = '".htmlspecialchars($bank_account_title, true)."' ";
      }
      if ($bank_account_number !='') {
        $this->query .= ", bank_account_number = '".htmlspecialchars($bank_account_number, true)."'";
      }
		   $this->query .= " WHERE beneficiary_id = $applicant_id ";	
			// die;

			$this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");

			if ($this->result) {
				
				if(isset($university) && isset($university_year) && isset($degree_completed_year)){
					$this->query = "UPDATE beneficiary SET unversity_id= '{$university}', current_enrolled_year_id = '{$university_year}', passing_degree_year = '{$degree_completed_year}' WHERE beneficiary_id = ".$applicant_id;
				}else{
					$this->query = "UPDATE beneficiary SET unversity_id= NULL, current_enrolled_year_id = NULL, passing_degree_year = NULL WHERE beneficiary_id = ".$applicant_id;
				}

				$this->result = mysqli_query($this->connection,$this->query);

			}
			
			return $this->result;

		}


    public function get_single_beneficiary_doc_status($beneficiary_id)
    {
      
      $this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name ";
      $this->query .= "FROM beneficiary b ";
      $this->query .= "LEFT JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
      $this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
      $this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
      $this->query .= "WHERE b.beneficiary_id = $beneficiary_id ";
        $this->query .= "ORDER BY b.beneficiary_id DESC ";
    

      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
      return $this->result;
    }

    /*upload nadra frc certificate :start*/
    public function upload_nadra_family_registration_certificate($nadra_frc_picture,$applicant_first_name,$applicant_last_name,$last_insert_id,
          $is_add = true )
    {   
           
        if ($nadra_frc_picture != NULL) {

            $dir = '../assets/nadra_frc_certificate';

            if (!is_dir($dir)) {
              mkdir($dir);  
            }

            $extension = pathinfo($nadra_frc_picture['name'], PATHINFO_EXTENSION);
            $filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
            $path = $dir."/".$filename;
            
            $row = $this->get_all_picture_from_beneficiary_table($last_insert_id);
              
            if($row->num_rows > 0){

                $data = mysqli_fetch_assoc($row);
                if(file_exists($data['nadra_family_registration_certificate'])){
                  unlink($data['nadra_family_registration_certificate']);
                }

                if(move_uploaded_file($nadra_frc_picture['tmp_name'], $path)){

                  $this->query = "UPDATE beneficiary SET nadra_family_registration_certificate = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                  $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
                  return $this->result;  
                }
            }
        } 

        return false;
    }
    /*upload nadra frc certificate :end*/
    

    /*upload income document :start*/
    public function upload_income_document($income_document,$applicant_first_name,$applicant_last_name,$last_insert_id,
          $is_add = true )
    {   
           
        if ($income_document != NULL) {

            $dir = '../assets/income_document';

            if (!is_dir($dir)) {
              mkdir($dir);  
            }

            $extension = pathinfo($income_document['name'], PATHINFO_EXTENSION);
            $filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
            $path = $dir."/".$filename;
            
            $row = $this->get_all_picture_from_beneficiary_table($last_insert_id);
              
            if($row->num_rows > 0){

                $data = mysqli_fetch_assoc($row);
                if(file_exists($data['income_document'])){
                  unlink($data['income_document']);
                }

                if(move_uploaded_file($income_document['tmp_name'], $path)){

                  $this->query = "UPDATE beneficiary SET income_document = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                  $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
                  return $this->result;  
                }
            }
        } 

        return false;
    }
    /*upload income document :end*/


    /*upload father cnic :start*/
    public function upload_father_national_id_card($father_cnic,$applicant_first_name,$applicant_last_name,$last_insert_id,
          $is_add = true )
    {   
           
        if ($father_cnic != NULL) {

            $dir = '../assets/father_cnic';

            if (!is_dir($dir)) {
              mkdir($dir);  
            }

            $extension = pathinfo($father_cnic['name'], PATHINFO_EXTENSION);
            $filename = $last_insert_id."_".$applicant_first_name."_".$applicant_last_name.".$extension";
            $path = $dir."/".$filename;
            
            $row = $this->get_all_picture_from_beneficiary_table($last_insert_id);
              
            if($row->num_rows > 0){

                $data = mysqli_fetch_assoc($row);
                if(file_exists($data['father_national_id_card'])){
                  unlink($data['father_national_id_card']);
                }

                if(move_uploaded_file($father_cnic['tmp_name'], $path)){

                  $this->query = "UPDATE beneficiary SET father_national_id_card = '". $path ."' WHERE beneficiary_id=".$last_insert_id; 

                  $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
                  return $this->result;  
                }
            }
        } 

        return false;
    }
    /*upload father cnic :end*/

    /*Get applicant support status of a beneficiary id :Start*/
    public function get_applicant_support_record($beneficiary_id)
    {
      $this->query = "SELECT * FROM beneficiary_application_status WHERE beneficiary_id='{$beneficiary_id}' ORDER BY beneficiary_application_status_id DESC ";
    
      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
      return $this->result;
    }
    /*Get applicant support status of a beneficiary id :End*/

    /*Get applicant support status of a beneficiary id :Start*/
    public function get_applicant_last_support_record($beneficiary_id)
    {
      $this->query = "SELECT * FROM beneficiary_application_status WHERE beneficiary_id='{$beneficiary_id}' AND support_status = '1' ORDER BY beneficiary_application_status_id DESC LIMIT 1 ";
    
      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
      return $this->result;
    }
    /*Get applicant support status of a beneficiary id :End*/


    /*Update the beneficiary applicantion_status && application_comment column :Start*/
    public function update_beneficiary_application_status($status = null,$comment = null, $written_test_marks = null, $beneficiary_id = null){
      $this->query = "UPDATE  beneficiary SET application_status = '".$status."' , application_comments = '".htmlspecialchars($comment ,true)."', written_test_marks = '".htmlspecialchars($written_test_marks ,true)."'   WHERE beneficiary_id= '".$beneficiary_id."' "; 
          
          $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
          return $this->result;
          // return mysqli_affected_rows($this->connection);

    }
    /*Update the beneficiary applicantion_status && application_comment column :End*/

    /*Add beneficiary support :Start*/
    public function add_beneficiary_support($data){
      extract($data);
      
      $this->query  = "INSERT INTO beneficiary_application_status   (beneficiary_id, support_start_date, support_amount, support_status)  ";
      $this->query .= "VALUES ('". $beneficiary_id  ."', '". $support_start ."' ,'".$support_amount."',  '1' )";
      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
      return $this->result;


    }
    /*Add beneficiary support :End*/

    /*Update beneficiary support :Start*/
    public function update_beneficiary_support($data){
      extract($data);
      
      $this->query  = "UPDATE beneficiary_application_status SET support_start_date = '{$support_start}', support_amount = '{$support_amount}' ";
      
      if($support_stop != ''){
        $this->query  .= " , support_status = '0', support_end_date  = '{$support_stop}' ";
      }
      
      $this->query  .= " WHERE beneficiary_application_status_id = $beneficiary_application_status_id";
  
      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
      return $this->result;


    }
    /*Update beneficiary support :End*/

    /*search beneficiary record filter :Start*/
        public function search_Filter_records($application_status = NULL, $user_id=NULL, $user_type=NULL)
        {
          $y = null;
            if ($application_status != '') {
                $x = "AND b.application_status = '".$application_status."' ";
            }else{
                $x = "AND b.application_status IS NULL ";
            }

            if(isset($user_type) && $user_type == 0){
                $y = "AND s.user_id = $user_id ";     
            }
        
            $y .= $x;       
          
            $this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name,s.* ";
            $this->query .= "FROM beneficiary b ";
            $this->query .= "LEFT JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
            $this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
            $this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
            $this->query .= "LEFT JOIN user_university s ON b.unversity_id = s.university_id ";
            $this->query .= "WHERE is_form_saved = '0' ";
            $this->query .= "AND b.is_form_submitted ='1'  ";
           $this->query .= $y;
           $this->query .= "ORDER BY b.beneficiary_id DESC ";
          // die;
            $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
            
            return $this->result;
        }
    /*search beneficiary record filter :End*/

    /*search beneficiary record filter new application :Start*/
     /*   public function search_Filter_records_new_application()
        {
            
            $this->query = "SELECT b.*, d.degree_title, c.enrolled_year, u.university_name ";
            $this->query .= "FROM beneficiary b ";
            $this->query .= "INNER JOIN academic_degree d ON b.academic_degree_id = d.academic_degree_id ";
            $this->query .= "LEFT JOIN university u ON b.unversity_id = u.university_id ";
            $this->query .= "LEFT JOIN current_enrolled_year c ON b.current_enrolled_year_id = c.current_enrolled_year_id ";
            $this->query .= "WHERE is_form_saved = '0' AND b.is_form_submitted ='1' AND b.application_status IS NULL ";
            $this->query .= "ORDER BY b.beneficiary_id DESC ";
            // die();
            $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
            
            return $this->result;
        }*/
    /*search beneficiary record filter new application :End*/

    /*Update beneficiary support :Start*/
      public function update_beneficiary_support_status($beneficiary_id, $status)
      {
        $this->query  = "UPDATE beneficiary SET application_status = '{$status}' ";
        
        $this->query  .= " WHERE beneficiary_id = $beneficiary_id";
    
        $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
        
        return $this->result;
      }
    /*Update beneficiary support :End*/

    /*Bulk Update beneficairy support status records :Start*/
      public function bulk_update_beneficiary_application_support_status($beneficiary_id)
      {
        $this->query  = "UPDATE beneficiary_application_status";

        $this->query  .= " SET support_status = '1' ,support_start_date = CURRENT_DATE,";
        $this->query  .= " support_end_date = NULL, support_amount = NULL ";
        
        $this->query  .= "WHERE beneficiary_id = '".$beneficiary_id."' ORDER BY beneficiary_application_status_id DESC LIMIT 1";
      
        $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
        
        return $this->result;
      }
    /*Bulk Update beneficiary support status records :End*/

    /*Bulk Update benficiary support status stop:Start*/
        public function bulk_update_beneficiary_application_support_status_stop($beneficiary_id)
          {
            $this->query ="UPDATE `beneficiary_application_status`SET support_status = '0', support_end_date = CURRENT_DATE ";
            $this->query .="WHERE beneficiary_id = '".$beneficiary_id."' ORDER BY beneficiary_application_status_id DESC LIMIT 1";
            
            $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
               
                return $this->result;
          }
    /*Bulk Update benficiary support status stop:End*/

    /*Check Bulk Record support status and support end date exist:start*/
        public function check_bulk_record_support_end_date_exist($beneficiary_id)
        {

          $this->query ="SELECT * FROM beneficiary_application_status WHERE support_end_date IS NOT NULL AND support_status ='0' AND beneficiary_id = '".$beneficiary_id."'";

          $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
               
                return $this->result;
        }
    /*Check Bulk Record support status and support end date exist:End*/

    /* Bulk Add Beneficiary support Status Records:Start*/
          public function bulk_add_beneficiary_records($beneficiary_id, $status)
          {

            $this->query  = "INSERT INTO beneficiary_application_status (beneficiary_id, support_start_date, support_amount, support_status)";
            $this->query .= "VALUES ('".$beneficiary_id."', CURRENT_DATE ,NULL, '".$status."' )";

            $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
             
              return $this->result;
          }
    /* Bulk Add Beneficiary support Status Records:End*/


    /*Checked email save form for a row exist :Start*/
    public function checked_email_exist($email = null)
    {
      $this->query = "SELECT * FROM  beneficiary  WHERE applicant_email= '".$email."'"; 
           
      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
       return $this->result;
    }
    /*Checked email save form for a row exist :End*/

    /*Get Email For Mail Sending Status :Start*/
    public function get_email_for_mail_sending_Status($beneficiary_id = null)
    {
      $this->query = "SELECT * FROM  beneficiary  WHERE beneficiary_id= '".$beneficiary_id."'"; 
           
      $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color: red'><b>Error Message: </b>".mysqli_error($this->connection)."</p>");
      
       return $this->result;
    }
    /*Get Email For Mail Sending Status :End*/
    

		public function __destruct()
		{
			mysqli_close($this->connection);
		}
	}
?>