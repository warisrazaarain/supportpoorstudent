
var is_death_certificate_selected = false;
$('.is_father_alive').on('click',function(){

	// alert($(this).val());
	if ($(this).val() == 'Yes') {
		$('#error-father-alive').html('<b>Hidaya Trust offers the Support Poor Student project only for those applicants who are orphans.</b>');
		$('#error-father-alive').show();
		$("#nav-personal-info-tab").prop('disabled', true);
		$("#nextBtn").css('display', 'none');
		$('#death-certificate').hide();	

		/*--- This code is for beneficiary update form tabs ---*/
			$(".second_link").prop('disabled', true);
			$("#nextBtn-update").css('display', 'none');
			$(".death-certificate-image").hide();
	}else{

		$('#error-father-alive').hide();
		$('#death-certificate').show();	

		/*--- This code is for beneficiary update form tabs ---*/
			$(".second_link").prop('disabled', false);
			$("#nextBtn-update").css('display', 'block');
			$(".death-certificate-image").show();
	}

});


$('#death-certificate-file').change(function(){

	console.log($(this)[0].files[0]);
	var applicant_father_death_certificate 	= $(this)[0].files[0];
				if (applicant_father_death_certificate != undefined) {
					$('#error-father-death-certificate').html('');
					var file_extension = (applicant_father_death_certificate.name.split('.').pop());
						file_extension = file_extension.toLowerCase();

					if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg")) {
						flag = false;
						$('input[name=applicant_father_death_certificate]').addClass('is-invalid');
						$('#error-father-death-certificate').html('File extension must be eg: (png | jpg | jpeg)');

						$("#nav-personal-info-tab").prop('disabled', true);
						$("#nextBtn").css('display', 'none');
						is_death_certificate_selected = false;
					}else{
						$('input[name=applicant_father_death_certificate]').removeClass('is-invalid').addClass('is-valid');

						$("#nav-personal-info-tab").prop('disabled', false);
						$("#nextBtn").css('display', 'block');
						is_death_certificate_selected = true;
					}
				}else{
					// is_death_certificate_selected = true;
					$('input[name=applicant_father_death_certificate]').removeClass('is-invalid');
				}
});


$(document).on("click","#nav-personal-info-tab,#nextBtn",function(){
	    			
	if($('input[name=is_father_alive]:checked').val() == 'No' && is_death_certificate_selected){
		$('#first_tab').hide();
		$('#nav-personal-info').addClass('show');
		$('#nav-personal-info-tab').addClass('active');
		$('#nav-father-alive-tab').removeClass('active');
	}    
});

$(document).on("click","#nav-father-alive-tab",function(){
	    			
    $('#first_tab').show();  
});

$('#adult_member,#under_18_member').bind("keyup",function(){

	var adults   = Number($("#adult_member").val());
	var under_18 = Number($("#under_18_member").val());
	totalFamilyMemebr(adults,under_18);

}).bind("change",function(){

	var adults   = Number($("#adult_member").val());
	var under_18 = Number($("#under_18_member").val());
	totalFamilyMemebr(adults,under_18);
});


function totalFamilyMemebr(value_1,value_2){
	
	if (value_1 < 0) {
		$("#adult_member").val('');
		value_1 = 0;
	}
	if (value_2 < 0) { 
		$("#under_18_member").val('');
		value_2 = 0;
	}

	var total_family_member = (value_1+value_2);

	if (total_family_member <= 0) {
		$("#total_family_member").val('');
	}else{
		$("#total_family_member").val(total_family_member)
	}
}
	
    

/* -----<< Applicant Update Form Tabs Code - Start >>-----*/
	/*--- This code is for beneficiary update form`s Next Button & Second Tab  ---*/
		$(document).on("click",'#nav-personal-info-update-tab,#nextBtn-update',function(){
			    			
			$('#first_tab').hide();
			$('#second_tab').show();
			$('#nav-father-alive-update-tab').removeClass('active');
			$('#nav-father-alive-update').removeClass('show active');

			$('#nav-personal-info-update-tab').addClass('active');
			$('#nav-personal-info-update').addClass('show active');
		});
	/*--- This code is for beneficiary update form`s First Tab Only  ---*/
		$(document).on("click","#nav-father-alive-update-tab",function(){
			    			
			$('#second_tab').hide();
			$('#first_tab').show();
		});

	/*-----<< Applicant: Image Viewer Plugin For Admin Index page >>-----*/
            lc_lightbox('.elem', {
                wrap_class: 'lcl_fade_oc',
                gallery : false,
                thumb_attr: 'data-lcl-thumb',
                skin: 'dark',
            });      
	/*-----<<Applicant: Image Viewer Plugin #End >>-----*/   

   /*-----<< Applicant Father`s Death Certificate Scanned Image Viewer Plugin For Admin View detail page >>-----*/
            lc_lightbox('.elem2', {
                wrap_class: 'lcl_fade_oc',
                gallery : false,
                thumb_attr: 'data-lcl-thumb',
                skin: 'dark',
            });
    /*-----<< Applicant Other Files Image Viewer Plugin For Admin View detail page >>-----*/
            lc_lightbox('.elem3', {
                wrap_class: 'lcl_fade_oc',
                gallery : true,
                thumb_attr: 'data-lcl-thumb',
                skin: 'dark',
            });        

/* Applicant Update Form Tabs Code - End*/            

  

// alert("ok");
/*Check Is Current Address Same As Permanent Address:Start*/
$(document).on("change","input[name=same_as_current_add]",function(){
	    			
	let current_address = $('textarea[name=current_address]').val();
	if(current_address !== ""){
		$('textarea[name=current_address]').addClass('is-valid').removeClass('is-invalid');
		$('#error-current-address').html('');
		if(this.checked === true){
			if(current_address !== ""){
				$('textarea[name=permanent_address]').val(current_address.trim()).removeClass('is-invalid').addClass('is-valid').attr('readonly',true);
				$('textarea[name=current_address]').attr('readonly',true);
			}
		}else{
			$('textarea[name=permanent_address]').val('').removeClass('is-valid').addClass('is-invalid').attr('readonly',false);
			$('textarea[name=current_address]').attr('readonly',false);

		}	
	}else{
		this.checked = false;
		$('textarea[name=current_address]').addClass('is-invalid').removeClass('is-valid');
		$('#error-current-address').html('This field is required.');
		$('textarea[name=permanent_address]').val('').removeClass('is-valid').attr('readonly',false);
		$('textarea[name=current_address]').attr('readonly',false);

	}
	    
});
/*Check Is Current Address Same As Permanent Address:End*/



