<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../library/forms.php");
	require_once("../../model/dal_academic_degree.php");
	require_once("../../model/dal_university.php");
	require_once("../../model/dal_enrolled_year.php");
	require_once("../../controller/bll_support_poor_student.php");

	$forms  = new Forms("beneficiary_form_process.php", "POST");
	
	$academic_degree  = new Academic_Degree();
	$all_degrees = $academic_degree->get_all_degree();
	
	$univerity  = new University();
	$all_university = $univerity->get_all_university();

	$enorlled_year  = new Enrolled_Year();
	$all_enorlled_year = $enorlled_year->get_all_enrolled_year();

	$forms->set_academic_degree($all_degrees);
	$forms->set_university($all_university);
	$forms->set_enrolled_year($all_enorlled_year);

	$beneficiary_data = NULL;
	/*Check Email & CNIC To Get Data :Start*/
	if(isset($_REQUEST['email']) && isset($_REQUEST['cnic'])){
		$support_poor_student = new BLL_Beneficiary();
		
		extract($_REQUEST);
		$applicant_email	= base64_decode($email);
		$applicant_cnic 	= base64_decode($cnic);

		$result = $support_poor_student->checked_email_cnic_exist($applicant_email, $applicant_cnic);

		if($result->num_rows > 0){
			$beneficiary_data = mysqli_fetch_assoc($result);
			$rows = $support_poor_student->get_all_beneficiary_degree_attachments($beneficiary_data['beneficiary_id']);
			if($rows->num_rows > 0){
					while($marksheet = mysqli_fetch_assoc($rows)){
						$beneficiary_data['marksheet'][] = $marksheet['academic_degree_attachment'];
					}
			}

			if($beneficiary_data['is_form_submitted'] != '0'){
				header("location:index.php?msg=Link is expired&class=danger");	
			}	
		}else{
			header("location:index.php");
			die;
		}
	}else{
		$beneficiary_save_data = NULL;
		if (isset($_REQUEST['email'])) {
			$support_poor_student = new BLL_Beneficiary();
			
			extract($_REQUEST);
			$applicant_email	= base64_decode($email);
			
			$result = $support_poor_student->checked_email_exist($applicant_email);

			if($result->num_rows > 0){
				$beneficiary_save_data = mysqli_fetch_assoc($result);

				$rows = $support_poor_student->get_all_beneficiary_degree_attachments($beneficiary_save_data['beneficiary_id']);
				if($rows->num_rows > 0){
						while($marksheet = mysqli_fetch_assoc($rows)){
							$beneficiary_save_data['marksheet'][] = $marksheet['academic_degree_attachment'];
						}
				}

				if($beneficiary_save_data['is_form_saved'] != '1'){
					header("location:index.php?msg=Link is expired&class=danger");	
				}	
			}else{
				header("location:index.php");
				die;
			}
		}
	}
	/*Check Email & CNIC To Get Data :End*/



	General::site_header();

	General::site_logo();

?>

	<!-- Title Container:Start -->
    <div class="container">
			<div class="row">
	    		<div class="col-sm-12 mt-4">
	    			<h3 class="wpforms-title">Support Poor Students (Monthly)</h3>
	    		</div>
	    		<div class="col-sm-12">
	    			<p class="lead">The purpose of this project is to support the weakest link in our community, in a manner so that not only their basic living needs are met with dignity, but also they are provided education - a basic right of a human being - so that they can become productive members of society.</p>
	    		</div>
			</div>
    </div>
    <!-- Title Container:End -->
    
    <!-- Main Container:Start -->
    <div class="container mt-5">
	   	<?php 
	    if(isset($_REQUEST['msg'])){
	    ?>
	    <div class="row">
	    	<div class="col-md-12">
	    		<div class="alert alert-<?php echo $_REQUEST['class']??''; ?>" role="alert">
  					<?php echo $_REQUEST['msg']??"" ?>
				</div>
			</div>
	    </div>
		<?php } ?>
	    
	    <?php 
	    	if(isset($beneficiary_data)):
	    		$forms->beneficiary_edit_form($beneficiary_data);
	    	elseif(isset($beneficiary_save_data)): // Note the combination of the words.
	    		$forms->BeneficiarySaveDataForm($beneficiary_save_data);
	    	else:
		    	if(!isset($_REQUEST['msg'])){
		    			$forms->beneficiary_form(); 
		    		}
	    	endif;	
	    ?>
    </div>
    <!-- Main Container:End -->
   
