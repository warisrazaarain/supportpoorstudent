<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../library/forms.php");
	require_once("../../model/dal_academic_degree.php");
	require_once("../../model/dal_university.php");
	require_once("../../model/dal_enrolled_year.php");
	require_once("../../controller/bll_support_poor_student.php");
	
	$forms  = new Forms("update_beneficiary_record.php", "POST");

	$academic_degree  = new Academic_Degree();
	$all_degrees = $academic_degree->get_all_degree();
	
	$univerity  = new University();
	$all_university = $univerity->get_all_university();

	$enorlled_year  = new Enrolled_Year();
	$all_enorlled_year = $enorlled_year->get_all_enrolled_year();

	$forms->set_academic_degree($all_degrees);
	$forms->set_university($all_university);
	$forms->set_enrolled_year($all_enorlled_year);


	$session 		= new Session();
	$beneficiary 	= new BLL_Beneficiary();

	$session->admin_session();

	if (isset($_GET['beneficiary_id'])) {
		$beneficiary_id = $_GET['beneficiary_id'];
	}else{
		header('location:index.php');
	}

	$result  = $beneficiary->get_single_beneficiary($beneficiary_id);
	$result2 = $beneficiary->get_all_beneficiary_degree_attachments($beneficiary_id);

	General::site_header();


?>
	
	<nav class="navbar navbar-expand-lg bg-primary border border-dark">
	  <div class="container-fluid text-light">
	    <a class="navbar-brand text-light" href="index.php"><?php  echo General::site_title(); ?></a>
	    <ul class="nav navbar-nav navbar-right">
	    	<li class="align-content:center">
	        <a class="btn btn-danger text-light" href="logout.php" >Logout</a>
	    		
	    	</li>
	    </ul>
	  </div>
	</nav>

	<div class="container-fluid">
		
		<div class="row mt-5">
			<div class="col-md-12"><h3 class="text-danger">Welcome: <b class="text-primary"><?php echo ucwords($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']); ?></b> </h3></div>
		</div>

		<div class="row mt-5">
		</div>
	</div>
		<?php
			    
			$record = mysqli_fetch_assoc($result);
			$forms->update_beneficiary_form($record,$result2,$beneficiary_id); ?>
<?php 
	General::site_footer();
?>

<!-- Internal Script Code:Start -->
    <script type="text/javascript">
    	$(document).ready(function(){

    		/*Show Hide Why Field: If Eligible For Zakat Yes:Start*/
	    		$(document).on("click","input[name=eligible_for_zakat]:checked",function(){

	        		if(($(this).val()) == "Yes"){
	        				$("#zakat-reason-box").show();
	        		}else{
	        				// $("input[name=reason_for_zakat]").val("");
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
	        				// $("input[name=applicant_father_death_certificate]").val("");
	        				// $("input[name=applicant_father_death_certificate]").removeClass("is-valid is-invalid");
	        				$("#death-certificate-box").hide();
	        		}
	        });
    		/*Show Hide Father Death Certificate: If Father Alive No:End*/

    		/*Show Hide University Box: If Is Currently Enrolled Uni Yes:Start*/
	    		$(document).on("click","input[name=is_currently_enrolled_in_uni]:checked",function(){

	        		if(($(this).val()) == "Yes"){
	        				$(".university-box").show();
	        		}else{
	        				// $("select[name=univerity]").val("");
	        				// $("select[name=univerity_year]").val("");
	        				// $("input[name=degree_completed_year]").val("");
	        				// $("input[name=degree_yearly_expenses]").val("");
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
	        				// $("input[name=how_much_earning]").val("");
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
	        				// $("input[name=what_skill]").val("");
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
	        				// $("input[name=how_much_financial_help]").val("");
	        				// $("input[name=from_where_financial_help]").val("");
	        				// $("input[name=financial_help_image]").val("");
	        				$(".financial-box").hide();
	        				$("input[name=how_much_financial_help]").removeClass("is-valid is-invalid");
	        				$("input[name=from_where_financial_help]").removeClass("is-valid is-invalid");
	        				// $("input[name=financial_help_image]").removeClass("is-valid is-invalid");
	        		}
	        });
    		/*Show Hide Financial Box: If Applicant Recieved Financial Help Yes:End*/

    		/*Checked Email Already Exist In DB:Start*/
	    	/*	$(document).on("blur","#email",function(){
	    			alert("ok");
	    			var cnic = $("#cnic").val()
	                var email = $(this).val();
	                
	                checked_email(email);
	                if(cnic != ""){
	                	checked_cnic(cnic);
	                }
	                
				});*/
    		/*Checked Email Already Exist In DB:End*/

    		/*Checked Applicant CNIC Already Exist In DB:Start*/
	    /*		$(document).on("blur","#cnic",function(){
	    			var email = $("#email").val();
	    			var cnic = $(this).val();
	                
	                checked_cnic(cnic);
	                if(email != ""){
	                	checked_email(email);
	                }

				});*/
    		/*Checked Applicant CNIC Already Exist In DB:End*/
    	});

/*		function checked_email(email=null){
			
            var email_pattern = /^[a-z]{2,}\w*[@]{1}[a-z]{2,}[.]{1}[a-z]{2,6}$/;//ali9@yahoo.pk
                	
        	$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
	    	if (email_pattern.test(email) == false) {
	    		flag = false;
				$('input[name=email]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-email').html('Email must be like eg: ali9@yahoo.pk');
	    	}else{
	    		$('button[name=submit]').attr('disabled', false);
        		$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
        		$('#error-email').html("");
	    		
        		$.ajax({
                    type: 'POST',
                    url: 'beneficiary_form_process.php',
                    data: {email:email,action:'checked_email' },
                    success: function(responseText, statusText, HTTPRequest) {
                        if(Number(responseText) == "1"){
                        	$('button[name=submit]').attr('disabled', true);
        					$('input[name=email]').addClass('is-invalid');
        					$('#error-email').html("This email is already exist.");
                        }
                    }
        		});
        	}
		}*/

/*		function checked_cnic(cnic = null){
			var cnic_pattern  = /^\d{5}[0-9]{7}\d{1}$/;//4130312345671
	                    	
        	$('input[name=applicant_cnic]').removeClass('is-invalid').addClass('is-valid');
	    	if (cnic_pattern.test(cnic) == false) {
	    		flag = false;
				$('input[name=applicant_cnic]').removeClass('is-valid').addClass('is-invalid');
	    		$('#error-cnic').html('CNIC Numbers must be like eg: 4130312345671');
	    	}else{
	    		$('button[name=submit]').attr('disabled', false);
        		$('input[name=email]').removeClass('is-invalid').addClass('is-valid');
        		$('#error-cnic').html("");
	    		
        		$.ajax({
                    type: 'POST',
                    url: 'beneficiary_form_process.php',
                    data: {applicant_cnic:cnic,action:'checked_cnic' },
                    success: function(responseText, statusText, HTTPRequest) {
                        
                    	if(Number(responseText) == 1){
                        	$('button[name=submit]').attr('disabled', true);
        					$('input[name=applicant_cnic]').addClass('is-invalid');
        					$('#error-cnic').html("This cnic is already exist.");
                        }
                    }
        		});
        	}
		}*/
	</script>
    <!-- Internal Script Code:End -->