function validateForm(){

	var flag = true;
	/*Fields:Start*/
		var first_name 			= $('input[name=first_name]').val();
		var middle_name 		= $('input[name=middle_name]').val();
		var last_name 			= $('input[name=last_name]').val();
		var email 				= $('input[name=email]').val();
		var gender 				= $('input[name=gender]:checked').val();
		var contact_number 		= $('input[name=contact_number]').val();
		var dob 				= $('input[name=date_of_birth]').val();
		var applicant_cnic 		= $('input[name=applicant_cnic]').val();
		var applicant_cnic_picture 	= $('input[name=applicant_cnic_picture]')[0].files[0];
		var current_address 	= $('textarea[name=current_address]').val();
		var permanent_address 	= $('textarea[name=permanent_address]').val();
		var applicant_picture 	= $('input[name=applicant_picture]')[0].files[0];
		var applicant_student_id_card_image 	= $('input[name=applicant_student_id_card_image]')[0].files[0];
		var applicant_highest_academic_degree 	= $('select[name=applicant_highest_academic_degree]').val();
		var applicant_marksheet_images 	= $('#applicant-marksheet-images')[0].files;
		var eligible_for_zakat 	= $('input[name=eligible_for_zakat]:checked').val();
		var is_father_alive 	= $('input[name=is_father_alive]:checked').val();
		var father_cnic 	    = $('input[name=father_cnic]').val();
		
		var father_first_name 			= $('input[name=father_first_name]').val();
		var father_middle_name 		= $('input[name=father_middle_name]').val();
		var father_last_name 			= $('input[name=father_last_name]').val();
		var father_occupation 			= $('input[name=father_occupation]').val();
		var is_currently_enrolled_in_uni 	= $('input[name=is_currently_enrolled_in_uni]:checked').val();
		var applicant_university_admission 	= $('input[name=applicant_university_admission]:checked').val();
		var is_currently_working 	= $('input[name=is_currently_working]:checked').val();
		var applicant_skill 	= $('input[name=applicant_skill]:checked').val();
		var financial_help 	= $('input[name=financial_help]:checked').val();
		var total_family_member = $('input[name=total_family_member]').val();
		var adult 			    = $('input[name=adult]').val();
		var children_under_age  = $('input[name=children_under_age]').val();
		var total_family_monthly_income  = $('input[name=total_family_monthly_income]').val();
		var how_many_earning_members  = $('input[name=how_many_earning_members]').val();
		var agreement 	= $('input[name=agreement]:checked').val();

		// console.log(is_father_alive);
	/*Fields:End*/
	
	/*Patterns:Start*/
		var alpha_pattern 			= /^[A-Z]{1}[a-z]{2,}$/; //Ali
		var contact_number_patterns = /^[92]{2}\d{3}\d{7}$/; //923001234567
		var email_pattern 			= /^[a-z]{2,}\w*[@]{1}[a-z]{2,}[.]{1}[a-z]{2,6}$/;//ali9@yahoo.pk
		var cnic_pattern  			= /^\d{5}[0-9]{7}\d{1}$/;//4130312345671


	/*Patterns:End*/
	
	/*Applicant FirstName Validation:Start*/
		if (first_name == "") {
			flag = false;
			$('input[name=first_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-first-name').html('This field is required.');
	    
	    }else{
			$('input[name=first_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(first_name) == false) {
	    		flag = false;
				$('input[name=first_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-first-name').html('First Name must be like eg: Ali ...');
	    	}   
		}
	/*Applicant FirstName Validation:End*/

	/*Applicant MiddleName Validation:Start*/
		if (middle_name != "") {
			$('#error-middle-name').html('');
			if (alpha_pattern.test(middle_name) == false) {
				flag = false;
				$('input[name=middle_name]').addClass('is-invalid').removeClass('bottom-margin');;
				$('#error-middle-name').html('Middle Name must be like eg: Ahmed ...');
			}else{
				$('input[name=middle_name]').removeClass('is-invalid').addClass('is-valid bottom-margin')
			}
		}else{
			$('input[name=middle_name]').removeClass('is-invalid is-valid').addClass('bottom-margin');
		}
	/*Applicant MiddleName Validation:End*/

	/*Applicant LastName Validation:Start*/
		if (last_name == "") {
			flag = false;
			$('input[name=last_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-last-name').html('This field is required.');
	    
	    }else{
			$('input[name=last_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(last_name) == false) {
	    		flag = false;
				$('input[name=last_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-last-name').html('Last Name must be like eg: Khan ...');
	    	}   
		}
	/*Applicant LastName Validation:End*/

	/*Applicant Gender Validation:Start*/
		if ((gender != "Male") && (gender != "Female")) {
			flag = false;
	    	$('#error-gender').html('This field is required.');
			$('#error-gender').show();
		}else{
			$('#error-gender').html('');
			$('#error-gender').hide();
		}
	/*Applicant Gender Validation:End*/

	/*Applicant Contact Numbers Validation:Start*/
		if (contact_number == "") {
			flag = false;
			$('input[name=contact_number]').addClass('is-invalid');
	    	$('#error-contact-number').html('This field is required.');
	    
	    }else{
			$('input[name=contact_number]').removeClass('is-invalid').addClass('is-valid');
	    	$('#error-contact-number').html('');
	    	
	    	if (contact_number_patterns.test(contact_number) == false) {
	    		flag = false;
				$('input[name=contact_number]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-contact-number').html('Contact Numbers must be like eg: 923001234567');
	    	}   
		}
	/*Applicant Contact Numbers Validation:End*/

	/*Applicant Email Validation:Start*/
		if (email == "") {
			flag = false;
			$('input[name=email]').addClass('is-invalid');
	    	$('#error-email').html('This field is required.');
	    
	    }else{
			$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
	    	if (email_pattern.test(email) == false) {
	    		flag = false;
				$('input[name=email]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-email').html('Email must be like eg: ali9@yahoo.pk');
	    	}   
		}
	/*Applicant Email Validation:End*/

	/*Applicant DOB Validation:Start*/
		if (dob == "") {
			flag = false;
			$('input[name=date_of_birth]').addClass('is-invalid');
	    	$('#error-dob').html('This field is required.');
	    
	    }else{
			$('input[name=date_of_birth]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant DOB Validation:End*/

	/*Applicant CNIC Numbers Validation:Start*/
		if (applicant_cnic == "") {
			flag = false;
			$('input[name=applicant_cnic]').addClass('is-invalid');
	    	$('#error-cnic').html('This field is required.');
	    
	    }else{
			$('input[name=applicant_cnic]').removeClass('is-invalid').addClass('is-valid');
	    	if (cnic_pattern.test(applicant_cnic) == false) {
	    		flag = false;
				$('input[name=applicant_cnic]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-cnic').html('CNIC Numbers must be like eg: 4130312345671');
	    	}   
		}
	/*Applicant CNIC Numbers Validation:End*/


	/*Applicant CNIC Numbers Picture Validation:Start*/
		if (applicant_cnic_picture != undefined) {
					$('#error-applicant-cnic-picture').html('');
					var file_extension = (applicant_cnic_picture.name.split('.').pop());
						
						// console.log(file_extension);
						file_extension = file_extension.toLowerCase();
					if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg")) {
						flag = false;
						$('input[name=applicant_cnic_picture]').addClass('is-invalid');
						$('#error-applicant-cnic-picture').html('File extension must be eg: (png | jpg | jpeg)');
					}else{
						$('input[name=applicant_cnic_picture]').removeClass('is-invalid').addClass('is-valid')
					}
				}else{
					//$('input[name=applicant_picture]').removeClass('is-invalid');
					flag = false;
							$('input[name=applicant_cnic_picture]').addClass('is-invalid');
							$('#error-applicant-cnic-picture').html('This field is required.');
				}
	/*Applicant CNIC Numbers Picture Validation:End*/




	/*Applicant CurrentAddress Validation:Start*/
		if (current_address == "") {
			flag = false;
			$('textarea[name=current_address]').addClass('is-invalid');
	    	$('#error-current-address').html('This field is required.');
	    
	    }else{
			$('textarea[name=current_address]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant CurrentAddress Validation:End*/

	/*Applicant ParmanentAddress Validation:Start*/
		if (permanent_address == "") {
			flag = false;
			$('textarea[name=permanent_address]').addClass('is-invalid');
	    	$('#error-permanent-address').html('This field is required.');
	    
	    }else{
			$('textarea[name=permanent_address]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant ParmanentAddress Validation:End*/

	/*Applicant Applicant Profile Picture Validation:Start*/
		if (applicant_picture != undefined) {
			$('#error-applicant-picture').html('');
			var file_extension = (applicant_picture.name.split('.').pop());
				
				// console.log(file_extension);
				file_extension = file_extension.toLowerCase();
			if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg")) {
				flag = false;
				$('input[name=applicant_picture]').addClass('is-invalid');
				$('#error-applicant-picture').html('File extension must be eg: (png | jpg | jpeg)');
			}else{
				$('input[name=applicant_picture]').removeClass('is-invalid').addClass('is-valid')
			}
		}else{
			//$('input[name=applicant_picture]').removeClass('is-invalid');
			flag = false;
					$('input[name=applicant_picture]').addClass('is-invalid');
					$('#error-applicant-picture').html('This field is required.');
		}
	/*Applicant Applicant Profile Picture Validation:End*/

	/*Applicant Student ID Card Image Validation:Start*/
		if (applicant_student_id_card_image != undefined) {
			$('#error-applicant-student-id-card-image').html('');
			var file_extension = (applicant_student_id_card_image.name.split('.').pop());
				file_extension = file_extension.toLowerCase();

			if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg")) {
				flag = false;
				$('input[name=applicant_student_id_card_image]').addClass('is-invalid');
				$('#error-applicant-student-id-card-image').html('File extension must be eg: (png | jpg | jpeg)');
			}else{
				$('input[name=applicant_student_id_card_image]').removeClass('is-invalid').addClass('is-valid')
			}
		}else{
			flag = false;
					$('input[name=applicant_student_id_card_image]').addClass('is-invalid');
					$('#error-applicant-student-id-card-image').html('This field is required.');
		}
	/*Applicant Student ID Card Image Validation:End*/

	/*Applicant Degree Validation:Start*/
		if (applicant_highest_academic_degree == "") {
			flag = false;
			$('select[name=applicant_highest_academic_degree]').addClass('is-invalid');
	    	$('#error-highest-degree').html('This field is required.');
	    
	    }else{
			$('select[name=applicant_highest_academic_degree]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant Degree Validation:End*/

	/*Applicant Applicant Marksheets Picture Validation:Start*/
		var files_length = applicant_marksheet_images.length
		var file_counter = 0;
		if ( (files_length != 0)) {
			if(files_length >= 2){
				$('#error-marksheet-images').html('');
				for(let i = 0; i < files_length; i++ )
				{
					var file_extension = (applicant_marksheet_images[i].name.split('.').pop());
					file_extension = file_extension.toLowerCase();
					if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg")) {
							file_counter++;
							break;
					}
				}

				if(file_counter > 0){
					flag = false;
					$('#applicant-marksheet-images').addClass('is-invalid');
					$('#error-marksheet-images').html('File extension must be eg: (png | jpg | jpeg)');
				}else{
					$('#applicant-marksheet-images').removeClass('is-invalid').addClass('is-valid')
				}
			}else{
				$('#error-marksheet-images').html('Atleast Select 2 Marksheets');
				$('#applicant-marksheet-images').addClass('is-invalid');
			}
			
		}
	/*Applicant Applicant Marksheets Picture Validation:End*/


	/*Applicant Zakat Reason Validation:Start*/
		if ((eligible_for_zakat != undefined) && (eligible_for_zakat == "Yes")) {
			var reason_for_zakat = $('input[name=reason_for_zakat]').val();
			if (reason_for_zakat =="") {
				flag = false;
				$('#error-reason-zakat').html('This field is required.');
				$('input[name=reason_for_zakat]').addClass('is-invalid');
			}else{
				$('#error-reason-zakat').html('');
				$('input[name=reason_for_zakat]').addClass('is-valid').removeClass('is-invalid');
			}
		}
	/*Applicant Zakat Reason Validation:End*/

	/*Applicant Is Father Alive Validation:Start*/
		if (is_father_alive != undefined) {
			$('#error-father-alive').html('');
			$('#error-father-alive').hide();

			if (is_father_alive == "No") {
				var applicant_father_death_certificate 	= $('input[name=applicant_father_death_certificate]')[0].files[0];
				if (applicant_father_death_certificate != undefined) {
					$('#error-father-death-certificate').html('');
					var file_extension = (applicant_father_death_certificate.name.split('.').pop());
						file_extension = file_extension.toLowerCase();
						console.log(file_extension);
					if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg")) {
						flag = false;
						$('input[name=applicant_father_death_certificate]').addClass('is-invalid');
						$('#error-father-death-certificate').html('File extension must be eg: (png | jpg | jpeg)');
					}else{
						$('input[name=applicant_father_death_certificate]').removeClass('is-invalid').addClass('is-valid')
					}
				}else{
					$('input[name=applicant_father_death_certificate]').removeClass('is-invalid');
				}

			}
		}else{
			flag = false;
			$('#error-father-alive').html('This field is required.');
			$('#error-father-alive').show();
		}
	/*Applicant Is Father Alive Validation:End*/

	/*Applicant Father`s CNIC Numbers Validation:Start*/
		if (father_cnic == "") {
			flag = false;
			$('input[name=father_cnic]').addClass('is-invalid');
	    	$('#error-father-cnic').html('This field is required.');
	    
	    }else{
			$('input[name=father_cnic]').removeClass('is-invalid').addClass('is-valid');
	    	if (cnic_pattern.test(father_cnic) == false) {
	    		flag = false;
				$('input[name=father_cnic]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-father-cnic').html('CNIC Numbers must be like eg: 4130312345671');
	    	}   
		}
	/*Applicant Father`s CNIC Numbers Validation:End*/

	
	/*Applicant Father`s FirstName Validation:Start*/
		if (father_first_name == "") {
			flag = false;
			$('input[name=father_first_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-father-first-name').html('This field is required.');
	    
	    }else{
			$('input[name=father_first_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(father_first_name) == false) {
	    		flag = false;
				$('input[name=father_first_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-father-first-name').html('First Name must be like eg: Ali ...');
	    	}   
		}
	/*Applicant Father`s FirstName Validation:End*/

	/*Applicant Father`s MiddleName Validation:Start*/
		if (father_middle_name != "") {
			$('#error-father-middle-name').html('');
			if (alpha_pattern.test(father_middle_name) == false) {
				flag = false;
				$('input[name=father_middle_name]').addClass('is-invalid').removeClass('bottom-margin');;
				$('#error-father-middle-name').html('Middle Name must be like eg: Ahmed ...');
			}else{
				$('input[name=father_middle_name]').removeClass('is-invalid').addClass('is-valid bottom-margin')
			}
		}else{
			$('input[name=father_middle_name]').removeClass('is-invalid is-valid').addClass('bottom-margin');
		}
	/*Applicant Father`s MiddleName Validation:End*/

	/*Applicant Father`s LastName Validation:Start*/
		if (father_last_name == "") {
			flag = false;
			$('input[name=father_last_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-father-last-name').html('This field is required.');
	    
	    }else{
			$('input[name=father_last_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(father_last_name) == false) {
	    		flag = false;
				$('input[name=father_last_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-father-last-name').html('Last Name must be like eg: Khan ...');
	    	}   
		}
	/*Applicant Father`s LastName Validation:End*/

	/*Applicant Father Occupation Validation:Start*/
		if (father_occupation == "") {
			flag = false;
			$('input[name=father_occupation]').addClass('is-invalid');
	    	$('#error-father-occupation').html('This field is required.');
	    
	    }else{
			$('input[name=father_occupation]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant Father Occupation Validation:End*/

	/*Applicant Enrolled In Uni Validation:Start*/
		if (is_currently_enrolled_in_uni != undefined) {
			$('#error-currently-enrolled-uni').html('');
			$('#error-currently-enrolled-uni').hide();

			if (is_currently_enrolled_in_uni == "Yes") {

				var univerity = $('select[name=univerity]').val();
				var univerity_year = $('select[name=univerity_year]').val();
				var degree_completed_year = $('input[name=degree_completed_year]').val();

				if (univerity == "") {
				    flag = false;
					$('select[name=univerity]').addClass('is-invalid');
			    	$('#error-university').html('This field is required.');
			    
			    }else{
					$('select[name=univerity]').removeClass('is-invalid').addClass('is-valid');
			    }

			    if (univerity_year == "") {
				    flag = false;
					$('select[name=univerity_year]').addClass('is-invalid');
			    	$('#error-university-year').html('This field is required.');
			    
			    }else{
					$('select[name=univerity_year]').removeClass('is-invalid').addClass('is-valid');
			    }

			    if (degree_completed_year == "") {
				    flag = false;
					$('input[name=degree_completed_year]').addClass('is-invalid');
			    	$('#error-degree-year').html('This field is required.');
			    
			    }else{
					$('input[name=degree_completed_year]').removeClass('is-invalid').addClass('is-valid');
			    }


			}
		}else{
			flag = false;
			$('#error-currently-enrolled-uni').html('This field is required.');
			$('#error-currently-enrolled-uni').show();
		}
	/*Applicant Enrolled In Uni Validation:End*/

	/*Applicant University Admission Validation:Start*/
		if (applicant_university_admission != undefined) {
			$('#error-uni-admission').html('');
			$('#error-uni-admission').hide();
		}else{
			flag = false;
			$('#error-uni-admission').html('This field is required.');
			$('#error-uni-admission').show();
		}
	/*Applicant University Admission Validation:End*/


	/*Applicant Currently Working Validation:Start*/
		if (is_currently_working != undefined) {
			$('#error-currently-working').html('');
			$('#error-currently-working').hide();

			if (is_currently_working == "Yes") {

				var how_much_earning = $('input[name=how_much_earning]').val();
				if (how_much_earning == "") {
				    flag = false;
					$('input[name=how_much_earning]').addClass('is-invalid');
			    	$('#error-how-much-earning').html('This field is required.');
			    
			    }else{
					$('input[name=how_much_earning]').removeClass('is-invalid').addClass('is-valid');
			    }

			}
		}else{
			flag = false;
			$('#error-currently-working').html('This field is required.');
			$('#error-currently-working').show();
		}
	/*Applicant Currently Working Validation:End*/

	/*Applicant Skill Validation:Start*/
		if (applicant_skill != undefined) {
			$('#error-skill').html('');
			$('#error-skill').hide();

			if (applicant_skill == "Yes") {

				var what_skill = $('input[name=what_skill]').val();
				if (what_skill == "") {
				    flag = false;
					$('input[name=what_skill]').addClass('is-invalid');
			    	$('#error-what-skill').html('This field is required.');
			    
			    }else{
					$('input[name=what_skill]').removeClass('is-invalid').addClass('is-valid');
			    }

			}
		}else{
			flag = false;
			$('#error-skill').html('This field is required.');
			$('#error-skill').show();
		}
	/*Applicant Skill Validation:End*/

	/*Applicant Financial Help Validation:Start*/
		if (financial_help != undefined) {
			$('#error-financial-help').html('');
			$('#error-financial-help').hide();

			if (financial_help == "Yes") {

				var how_much_financial_help = $('input[name=how_much_financial_help]').val();
				var from_where_financial_help = $('input[name=from_where_financial_help]').val();
				var financial_help_image 	= $('input[name=financial_help_image]')[0].files[0];

				if (how_much_financial_help == "") {
				    flag = false;
					$('input[name=how_much_financial_help]').addClass('is-invalid');
			    	$('#error-how-much-financial-help').html('This field is required.');
			    
			    }else{
					$('input[name=how_much_financial_help]').removeClass('is-invalid').addClass('is-valid');
			    }

			    if (from_where_financial_help == "") {
				    flag = false;
					$('input[name=from_where_financial_help]').addClass('is-invalid');
			    	$('#error-from-where-financial-help').html('This field is required.');
			    }else{
					$('input[name=from_where_financial_help]').removeClass('is-invalid').addClass('is-valid');
			    }

				if (financial_help_image != undefined) {
					$('#error-financial-help-image').html('');
					var file_extension = (financial_help_image.name.split('.').pop());
						file_extension = file_extension.toLowerCase();
						console.log(file_extension);
					if ((file_extension != "png") && (file_extension != "jpg") && (file_extension != "jpeg")) {
						flag = false;
						$('input[name=financial_help_image]').addClass('is-invalid');
						$('#error-financial-help-image').html('File extension must be eg: (png | jpg | jpeg)');
					}else{
						$('input[name=financial_help_image]').removeClass('is-invalid').addClass('is-valid')
					}
				}else{
					flag = false;
					$('input[name=financial_help_image]').addClass('is-invalid');
					$('#error-financial-help-image').html('This field is required.');
				}



			}
		}else{
			flag = false;
			$('#error-financial-help').html('This field is required.');
			$('#error-financial-help').show();
		}
	/*Applicant Financial Help Validation:End*/


	/*Applicant Total Number of Family Members Validation:Start*/
		if (total_family_member == "") {
			flag = false;
			$('input[name=total_family_member]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-total-family-members').html('This field is required.');
			$('#error-total-family-members').show();
		}else{
			$('input[name=total_family_member]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-total-family-members').html('');
			$('#error-total-family-members').hide();
		}

		if (adult == "") {
			flag = false;
			$('input[name=adult]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-adult').html('This field is required.');
			$('#error-adult').show();
		}else{
			$('input[name=adult]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-adult').html('');
			$('#error-adult').hide();
		}

		if (children_under_age == "") {
			flag = false;
			$('input[name=children_under_age]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-children-under-age').html('This field is required.');
			$('#error-children-under-age').show();
		}else{
			$('input[name=children_under_age]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-children-under-age').html('');
			$('#error-children-under-age').hide();
		}
	/*Applicant Total Number of Family Members Validation:End*/

	/*Applicant Total Monthly Family Income Validation:Start*/
		if (total_family_monthly_income == "") {
			flag = false;
			$('input[name=total_family_monthly_income]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-total-family-monthly-income').html('This field is required.');
			$('#error-total-family-monthly-income').show();
		}else{
			$('input[name=total_family_monthly_income]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-total-family-monthly-income').html('');
			$('#error-total-family-monthly-income').hide();
		}

		if (how_many_earning_members == "") {
			flag = false;
			$('input[name=how_many_earning_members]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-how-many-earning-members').html('This field is required.');
			$('#error-how-many-earning-members').show();
		}else{
			$('input[name=how_many_earning_members]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-how-many-earning-members').html('');
			$('#error-how-many-earning-members').hide();
		}
	/*Applicant Total Monthly Family Income Validation:End*/

	/*Applicant Terms Agreement Validation:Start*/
		if (agreement == undefined) {
			flag = false;
			$('#error-agreement').show();
		}else{
			$('#error-agreement').hide();
		}
	/*Applicant Terms Agreement Validation:End*/

    if(!flag){
    	window.scrollTo(0, 0);
    	$('#error-appropriate').show();	
    }
	return flag;
    // alert(flag);
	// return true;
}

/* This Validation For Update Beneficiary Form */

function validateUpdateForm(){

	var flag = true;
	/*Fields:Start*/
		var first_name 			= $('input[name=first_name]').val();
		var middle_name 		= $('input[name=middle_name]').val();
		var last_name 			= $('input[name=last_name]').val();
		var email 				= $('input[name=email]').val();
		var gender 				= $('input[name=gender]:checked').val();
		var contact_number 		= $('input[name=contact_number]').val();
		var dob 				= $('input[name=date_of_birth]').val();
		var applicant_cnic 		= $('input[name=applicant_cnic]').val();
		var current_address 	= $('textarea[name=current_address]').val();
		var permanent_address 	= $('textarea[name=permanent_address]').val();

		var applicant_highest_academic_degree 	= $('select[name=applicant_highest_academic_degree]').val();
		var eligible_for_zakat 					= $('input[name=eligible_for_zakat]:checked').val();
		var is_father_alive 					= $('input[name=is_father_alive]:checked').val();
		var father_cnic 	    				= $('input[name=father_cnic]').val();
		var father_first_name 					= $('input[name=father_first_name]').val();
		var father_middle_name 					= $('input[name=father_middle_name]').val();
		var father_last_name 					= $('input[name=father_last_name]').val();
		var father_occupation 					= $('input[name=father_occupation]').val();
		var is_currently_enrolled_in_uni 		= $('input[name=is_currently_enrolled_in_uni]:checked').val();
		var applicant_university_admission 		= $('input[name=applicant_university_admission]:checked').val();
		var is_currently_working 				= $('input[name=is_currently_working]:checked').val();
		var applicant_skill 					= $('input[name=applicant_skill]:checked').val();
		var financial_help 						= $('input[name=financial_help]:checked').val();
		var total_family_member 				= $('input[name=total_family_member]').val();
		var adult 			    				= $('input[name=adult]').val();
		var children_under_age  				= $('input[name=children_under_age]').val();
		var total_family_monthly_income  		= $('input[name=total_family_monthly_income]').val();
		var how_many_earning_members  			= $('input[name=how_many_earning_members]').val();
		var agreement 							= $('input[name=agreement]:checked').val();
	/*Fields:End*/
	
	/*Patterns:Start*/
		var alpha_pattern 			= /^[A-Z]{1}[a-z]{2,}$/; //Ali
		var contact_number_patterns = /^[92]{2}\d{3}\d{7}$/; //923001234567
		var email_pattern 			= /^[a-z]{2,}\w*[@]{1}[a-z]{2,}[.]{1}[a-z]{2,6}$/;//ali9@yahoo.pk
		var cnic_pattern  			= /^\d{5}[0-9]{7}\d{1}$/;//4130312345671
	/*Patterns:End*/
	
	/*Applicant FirstName Validation:Start*/
		if (first_name == "") {
			flag = false;
			$('input[name=first_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-first-name').html('This field is required.');
	    
	    }else{
			$('input[name=first_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(first_name) == false) {
	    		flag = false;
				$('input[name=first_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-first-name').html('First Name must be like eg: Ali ...');
	    	}   
		}
	/*Applicant FirstName Validation:End*/

	/*Applicant MiddleName Validation:Start*/
		if (middle_name != "") {
			$('#error-middle-name').html('');
			if (alpha_pattern.test(middle_name) == false) {
				flag = false;
				$('input[name=middle_name]').addClass('is-invalid').removeClass('bottom-margin');;
				$('#error-middle-name').html('Middle Name must be like eg: Ahmed ...');
			}else{
				$('input[name=middle_name]').removeClass('is-invalid').addClass('is-valid bottom-margin')
			}
		}else{
			$('input[name=middle_name]').removeClass('is-invalid is-valid').addClass('bottom-margin');
		}
	/*Applicant MiddleName Validation:End*/

	/*Applicant LastName Validation:Start*/
		if (last_name == "") {
			flag = false;
			$('input[name=last_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-last-name').html('This field is required.');
	    
	    }else{
			$('input[name=last_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(last_name) == false) {
	    		flag = false;
				$('input[name=last_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-last-name').html('Last Name must be like eg: Khan ...');
	    	}   
		}
	/*Applicant LastName Validation:End*/

	/*Applicant Gender Validation:Start*/
		if ((gender != "Male") && (gender != "Female")) {
			flag = false;
	    	$('#error-gender').html('This field is required.');
			$('#error-gender').show();
		}else{
			$('#error-gender').html('');
			$('#error-gender').hide();
		}
	/*Applicant Gender Validation:End*/

	/*Applicant Contact Numbers Validation:Start*/
		if (contact_number == "") {
			flag = false;
			$('input[name=contact_number]').addClass('is-invalid');
	    	$('#error-contact-number').html('This field is required.');
	    
	    }else{
			$('input[name=contact_number]').removeClass('is-invalid').addClass('is-valid');
	    	$('#error-contact-number').html('');
	    	
	    	if (contact_number_patterns.test(contact_number) == false) {
	    		flag = false;
				$('input[name=contact_number]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-contact-number').html('Contact Numbers must be like eg: 923001234567');
	    	}   
		}
	/*Applicant Contact Numbers Validation:End*/

	/*Applicant Email Validation:Start*/
		if (email == "") {
			flag = false;
			$('input[name=email]').addClass('is-invalid');
	    	$('#error-email').html('This field is required.');
	    
	    }else{
			$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
	    	if (email_pattern.test(email) == false) {
	    		flag = false;
				$('input[name=email]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-email').html('Email must be like eg: ali9@yahoo.pk');
	    	}   
		}
	/*Applicant Email Validation:End*/

	/*Applicant DOB Validation:Start*/
		if (dob == "") {
			flag = false;
			$('input[name=date_of_birth]').addClass('is-invalid');
	    	$('#error-dob').html('This field is required.');
	    
	    }else{
			$('input[name=date_of_birth]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant DOB Validation:End*/

	/*Applicant CNIC Numbers Validation:Start*/
		if (applicant_cnic == "") {
			flag = false;
			$('input[name=applicant_cnic]').addClass('is-invalid');
	    	$('#error-cnic').html('This field is required.');
	    
	    }else{
			$('input[name=applicant_cnic]').removeClass('is-invalid').addClass('is-valid');
	    	if (cnic_pattern.test(applicant_cnic) == false) {
	    		flag = false;
				$('input[name=applicant_cnic]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-cnic').html('CNIC Numbers must be like eg: 4130312345671');
	    	}   
		}
	/*Applicant CNIC Numbers Validation:End*/

	/*Applicant CurrentAddress Validation:Start*/
		if (current_address == "") {
			flag = false;
			$('textarea[name=current_address]').addClass('is-invalid');
	    	$('#error-current-address').html('This field is required.');
	    
	    }else{
			$('textarea[name=current_address]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant CurrentAddress Validation:End*/

	/*Applicant ParmanentAddress Validation:Start*/
		if (permanent_address == "") {
			flag = false;
			$('textarea[name=permanent_address]').addClass('is-invalid');
	    	$('#error-permanent-address').html('This field is required.');
	    
	    }else{
			$('textarea[name=permanent_address]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant ParmanentAddress Validation:End*/

	/*Applicant Degree Validation:Start*/
		if (applicant_highest_academic_degree == "") {
			flag = false;
			$('select[name=applicant_highest_academic_degree]').addClass('is-invalid');
	    	$('#error-highest-degree').html('This field is required.');
	    
	    }else{
			$('select[name=applicant_highest_academic_degree]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant Degree Validation:End*/

	/*Applicant Zakat Reason Validation:Start*/
		if ((eligible_for_zakat != undefined) && (eligible_for_zakat == "Yes")) {
			var reason_for_zakat = $('input[name=reason_for_zakat]').val();
			if (reason_for_zakat =="") {
				flag = false;
				$('#error-reason-zakat').html('This field is required.');
				$('input[name=reason_for_zakat]').addClass('is-invalid');
			}else{
				$('#error-reason-zakat').html('');
				$('input[name=reason_for_zakat]').addClass('is-valid').removeClass('is-invalid');
			}
		}
	/*Applicant Zakat Reason Validation:End*/

	/*Applicant Is Father Alive Validation:Start*/
		if (is_father_alive == undefined) {
			flag = false;
			$('#error-father-alive').html('This field is required.');
			$('#error-father-alive').show();
		}
	/*Applicant Is Father Alive Validation:End*/

	/*Applicant Father`s CNIC Numbers Validation:Start*/
		if (father_cnic == "") {
			flag = false;
			$('input[name=father_cnic]').addClass('is-invalid');
	    	$('#error-father-cnic').html('This field is required.');
	    
	    }else{
			$('input[name=father_cnic]').removeClass('is-invalid').addClass('is-valid');
	    	if (cnic_pattern.test(father_cnic) == false) {
	    		flag = false;
				$('input[name=father_cnic]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-father-cnic').html('CNIC Numbers must be like eg: 4130312345671');
	    	}   
		}
	/*Applicant Father`s CNIC Numbers Validation:End*/

	
	/*Applicant Father`s FirstName Validation:Start*/
		if (father_first_name == "") {
			flag = false;
			$('input[name=father_first_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-father-first-name').html('This field is required.');
	    
	    }else{
			$('input[name=father_first_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(father_first_name) == false) {
	    		flag = false;
				$('input[name=father_first_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-father-first-name').html('First Name must be like eg: Ali ...');
	    	}   
		}
	/*Applicant Father`s FirstName Validation:End*/

	/*Applicant Father`s MiddleName Validation:Start*/
		if (father_middle_name != "") {
			$('#error-father-middle-name').html('');
			if (alpha_pattern.test(father_middle_name) == false) {
				flag = false;
				$('input[name=father_middle_name]').addClass('is-invalid').removeClass('bottom-margin');;
				$('#error-father-middle-name').html('Middle Name must be like eg: Ahmed ...');
			}else{
				$('input[name=father_middle_name]').removeClass('is-invalid').addClass('is-valid bottom-margin')
			}
		}else{
			$('input[name=father_middle_name]').removeClass('is-invalid is-valid').addClass('bottom-margin');
		}
	/*Applicant Father`s MiddleName Validation:End*/

	/*Applicant Father`s LastName Validation:Start*/
		if (father_last_name == "") {
			flag = false;
			$('input[name=father_last_name]').addClass('is-invalid').removeClass('bottom-margin');
	    	$('#error-father-last-name').html('This field is required.');
	    
	    }else{
			$('input[name=father_last_name]').removeClass('is-invalid').addClass('is-valid bottom-margin');
	    	if (alpha_pattern.test(father_last_name) == false) {
	    		flag = false;
				$('input[name=father_last_name]').removeClass('is-valid bottom-margin').addClass('is-invalid');
	    		$('#error-father-last-name').html('Last Name must be like eg: Khan ...');
	    	}   
		}
	/*Applicant Father`s LastName Validation:End*/

	/*Applicant Father Occupation Validation:Start*/
		if (father_occupation == "") {
			flag = false;
			$('input[name=father_occupation]').addClass('is-invalid');
	    	$('#error-father-occupation').html('This field is required.');
	    
	    }else{
			$('input[name=father_occupation]').removeClass('is-invalid').addClass('is-valid');
	    }
	/*Applicant Father Occupation Validation:End*/

	/*Applicant Enrolled In Uni Validation:Start*/
		if (is_currently_enrolled_in_uni != undefined) {
			$('#error-currently-enrolled-uni').html('');
			$('#error-currently-enrolled-uni').hide();

			if (is_currently_enrolled_in_uni == "Yes") {

				var university = $('select[name=university]').val();
				var university_year = $('select[name=university_year]').val();
				var degree_completed_year = $('input[name=degree_completed_year]').val();

				if (university == "") {
				    flag = false;
					$('select[name=university]').addClass('is-invalid');
			    	$('#error-university').html('This field is required.');
			    
			    }else{
					$('select[name=university]').removeClass('is-invalid').addClass('is-valid');
			    }

			    if (university_year == "") {
				    flag = false;
					$('select[name=university_year]').addClass('is-invalid');
			    	$('#error-university-year').html('This field is required.');
			    
			    }else{
					$('select[name=university_year]').removeClass('is-invalid').addClass('is-valid');
			    }

			    if (degree_completed_year == "") {
				    flag = false;
					$('input[name=degree_completed_year]').addClass('is-invalid');
			    	$('#error-degree-year').html('This field is required.');
			    
			    }else{
					$('input[name=degree_completed_year]').removeClass('is-invalid').addClass('is-valid');
			    }


			}
		}else{
			flag = false;
			$('#error-currently-enrolled-uni').html('This field is required.');
			$('#error-currently-enrolled-uni').show();
		}
	/*Applicant Enrolled In Uni Validation:End*/

	/*Applicant University Admission Validation:Start*/
		if (applicant_university_admission != undefined) {
			$('#error-uni-admission').html('');
			$('#error-uni-admission').hide();
		}else{
			flag = false;
			$('#error-uni-admission').html('This field is required.');
			$('#error-uni-admission').show();
		}
	/*Applicant University Admission Validation:End*/


	/*Applicant Currently Working Validation:Start*/
		if (is_currently_working != undefined) {
			$('#error-currently-working').html('');
			$('#error-currently-working').hide();

			if (is_currently_working == "Yes") {

				var how_much_earning = $('input[name=how_much_earning]').val();
				if (how_much_earning == "") {
				    flag = false;
					$('input[name=how_much_earning]').addClass('is-invalid');
			    	$('#error-how-much-earning').html('This field is required.');
			    
			    }else{
					$('input[name=how_much_earning]').removeClass('is-invalid').addClass('is-valid');
			    }

			}
		}else{
			flag = false;
			$('#error-currently-working').html('This field is required.');
			$('#error-currently-working').show();
		}
	/*Applicant Currently Working Validation:End*/

	/*Applicant Skill Validation:Start*/
		if (applicant_skill != undefined) {
			$('#error-skill').html('');
			$('#error-skill').hide();

			if (applicant_skill == "Yes") {

				var what_skill = $('input[name=what_skill]').val();
				if (what_skill == "") {
				    flag = false;
					$('input[name=what_skill]').addClass('is-invalid');
			    	$('#error-what-skill').html('This field is required.');
			    
			    }else{
					$('input[name=what_skill]').removeClass('is-invalid').addClass('is-valid');
			    }

			}
		}else{
			flag = false;
			$('#error-skill').html('This field is required.');
			$('#error-skill').show();
		}
	/*Applicant Skill Validation:End*/

	/*Applicant Financial Help Validation:Start*/
		if (financial_help != undefined) {
			$('#error-financial-help').html('');
			$('#error-financial-help').hide();

			if (financial_help == "Yes") {

				var how_much_financial_help = $('input[name=how_much_financial_help]').val();
				var from_where_financial_help = $('input[name=from_where_financial_help]').val();

				if (how_much_financial_help == "") {
				    flag = false;
					$('input[name=how_much_financial_help]').addClass('is-invalid');
			    	$('#error-how-much-financial-help').html('This field is required.');
			    
			    }else{
					$('input[name=how_much_financial_help]').removeClass('is-invalid').addClass('is-valid');
			    }

			    if (from_where_financial_help == "") {
				    flag = false;
					$('input[name=from_where_financial_help]').addClass('is-invalid');
			    	$('#error-from-where-financial-help').html('This field is required.');
			    }else{
					$('input[name=from_where_financial_help]').removeClass('is-invalid').addClass('is-valid');
			    }
			}
		}else{
			flag = false;
			$('#error-financial-help').html('This field is required.');
			$('#error-financial-help').show();
		}
	/*Applicant Financial Help Validation:End*/


	/*Applicant Total Number of Family Members Validation:Start*/
		if (total_family_member == "") {
			flag = false;
			$('input[name=total_family_member]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-total-family-members').html('This field is required.');
			$('#error-total-family-members').show();
		}else{
			$('input[name=total_family_member]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-total-family-members').html('');
			$('#error-total-family-members').hide();
		}

		if (adult == "") {
			flag = false;
			$('input[name=adult]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-adult').html('This field is required.');
			$('#error-adult').show();
		}else{
			$('input[name=adult]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-adult').html('');
			$('#error-adult').hide();
		}

		if (children_under_age == "") {
			flag = false;
			$('input[name=children_under_age]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-children-under-age').html('This field is required.');
			$('#error-children-under-age').show();
		}else{
			$('input[name=children_under_age]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-children-under-age').html('');
			$('#error-children-under-age').hide();
		}
	/*Applicant Total Number of Family Members Validation:End*/

	/*Applicant Total Monthly Family Income Validation:Start*/
		if (total_family_monthly_income == "") {
			flag = false;
			$('input[name=total_family_monthly_income]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-total-family-monthly-income').html('This field is required.');
			$('#error-total-family-monthly-income').show();
		}else{
			$('input[name=total_family_monthly_income]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-total-family-monthly-income').html('');
			$('#error-total-family-monthly-income').hide();
		}

		if (how_many_earning_members == "") {
			flag = false;
			$('input[name=how_many_earning_members]').addClass('is-invalid').removeClass('bottom-margin');
			$('#error-how-many-earning-members').html('This field is required.');
			$('#error-how-many-earning-members').show();
		}else{
			$('input[name=how_many_earning_members]').removeClass('is-invalid').addClass('is-valid bottom-margin');
			$('#error-how-many-earning-members').html('');
			$('#error-how-many-earning-members').hide();
		}
	/*Applicant Total Monthly Family Income Validation:End*/

    if(!flag){
    	window.scrollTo(0, 0);
    	$('#error-appropriate').show();	
    }
	return flag;
    // alert(flag);
	// return true;
}