<?php 
	
	General::site_footer();
	// session_destroy();
	if (isset($_SESSION['error'])) {
		unset($_SESSION['error']);
	}
?>
    <!-- Internal Script Code:Start -->
    <script type="text/javascript">
    	$(document).ready(function(){

    		$("#submit-btn").click(function(e){        
        		$('input[name=hidden_value]').val(0);
        		
    		});

    		$("#save-btn").click(function(e){
        		$('input[name=hidden_value]').val(1);
        	});


    		/*Show Hide Why Field: If Eligible For Zakat Yes:Start*/
	    		$(document).on("click","input[name=eligible_for_zakat]:checked",function(){

	        		if(($(this).val()) == "Yes"){
	        				$("#zakat-reason-box").show();
	        		}else{
	        				$("input[name=reason_for_zakat]").val("");
	        				$("#zakat-reason-box").hide();
	        				$("input[name=reason_for_zakat]").removeClass("is-valid");
	        		}
	        });
    		/*Show Hide Why Field: If Eligible For Zakat Yes:End*/

    		/*Show Hide Father Death Certificate: If Father Alive No:Start*/
	    		$(document).on("click","input[name=is_father_alive]:checked",function(){

	        		if(($(this).val()) == "No"){
	        				$("#death-certificate-box").show();
	        		}else{
	        				$("input[name=applicant_father_death_certificate]").val("");
	        				$("input[name=applicant_father_death_certificate]").removeClass("is-valid is-invalid");
	        				$("#death-certificate-box").hide();
	        		}
	        });
    		/*Show Hide Father Death Certificate: If Father Alive No:End*/

    		/*Show Hide University Box: If Is Currently Enrolled Uni Yes:Start*/
	    		$(document).on("click","input[name=is_currently_enrolled_in_uni]:checked",function(){

	        		if(($(this).val()) == "Yes"){
	        				$(".university-box").show();
	        		}else{
	        				$("select[name=univerity]").val("");
	        				$("select[name=univerity_year]").val("");
	        				$("input[name=degree_completed_year]").val("");
	        				$("input[name=degree_yearly_expenses]").val("");
	        				$(".university-box").hide();
	        				$("select[name=univerity]").removeClass("is-valid");
	        				$("select[name=univerity_year]").removeClass("is-valid");
	        				$("input[name=degree_completed_year]").removeClass("is-valid");
	        		}
	        	});
       		 /*Show Hide University Box: If Is Currently Enrolled Uni Yes:End*/
    		
    		/*Show Hide How Much Money Earn: If Currently Working Yes:Start*/
	    		$(document).on("click","input[name=is_currently_working]:checked",function(){

	        		if(($(this).val()) == "Yes"){
	        				$("#current-working-box").show();
	        		}else{
	        				$("input[name=how_much_earning]").val("");
	        				$("#current-working-box").hide();
	        				$("input[name=how_much_earning]").removeClass("is-valid");
	        		}
	        });
    		/*Show Hide How Much Money Earn: If Currently Working Yes:End*/
	    	
	    	/*Show Hide What Skil: If Applicant Have Any Skill Yes:Start*/
	    		$(document).on("click","input[name=applicant_skill]:checked",function(){

	        		if(($(this).val()) == "Yes"){
	        				$("#skill-box").show();
	        		}else{
	        				$("input[name=what_skill]").val("");
	        				$("#skill-box").hide();
	        				$("input[name=what_skill]").removeClass("is-valid");
	        		}
	        });
    		/*Show Hide What Skil: If Applicant Have Any Skill Yes:End*/

    		/*Show Hide Financial Box: If Applicant Recieved Financial Help Yes:Start*/
	    		$(document).on("click","input[name=financial_help]:checked",function(){

	    				if(($(this).val()) == "Yes"){
	        				$(".financial-box").show();
	        		}else{
	        				$("input[name=how_much_financial_help]").val("");
	        				$("input[name=from_where_financial_help]").val("");
	        				$("input[name=financial_help_image]").val("");
	        				$(".financial-box").hide();
	        				$("input[name=how_much_financial_help]").removeClass("is-valid is-invalid");
	        				$("input[name=from_where_financial_help]").removeClass("is-valid is-invalid");
	        				$("input[name=financial_help_image]").removeClass("is-valid is-invalid");
	        		}
	        });
    		/*Show Hide Financial Box: If Applicant Recieved Financial Help Yes:End*/

    		/*Checked Email Already Exist In DB:Start*/
	    		$(document).on("blur","#email",function(){
	    			var cnic = $("#cnic").val()
	                var email = $(this).val();
	                var id = $("input[name='beneficiary_id']").val()
	                // alert(id);

	                checked_email(email,id);
	                if(cnic != ""){
	                	checked_cnic(cnic,id);
	                }
	                
				});
    		/*Checked Email Already Exist In DB:End*/

    		/*Checked Applicant CNIC Already Exist In DB:Start*/
	    		$(document).on("blur","#cnic",function(){
	    			var email = $("#email").val();
	    			var cnic = $(this).val();
	                var id = $("input[name='beneficiary_id']").val()
	                // alert(id);
	                
	                checked_cnic(cnic,id);
	                if(email != ""){
	                	checked_email(email,id);
	                }

				});
    		/*Checked Applicant CNIC Already Exist In DB:End*/

	    	/*Check Father Alive For Show All Tabs :Start */	
		    	var is_death_certificate_selected = <?php isset($beneficiary_data)?true:false; ?>
		    	$('.is_father_alive').on('click',function(){

		    		check_is_father_alive($(this).val());
		    		// edit_flag_status();
		    	});	
	    	/*Check Father Alive For Show All Tabs :Start */

		    /*Check Edit Father Alive For Show All Tabs :Start */
		    	$('.is_father_alive_edit').on('click',function(){

		    		check_is_father_alive_edit($(this).val());
		    		edit_flag_status();
		    	});	

	    	/*Check Edit Father Alive For Show All Tabs :End */

	    	/*Check Is Father Alive Value :Start*/
		    	let is_father_alive 	= $('input[name=is_father_alive]:checked').val();
		    	check_is_father_alive(is_father_alive);
	    	/*Check Is Father Alive Value :End*/
	    	

//////// * Validation For Applicant Father Information Tab For New User`s Add Form * ////////
	    	
	    	var flag_1 = false;
	    	var flag_2 = false;
	    	var flag_3 = false;
	    	var flag_4 = false;
	    	var flag_5 = false;
	    	var flag_6 = true;

	    	function flag_status(){

				if (flag_1 && flag_2 && flag_3 && flag_4 && flag_5 && flag_6){
					// $("#nextBtn").css('display', 'block');
					$("#nextBtn").prop('disabled', false);
					$("#nextBtn").addClass('bg-success');
					$("#nav-personal-info-tab").prop('disabled', false);
				}else{
	  				// $("#nextBtn").css('display', 'none');
	  				$("#nextBtn").prop('disabled', true);
	  				$("#nextBtn").removeClass('bg-success');
					$("#nav-personal-info-tab").prop('disabled',true);
	  			}
	    	}


	    	/*Death Certificate Onchange :Start*/
	    	$('#death-certificate-file').change(function(){

	    		// console.log($(this)[0].files[0]);
	    		var applicant_father_death_certificate 	= $(this)[0].files[0];
	    					if (applicant_father_death_certificate != undefined) {
	    						$('#error-father-death-certificate').html('');
	    						var file_extension = (applicant_father_death_certificate.name.split('.').pop());
	    							file_extension = file_extension.toLowerCase();

	    						if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg") && (file_extension != "pdf")) {
	    							flag_1 = false;
	    							$('input[name=applicant_father_death_certificate]').addClass('is-invalid');
	    							$('#error-father-death-certificate').html('File extension must be eg: (png | jpg | jpeg | pdf)');

	    							// $("#nav-personal-info-tab").prop('disabled', true);
	    							// $("#nextBtn").css('display', 'none');
	    							is_death_certificate_selected = false;

	    							flag_status();

	    						}else{
	    							flag_1 = true;
	    							$('input[name=applicant_father_death_certificate]').removeClass('is-invalid').addClass('is-valid');

	    							// $("#nav-personal-info-tab").prop('disabled', false);
	    							// $("#nextBtn").css('display', 'block');
	    							is_death_certificate_selected = true;
	    							flag_status();

	    						}
	    					}else{
	    						// is_death_certificate_selected = true;
	    						$('input[name=applicant_father_death_certificate]').removeClass('is-invalid');
	    						
	    					}
	    	});
	    	/*Death Certificate Onchange :End*/

	    	var father_alpha_pattern 	= /^[A-z]{3,}$/; //ali 
	    	var cnic_pattern  			= /^\d{5}[0-9]{7}\d{1}$/;//4130312345671

	    /*Applicant Father`s CNIC Numbers Validation:Start*/
		    	 $(document).on("blur","#father_nationl_id_card",function(){

		    		var father_cnic = $('input[name=father_cnic]').val();
		    	    // var flag_2 = true;
		    	    	if (father_cnic == "") {
		    	    		flag_2 = false;
		    	    		$('input[name=father_cnic]').addClass('is-invalid');
		    	        	$('#error-father-cnic').html('This field is required.');
		    	        	flag_status();
		    	        	
		    	        
		    	        }else{
		    	    		$('input[name=father_cnic]').removeClass('is-invalid').addClass('is-valid');
		    	    		
		    	        	if (cnic_pattern.test(father_cnic) == false) {
		    	        		flag_2 = false;
		    	        		flag_status();
		    	    			$('input[name=father_cnic]').removeClass('is-valid').addClass('is-invalid');
		    	        		$('#error-father-cnic').html('CNIC Numbers must be like eg: 4130312345671');
		    	        			
		    	        	}else{
		    	        		flag_2 = true;
		    	        		flag_status();
		    	        	}   
		    	    	}
		    	});

		/*Applicant Father`s CNIC Numbers Validation:End*/

		/*Applicant Father`s FirstName Validation:Start*/

		    	 $(document).on("blur","#father_first_name",function(){

		    	 	var father_first_name = $('input[name=father_first_name]').val();

		    	 		if (father_first_name == "") {
		    	 			flag_3 = false;
		    	 			flag_status();
		    	 			$('input[name=father_first_name]').addClass('is-invalid').removeClass('bottom-margin');
		    	 	    	$('#error-father-first-name').html('This field is required.');
		    	 	    
		    	 	    }else{
		    	 			$('input[name=father_first_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
		    	 	    	if (father_alpha_pattern.test(father_first_name) == false) {
		    	 	    		flag_3 = false;
		    	 	    		flag_status();
		    	 				$('input[name=father_first_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
		    	 	    		$('#error-father-first-name').html('First Name must be like eg: Ali ...');
		    	 	    	}else{
		    	 	    		 flag_3 = true;
		    	 	    		 flag_status();
		    	 	    	}   
		    	 		}
		    	});

		/*Applicant Father`s FirstName Validation:End*/

		/*Applicant Father`s MiddleName Validation:Start*/
		    	 $(document).on("blur","#father_middle_name",function(){

		    	 	var father_middle_name = $('input[name=father_middle_name]').val();

		    	 	  if (father_middle_name != "") {
		    	 	  	father_middle_name_flag = true;
		    	 	  	$('#error-father-middle-name').html('');

		    	 	  	if (father_alpha_pattern.test(father_middle_name) == false) {
		    	 	  		flag_6 = false;
		    	 	  		flag_status();
		    	 	  		$('input[name=father_middle_name]').addClass('is-invalid').removeClass('bottom-margin');;
		    	 	  		$('#error-father-middle-name').html('Middle Name must be like eg: Ahmed ...');
		    	 	  	}else{
		    	 	  		$('input[name=father_middle_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
		    	 	  		flag_6 = true;
		    	 	  		flag_status();
		    	 	  	}
		    	 	  }else{
		    	 	  	flag_6 = true;
		    	 	  		flag_status();
		    	 	  	$('input[name=father_middle_name]').removeClass('is-invalid is-valid').addClass('bottom-margin');
		    	 	  }	
		    	});

		/*Applicant Father`s MiddleName Validation:End*/


		/*Applicant Father`s LastName Validation:Start*/
		    	
		    	 $(document).on("blur","#father_last_name",function(){

		    	 	var father_last_name = $('input[name=father_last_name]').val();

		    	 	 if (father_last_name == "") {
		    	 	  			flag_4 = false;
		    	 	  			flag_status();
		    	 	  			$('input[name=father_last_name]').addClass('is-invalid').removeClass('bottom-margin');
		    	 	  	    	$('#error-father-last-name').html('This field is required.');
		    	 	  	    
		    	 	  	}else{
		    	 	  			$('input[name=father_last_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
		    	 	  	    if (father_alpha_pattern.test(father_last_name) == false) {
		    	 	  	    		flag_4 = false;
		    	 	  	    		flag_status();
		    	 	  				$('input[name=father_last_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
		    	 	  	    		$('#error-father-last-name').html('Last Name must be like eg: Khan ...');
		    	 	  	    }else{

		    	 	  	    	   flag_4 = true;
		    	 	  	    		flag_status();
		    	 	  	    }   
		    	 	     }	
		    	    });

		/*Applicant Father`s LastName Validation:End*/

		/*Applicant Father Occupation Validation:Start*/

		    	 $(document).on("blur","#father_occupation",function(){

		    	 	var father_occupation = $('input[name=father_occupation]').val();

		    	 	if (father_occupation == "") {
		    	 	  			flag_5 = false;
		    	 	  			flag_status();
		    	 	  			$('input[name=father_occupation]').addClass('is-invalid');
		    	 	  	    	$('#error-father-occupation').html('This field is required.');
		    	 	  	    
		    	 	  	}else{
		    	 	  			$('input[name=father_occupation]').removeClass('is-invalid').addClass('is-valid');
		    	 	  			flag_5 = true;
		    	 	  			flag_status();
		    	 	  	    }
		    	});
		    	
		/*Applicant Father Occupation Validation:End*/


		/* Validation Of Benficiary Add Form Data :End*/


//////// * Validation For Applicant Father Information Tab For Exist User`s Edit Form * ////////

		/*Validation For Fathers Related Field: Start*/
		    	var flag_death = true;
		    	var flag_cnic = true;     //father cnic flag
		    	var flag_first_name = true;    //first name flag
		    	var flag_last_name = true;   //last name flag
		    	var flag_occupation = true;  //Occupation flag
		    	var flag_middle_name = true;  //middle name flag

		    	function edit_flag_status(){
    				if (flag_death && flag_cnic && flag_first_name && flag_last_name && flag_occupation && flag_middle_name){
    					// $("#nextBtn-edit").css('display','block');
    					$("#nextBtn-edit").removeClass('bg-secondary');
    					$("#nextBtn-edit").prop('disabled',false);
    					$("#nav-personal-info-tab-edit").prop('disabled', false);
    				}else{
    						// $("#nextBtn-edit").css('display','none');
    						$("#nextBtn-edit").prop('disabled',true);
    						$("#nextBtn-edit").addClass('bg-secondary');
    						$("#nav-personal-info-tab-edit").prop('disabled',true);
    				}
		    	}

		    // var father_alpha_pattern 	= /^[A-z]{3,}$/; //ali 
		    // var cnic_pattern  	= /^\d{5}[0-9]{7}\d{1}$/;//4130312345671

		        	/*Death Certificate Onchange :Start*/
		        	$('#f-death-certificate-file').change(function(){
		        		// edit_flag_status();
		        		// alert("ok");
		        		console.log($(this)[0].files[0]);
		        		var applicant_father_death_certificate 	= $(this)[0].files[0];
		        					if (applicant_father_death_certificate != undefined) {
		        						$('#error-father-death-certificate').html('');
		        						var file_extension = (applicant_father_death_certificate.name.split('.').pop());
		        							file_extension = file_extension.toLowerCase();

		        						if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg") && (file_extension != "pdf")) {
		        							flag_death = false;
		        							$('input[name=applicant_father_death_certificate]').addClass('is-invalid');
		        							$('#error-father-death-certificate').html('File extension must be eg: (png | jpg | jpeg | pdf)');

		        							// $("#nav-personal-info-tab").prop('disabled', true);
		        							// $("#nextBtn-edit").css('display', 'none');
		        							is_death_certificate_selected = false;

		        							edit_flag_status();

		        						}else{
		        							flag_death = true;
		        							$('input[name=applicant_father_death_certificate]').removeClass('is-invalid').addClass('is-valid');

		        							// $("#nav-personal-info-tab").prop('disabled', false);
		        							// $("#nextBtn").css('display', 'block');
		        							is_death_certificate_selected = true;
		        							edit_flag_status();

		        						}
		        					}else{
		        						// is_death_certificate_selected = true;
		        						$('input[name=applicant_father_death_certificate]').removeClass('is-invalid');
		        						
		        					}
		        	});
		        	/*Death Certificate Onchange :End*/

		            /*Applicant Father`s CNIC Numbers Validation:Start*/
		        	    	 $(document).on("blur","#father_nic",function(){
		        	    	 	
		        	    		var father_cnic = $('input[name=father_cnic]').val();
		        	    	    
		        	    	    	if (father_cnic == "") {
		        	    	    		flag_cnic = false;
		        	    	    		$('input[name=father_cnic]').addClass('is-invalid');
		        	    	        	$('#error-father-cnic').html('This field is required.');
		        	    	        	edit_flag_status();
		        	    	        	
		        	    	        
		        	    	        }else{
		        	    	    		$('input[name=father_cnic]').removeClass('is-invalid').addClass('is-valid');
		        	    	    		
		        	    	        	if (cnic_pattern.test(father_cnic) == false) {
		        	    	        		flag_cnic = false;
		        	    	        		edit_flag_status();
		        	    	    			$('input[name=father_cnic]').removeClass('is-valid').addClass('is-invalid');
		        	    	        		$('#error-father-cnic').html('CNIC Numbers must be like eg: 4130312345671');
		        	    	        			
		        	    	        	}else{
		        	    	        		flag_cnic = true;
		        	    	        		edit_flag_status();
		        	    	        	}   
		        	    	    	}
		        	    	});

		        	/*Applicant Father`s CNIC Numbers Validation:End*/

		        	/*Applicant Father`s FirstName Validation:Start*/

		        	    	 $(document).on("blur","#f_first_name",function(){
		        	    	 	
		        	    	 	var father_first_name = $('input[name=father_first_name]').val();

		        	    	 		if (father_first_name == "") {
		        	    	 			flag_first_name = false;
		        	    	 			edit_flag_status();
		        	    	 			$('input[name=father_first_name]').addClass('is-invalid').removeClass('bottom-margin');
		        	    	 	    	$('#error-father-first-name').html('This field is required.');
		        	    	 	    }else{
		        	    	 			$('input[name=father_first_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
		        	    	 	    	if (father_alpha_pattern.test(father_first_name) == false) {
		        	    	 	    		flag_first_name = false;
		        	    	 	    		edit_flag_status();
		        	    	 				$('input[name=father_first_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
		        	    	 	    		$('#error-father-first-name').html('First Name must be like eg: Ali ...');
		        	    	 	    	}else{
		        	    	 	    		 flag_first_name = true;
		        	    	 	    		 edit_flag_status();
		        	    	 	    	}   
		        	    	 		}
		        	    	});

		        	/*Applicant Father`s FirstName Validation:End*/

		        	/*Applicant Father`s MiddleName Validation:Start*/
		        	    	 $(document).on("blur","#f_middle_name",function(){
		        	    	 	
		        	    	 	var father_middle_name = $('input[name=father_middle_name]').val();

		        	    	 	  if (father_middle_name != "") {
		        	    	 	  	father_middle_name_flag = true;
		        	    	 	  	$('#error-father-middle-name').html('');

		        	    	 	  	if (father_alpha_pattern.test(father_middle_name) == false) {
		        	    	 	  		flag_middle_name = false;
		        	    	 	  		edit_flag_status();
		        	    	 	  		$('input[name=father_middle_name]').addClass('is-invalid').removeClass('bottom-margin');;
		        	    	 	  		$('#error-father-middle-name').html('Middle Name must be like eg: Ahmed ...');
		        	    	 	  	}else{
		        	    	 	  		$('input[name=father_middle_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
		        	    	 	  		flag_middle_name = true;
		        	    	 	  		edit_flag_status();
		        	    	 	  	}
		        	    	 	  }else{
		        	    	 	  	flag_middle_name = true;
		        	    	 	  		edit_flag_status();
		        	    	 	  	$('input[name=father_middle_name]').removeClass('is-invalid is-valid').addClass('bottom-margin');
		        	    	 	  }	
		        	    	});

		        	/*Applicant Father`s MiddleName Validation:End*/

		        	/*Applicant Father`s LastName Validation:Start*/	        	    	
	        	    	$(document).on("blur","#f_last_name",function(){

	        	    	 	var father_last_name = $('input[name=father_last_name]').val();

	        	    	 	if (father_last_name == "") {
	        	    	 	  			flag_last_name = false;
	        	    	 	  			edit_flag_status();
	        	    	 	  			$('input[name=father_last_name]').addClass('is-invalid').removeClass('bottom-margin');
	        	    	 	  	    	$('#error-father-last-name').html('This field is required.');
	        	    	 	  	    
	        	    	 	  	}else{
	        	    	 	  			$('input[name=father_last_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	        	    	 	  	    if (father_alpha_pattern.test(father_last_name) == false) {
	        	    	 	  	    		flag_last_name = false;
	        	    	 	  	    		edit_flag_status();
	        	    	 	  				$('input[name=father_last_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	        	    	 	  	    		$('#error-father-last-name').html('Last Name must be like eg: Khan ...');
	        	    	 	  	    }else{

	        	    	 	  	    	flag_last_name = true;
	        	    	 	  	    	edit_flag_status();
	        	    	 	  	    }   
	        	    	 	    }	
	        	    	    });
		        	/*Applicant Father`s LastName Validation:End*/

		        	/*Applicant Father Occupation Validation:Start*/

		        	    	 $(document).on("blur","#father_occupations",function(){

		        	    	 	var father_occupation = $('input[name=father_occupation]').val();

		        	    	 	if (father_occupation == "") {
		        	    	 	  			flag_occupation = false;
		        	    	 	  			edit_flag_status();
		        	    	 	  			$('input[name=father_occupation]').addClass('is-invalid');
		        	    	 	  	    	$('#error-father-occupation').html('This field is required.');
		        	    	 	  	    
		        	    	 	  	}else{
		        	    	 	  			$('input[name=father_occupation]').removeClass('is-invalid').addClass('is-valid');
		        	    	 	  			flag_occupation = true;
		        	    	 	  			edit_flag_status();
		        	    	 	  			
		        	    	 	  	    }
		        	    	});
		        	    	
		        	/*Applicant Father Occupation Validation:End*/


		        	/*Edit Applicant Info Tab Or Next Button:Start*/
		        	$(document).on("click","#nav-personal-info-tab-edit,#nextBtn-edit",function(){

		        		if($('input[name=is_father_alive]:checked').val() == 'No' && is_death_certificate_selected){
		        			$('#first_tab').hide();
		        			$('#nav-personal-info-edit').addClass('show');
		        			$('#nav-personal-info-tab-edit').addClass('active');
		        			$('#nav-father-alive-tab').removeClass('active');
		        		}    
		        	});
		        	/*Edit Applicant Info Tab Or Next Button:End*/


	    /*Validation For Fathers Related Field: End*/
		


	    	/*Persnal Info Tab Or Next Button:Start*/
	    	$(document).on("click","#nav-personal-info-tab,#nextBtn",function(){
	    		    			
	    		if($('input[name=is_father_alive]:checked').val() == 'No' && is_death_certificate_selected){
	    			$('#first_tab').hide();
	    			$("#second_tab").show();
	    			$('#nav-personal-info').addClass('show');
	    			$('#nav-personal-info-tab').addClass('active');
	    			$('#nav-father-alive-tab').removeClass('active');

	    		}    
	    	});
	    	/*Persnal Info Tab Or Next Button:End*/

	    	/*Father Alive Tab :Start*/
	    	$(document).on("click","#nav-father-alive-tab",function(){
	    		    			
	    	    $('#first_tab').show();
	    	    $("#second_tab").hide();  
	    	});
	    	/*Father Alive Tab :End*/

    	});

		function checked_email(email=null, id= null){
				
		        var email_pattern = /^[a-z]{2,}\w*[@]{1}[a-z]{2,}[.]{1}[a-z]{2,6}$/;//ali9@yahoo.pk
		            	
		    	$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
		    	$('#email_already_exist').hide();

		    	if (email_pattern.test(email) == false) {
		    		flag = false;
					$('input[name=email]').removeClass('is-valid').addClass('is-invalid');
		    		$('#error-email').html('Email must be like eg: ali9@yahoo.pk');
		    		$('#save-btn').css('display','none');
				    // $('#save-btn').prop('disabled',true);

		    	}else{
		    		$('button[name=submit]').attr('disabled', false);
		    		$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
		    		$('#error-email').html("");
		    		$('#save-btn').css('display','inline');
				    // $('#save-btn').prop('disabled',false);
				    $('input[name=hidden_value]').val("1");

		    		
		    		$.ajax({
		                type: 'POST',
		                url: 'beneficiary_form_process.php',
		                data: {applicant_id:id,email:email,action:'checked_email' },
		                success: function(responseText, statusText, HTTPRequest) {
		                    
		                    if(Number(responseText) == "1"){
		                    	$('button[name=submit]').attr('disabled', true);
		    					$('input[name=email]').addClass('is-invalid');
		    					$('#error-email').html("This email is already exist.");
		                    	$('#email_already_exist').show();
		                    	$('#save-btn').css('display','none');
				    			// $('#save-btn').prop('disabled',true);
				    			$('input[name=hidden_value]').val("0");
		                    }
		                }
		    		});
		    	}
		}

		function checked_cnic(cnic = null , id = null){
				var cnic_pattern  = /^\d{5}[0-9]{7}\d{1}$/;//4130312345671

		    	$('input[name=applicant_cnic]').removeClass('is-invalid').addClass('is-valid');
		        $('#cnic_already_exist').hide();

		    	if (cnic_pattern.test(cnic) == false) {
		    		flag = false;
					$('input[name=applicant_cnic]').removeClass('is-valid').addClass('is-invalid');
		    		$('#error-cnic').html('CNIC Numbers must be like eg: 4130312345671');
		    	}else{
		    		$('button[name=submit]').attr('disabled', false);
		    		//$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
		    		$('#error-cnic').html("");
		    		$('#save-btn').prop('disabled',false);
		    		
		    		$.ajax({
		                type: 'POST',
		                url: 'beneficiary_form_process.php',
		                data: {applicant_id:id,applicant_cnic:cnic,action:'checked_cnic' },
		                success: function(responseText, statusText, HTTPRequest) {
		                    // console.log(responseText);
		                	if(Number(responseText) == 1){
		                    	$('button[name=submit]').attr('disabled', true);
		    					$('input[name=applicant_cnic]').addClass('is-invalid');
		    					$('#error-cnic').html("This cnic is already exist.");
		                    	$('#cnic_already_exist').show();
		                    	$('#save-btn').prop('disabled',true);

		                    }
		                }
		    		});
		    	}
		}

		function check_is_father_alive(is_father_alive = null){
		
			if (is_father_alive == 'Yes') {
				$('#error-father-alive').html('<b>Hidaya Trust offers the Support Poor Student project only for those applicants who are orphans.</b>');
				$('#error-father-alive').show();
				// $("#nav-personal-info-tab").cursor("not-allowed");
				$("#nav-personal-info-tab").prop('disabled', true);
				$("#nextBtn").css('display', 'none');
				$('#death-certificate').hide();
				$('#father_nationl_id_card').hide();
				$('#father_label').hide();
				$('#father_first_name').hide();
				$('#father_middle_name').hide();	
				$('#father_last_name').hide();
				$('#father_occupation').hide();

			}else if(is_father_alive == 'No'){
				// alert('NO');
				$('#error-father-alive').hide();
				// $("#nav-personal-info-tab").prop('disabled', false);
				$("#nextBtn").css('display', 'block');
				$("#nextBtn").prop('disabled', true);
				$("#nextBtn").addClass('bg-secondary');
				$('#death-certificate').show();
				$('#father_nationl_id_card').show();
				$('#father_label').show();
				$('#father_first_name').show();
				$('#father_middle_name').show();	
				$('#father_last_name').show();
				$('#father_occupation').show();	
			}
		}


		function check_is_father_alive_edit(is_father_alive = null){
		
			if (is_father_alive == 'Yes') {
				// $('#error-father-alive').html('<b>Hidaya Trust offers the Support Poor Student project only for those applicants who are orphans.</b>');
				$("#nextBtn-edit").css('display','none');
				$('#father-death-certificate-file').hide();
				$('#father_nic').hide();
				$('#f_first_name').hide();
				$('#f_middle_name').hide();	
				$('#f_last_name').hide();
				$('#father_occupations').hide();
				$('#father_label').hide();
			}else{
				
				$("#nextBtn-edit").css('display', 'block');
				$('#father-death-certificate-file').show();
				$('#father_nic').show();
				$('#f_first_name').show();
				$('#f_middle_name').show();	
				$('#f_last_name').show();
				$('#father_occupations').show();
				$('#father_label').show();
			}
		}


		$(document).on("click","input[name='is_father_alive']:checked",function(){
			
			// alert($(this).val());
			if($(this).val() === "Yes"){
				$('#nextBtn-edit').css('display','none'); 
				
				$('#error-father-alive').html('<b>Hidaya Trust offers the Support Poor Student project only for those applicants who are orphans.</b>');   			
				$('#error-father-alive').show();
			}else{
				$('#error-father-alive').html('');   			
				$('#error-father-alive').hide();
			}
			  
		});

		
			


	</script>
    <!-- Internal Script Code:End -->

  	