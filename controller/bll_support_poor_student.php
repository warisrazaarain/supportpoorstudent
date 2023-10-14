<?php
	require_once("../../model/dal_support_poor_student.php");

	class BLL_Beneficiary extends Support_Poor_Student
	{
		protected $first_name     						= NULL; 
    	protected $middle_name 							= NULL; 
    	protected $last_name 							= NULL; 
    	protected $gender 								= NULL;
    	protected $contact_number 						= NULL; 
    	protected $email 								= NULL; 
    	protected $date_of_birth 						= NULL; 
    	protected $applicant_cnic 						= NULL;
        protected $applicant_cnic_picture               = NULL;
    	protected $current_address 						= NULL; 
    	protected $permanent_address 					= NULL;
    	protected $applicant_picture 					= NULL;
        protected $applicant_student_id_card_image      = NULL;  
    	protected $applicant_highest_academic_degree    = NULL;
    	protected $applicant_marksheet_images 			= NULL; 
    	protected $stipend_for_non_muslim 				= NULL;
    	protected $eligible_for_zakat 					= NULL;
    	protected $reason_for_zakat 					= NULL; 
    	protected $is_father_alive 						= NULL;
    	protected $applicant_father_death_certificate 	= NULL;
    	protected $father_cnic 							= NULL;
    	 
    	protected $father_first_name 					= NULL; 
    	protected $father_middle_name 					= NULL; 
    	protected $father_last_name 					= NULL; 
    	protected $father_occupation 					= NULL; 
    	protected $is_currently_enrolled_in_uni 		= NULL;
    	protected $applicant_university_admission 		= NULL;
    	protected $univerity 							= NULL; 
    	protected $univerity_year 						= NULL; 
    	protected $degree_completed_year 				= NULL; 
    	protected $degree_yearly_expenses 				= NULL; 
    	protected $is_currently_working 				= NULL;
    	protected $how_much_earning 					= NULL; 
    	protected $applicant_skill 						= NULL;
    	protected $what_skill 							= NULL; 
    	protected $financial_help 						= NULL;
    	protected $how_much_financial_help 				= NULL; 
    	protected $from_where_financial_help			= NULL;
    	protected $financial_help_image 				= NULL; 
    	protected $total_family_member 					= NULL; 
    	protected $adult 								= NULL; 
    	protected $children_under_age 					= NULL; 
    	protected $total_family_monthly_income 			= NULL; 
    	protected $how_many_earning_members 			= NULL; 
        protected $beneficiary_data                     = array(); 
    	
        public function get_beneficiary_data()
        {   
            $data = array(

                    "first_name"                        => $this->get_first_name(),
                    "middle_name"                       => $this->get_middle_name(),
                    "last_name"                         => $this->get_last_name(),
                    "gender"                            => $this->get_gender(),
                    "contact_number"                    => $this->get_contact_number(),
                    "email"                             => $this->get_email(),
                    "date_of_birth"                     => $this->get_date_of_birth(),
                    "applicant_cnic"                    => $this->get_applicant_cnic(),
                    "current_address"                   => $this->get_current_address(),
                    "permanent_address"                 => $this->get_permanent_address(),
                    "applicant_highest_academic_degree" => $this->get_applicant_highest_academic_degree(),
                    "stipend_for_non_muslim"            => $this->get_stipend_for_non_muslim(),
                    "eligible_for_zakat"                => $this->get_eligible_for_zakat(),
                    "reason_for_zakat"                  => $this->get_reason_for_zakat(),
                    "is_father_alive"                   => $this->get_is_father_alive(),
                    "father_cnic"                       => $this->get_father_cnic(),
                    "father_first_name"                 => $this->get_father_first_name(),
                    "father_middle_name"                => $this->get_father_middle_name(),
                    "father_last_name"                  => $this->get_father_last_name(),
                    "father_occupation"                 => $this->get_father_occupation(),
                    "is_currently_enrolled_in_uni"      => $this->get_is_currently_enrolled_in_uni(),
                    "applicant_university_admission"    => $this->get_applicant_university_admission(),
                    "university"                        => $this->get_univerity(),
                    "university_year"                   => $this->get_univerity_year(),
                    "degree_completed_year"             => $this->get_degree_completed_year(),
                    "degree_yearly_expenses"            => $this->get_degree_yearly_expenses(),
                    "is_currently_working"              => $this->get_is_currently_working(),
                    "how_much_earning"                  => $this->get_how_much_earning(),
                    "applicant_skill"                   => $this->get_applicant_skill(),
                    "what_skill"                        => $this->get_what_skill(),
                    "financial_help"                    => $this->get_financial_help(),
                    "how_much_financial_help"           => $this->get_how_much_financial_help(),
                    "from_where_financial_help"         => $this->get_from_where_financial_help(),
                    "total_family_member"               => $this->get_total_family_member(),
                    "adult"                             => $this->get_adult(),
                    "children_under_age"                => $this->get_children_under_age(),
                    "total_family_monthly_income"       => $this->get_total_family_monthly_income(),
                    "how_many_earning_members"          => $this->get_how_many_earning_members()
                );

            $this->beneficiary_data = $data;

            return $this->beneficiary_data;
        }

        /*public function get_beneficiary_data()
        {
            return $this->beneficiary_data;
        }*/

		public function set_first_name($first_name)
        {
            $this->first_name = $first_name;
        }

        public function get_first_name()
        {
            return $this->first_name;
        }

        public function set_middle_name($middle_name)
        {
            $this->middle_name = $middle_name;
        }
        
        public function get_middle_name()
        {
            return $this->middle_name;
        }

        public function set_last_name($last_name)
        {
            $this->last_name = $last_name;
        }
        
        public function get_last_name()
        {
            return $this->last_name;
        }

        public function set_gender($gender)
        {
            $this->gender = $gender;
        }
        
        public function get_gender()
        {
            return $this->gender;
        }

        public function set_contact_number($contact_number)
        {
            $this->contact_number = $contact_number;
        }
        
        public function get_contact_number()
        {
            return $this->contact_number;
        }

        public function set_email($email)
        {
            $this->email = $email;
        }
        
        public function get_email()
        {
            return $this->email;
        }
        public function set_date_of_birth($date_of_birth)
        {
            $this->date_of_birth = $date_of_birth;
        }
        
        public function get_date_of_birth()
        {
            return $this->date_of_birth;
        }
        public function set_applicant_cnic($applicant_cnic)
        {
            $this->applicant_cnic = $applicant_cnic;
        }
        
        public function get_applicant_cnic()
        {
            return $this->applicant_cnic;
        }

        public function set_applicant_cnic_picture($applicant_cnic_picture)
        {
            $this->applicant_cnic_picture = $applicant_cnic_picture;
        }

        public function get_applicant_cnic_picture()
        {
            return $this->applicant_cnic_picture;
        }

        public function set_current_address($current_address)
        {
            $this->current_address = mysqli_real_escape_string($this->connection,$current_address);
        
        }
        public function get_current_address()
        {
            return $this->current_address;
        }
        
       public function set_permanent_address($permanent_address)
        {
            $this->permanent_address = mysqli_real_escape_string($this->connection,$permanent_address);
        }
        
        public function get_permanent_address()
        {
            return $this->permanent_address;
        }
        public function set_applicant_picture($applicant_picture)
        {
            $this->applicant_picture = $applicant_picture;
        }
        
        public function get_applicant_picture()
        {
            return $this->applicant_picture;
        }
        public function set_applicant_student_id_card_image($applicant_student_id_card_image)
        {
            $this->applicant_student_id_card_image = $applicant_student_id_card_image;
        }
        
        public function get_applicant_student_id_card_image()
        {
            return $this->applicant_student_id_card_image;
        }
        public function set_applicant_highest_academic_degree($applicant_highest_academic_degree)
        {
            $this->applicant_highest_academic_degree = $applicant_highest_academic_degree;
        }
        
        public function get_applicant_highest_academic_degree()
        {
            return $this->applicant_highest_academic_degree;
        }

        public function set_applicant_marksheet_images($applicant_marksheet_images)
        {
            $this->applicant_marksheet_images = $applicant_marksheet_images;
        }
        
        public function get_applicant_marksheet_images()
        {
            return $this->applicant_marksheet_images;
        }

        public function set_stipend_for_non_muslim($stipend_for_non_muslim)
        {
            $this->stipend_for_non_muslim = $stipend_for_non_muslim;
        }
        
        public function get_stipend_for_non_muslim()
        {
            return $this->stipend_for_non_muslim;
        }

        public function set_eligible_for_zakat($eligible_for_zakat)
        {
            $this->eligible_for_zakat = $eligible_for_zakat;
        }
        
        public function get_eligible_for_zakat()
        {
            return $this->eligible_for_zakat;
        }

        public function set_reason_for_zakat($reason_for_zakat)
        {
            $this->reason_for_zakat = mysqli_real_escape_string($this->connection,$reason_for_zakat);
        }
        
        public function get_reason_for_zakat()
        {
            return $this->reason_for_zakat;
        }

        public function set_is_father_alive($is_father_alive)
        {
            $this->is_father_alive = $is_father_alive;
        }
        
        public function get_is_father_alive()
        {
            return $this->is_father_alive;
        }
        public function set_applicant_father_death_certificate($applicant_father_death_certificate)
        {
            $this->applicant_father_death_certificate = $applicant_father_death_certificate;
        }
        
        public function get_applicant_father_death_certificate()
        {
            return $this->applicant_father_death_certificate;
        }
        public function set_father_cnic($father_cnic)
        {
            $this->father_cnic = $father_cnic;
        }
        
        public function get_father_cnic()
        {
            return $this->father_cnic;
        }
        
        public function set_father_first_name($father_first_name)
        {
            $this->father_first_name = $father_first_name;
        }
        
        public function get_father_first_name()
        {
            return $this->father_first_name;
        }

        public function set_father_middle_name($father_middle_name)
        {
            $this->father_middle_name = $father_middle_name;
        }
        
        public function get_father_middle_name()
        {
            return $this->father_middle_name;
        }

        public function set_father_last_name($father_last_name)
        {
            $this->father_last_name = $father_last_name;
        }
        
        public function get_father_last_name()
        {
            return $this->father_last_name;
        }
        public function set_father_occupation($father_occupation)
        {
            $this->father_occupation = mysqli_real_escape_string($this->connection,$father_occupation);
        }
        
        public function get_father_occupation()
        {
            return $this->father_occupation;
        }
        public function set_is_currently_enrolled_in_uni($is_currently_enrolled_in_uni)
        {
            $this->is_currently_enrolled_in_uni = $is_currently_enrolled_in_uni;
        }
        
        public function get_is_currently_enrolled_in_uni()
        {
            return $this->is_currently_enrolled_in_uni;
        }
        public function set_applicant_university_admission($applicant_university_admission)
        {
            $this->applicant_university_admission = $applicant_university_admission;
        }
        
        public function get_applicant_university_admission()
        {
            return $this->applicant_university_admission;
        }
        public function set_univerity($univerity)
        {
            $this->univerity = $univerity;
        }
        
        public function get_univerity()
        {
            return $this->univerity;
        }
        public function set_univerity_year($univerity_year)
        {
            $this->univerity_year = $univerity_year;
        }
        
        public function get_univerity_year()
        {
            return $this->univerity_year;
        }
        public function set_degree_completed_year($degree_completed_year)
        {
            if (isset($degree_completed_year)) {
               $this->degree_completed_year = $degree_completed_year =date("Y-m-d",strtotime($degree_completed_year));
            }
        }
        
        public function get_degree_completed_year()
        {
            return $this->degree_completed_year;
        }
        public function set_degree_yearly_expenses($degree_yearly_expenses=null)
        {
            $this->degree_yearly_expenses = $degree_yearly_expenses;
        }
        
        public function get_degree_yearly_expenses()
        {
            return $this->degree_yearly_expenses;
        }
        public function set_is_currently_working($is_currently_working)
        {
            $this->is_currently_working = $is_currently_working;
        }
        
        public function get_is_currently_working()
        {
            return $this->is_currently_working;
        }
        public function set_how_much_earning($how_much_earning)
        {
            $this->how_much_earning = mysqli_real_escape_string($this->connection,$how_much_earning);
        }
        
        public function get_how_much_earning()
        {
            return $this->how_much_earning;
        }
        public function set_applicant_skill($applicant_skill)
        {
            $this->applicant_skill = $applicant_skill;
        }
        
        public function get_applicant_skill()
        {
            return $this->applicant_skill;
        }
        public function set_what_skill($what_skill)
        {
            $this->what_skill = mysqli_real_escape_string($this->connection,$what_skill);
        }
        
        public function get_what_skill()
        {
            return $this->what_skill;
        }
        public function set_financial_help($financial_help)
        {
            $this->financial_help = $financial_help;
        }
        
        public function get_financial_help()
        {
            return $this->financial_help;
        }
        public function set_how_much_financial_help($how_much_financial_help)
        {
            $this->how_much_financial_help = mysqli_real_escape_string($this->connection,$how_much_financial_help);
        }
        
        public function get_how_much_financial_help()
        {
            return $this->how_much_financial_help;
        }
        public function set_from_where_financial_help($from_where_financial_help)
        {
            $this->from_where_financial_help = mysqli_real_escape_string($this->connection,$from_where_financial_help);
        }
        
        public function get_from_where_financial_help()
        {
            return $this->from_where_financial_help;
        }
        public function set_financial_help_image($financial_help_image)
        {
            $this->financial_help_image = $financial_help_image;
        }
        
        public function get_financial_help_image()
        {
            return $this->financial_help_image;
        }
        public function set_total_family_member($total_family_member)
        {
            $this->total_family_member = mysqli_real_escape_string($this->connection,$total_family_member);
        }
        
        public function get_total_family_member()
        {
            return $this->total_family_member;
        }
        public function set_adult($adult)
        {
            $this->adult = mysqli_real_escape_string($this->connection,$adult);
        }
        
        public function get_adult()
        {
            return $this->adult;
        }
        public function set_children_under_age($children_under_age)
        {
            $this->children_under_age = mysqli_real_escape_string($this->connection,$children_under_age);
        }
        
        public function get_children_under_age()
        {
            return $this->children_under_age;
        }
        public function set_total_family_monthly_income($total_family_monthly_income)
        {
            $this->total_family_monthly_income = mysqli_real_escape_string($this->connection,$total_family_monthly_income);
        }
        
        public function get_total_family_monthly_income()
        {
            return $this->total_family_monthly_income;
        }
        public function set_how_many_earning_members($how_many_earning_members)
        {
            $this->how_many_earning_members = mysqli_real_escape_string($this->connection,$how_many_earning_members);
        }
        
        public function get_how_many_earning_members()
        {
            return $this->how_many_earning_members;
        }
        		
	}






?>