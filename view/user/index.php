<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../library/forms.php");
	require_once("../../model/dal_academic_degree.php");
	require_once("../../model/dal_university.php");
	require_once("../../model/dal_enrolled_year.php");

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


	General::site_header();

?>

	<!-- Header Container:Start -->
    <div class="container-fluid border-dark border-bottom">
    	<div class="row">
    		<div class="col-sm-12 text-center">
    			<div id="et-secondary-menu" class="pt-2">
					<ul id="et-secondary-nav" class="menu" style="list-style:none;"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10196 chimmc-menu-item_10196 sec_menu_item"><a href="#"><img src="../assets/Hidaya-Bismillah-pnh.png" style="width:240px;height:30px;" class="alignnone"></a></li>
					</ul>	
				</div>		
    		</div>
    	</div>
    </div>
    <!-- Header Container:End -->

    <!-- Logo Container:Start -->
    <div class="container-fluid" style="background-color:#2c4e23;">
    	<div class="row">
    		<div class="col-sm-3">
    			<div id="et-secondary-menu" class="ms-5" style="margin-left: 3.5rem !important;">
					<ul id="et-secondary-nav" class="menu" style="list-style:none;"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10196 chimmc-menu-item_10196 sec_menu_item"><a href="#"><img src="../assets/logo.png" style="width:100%;" class="alignnone pt-2"></a></li>
					</ul>	
				</div>
    		</div>
    		<div class="col-sm-9">
    			<h1 class="entry-title main_title text-success">  Spread Education - Support Poor Students (Monthly) </h1>
    		</div>
    	</div>
    </div>
    
    <!-- Logo Container:End -->

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
	    

	    <?php $forms->beneficiary_form(); ?>
    </div>
    <!-- Main Container:End -->
   
<?php 
	
	General::site_footer();
	session_destroy();
?>
    <!-- Internal Script Code:Start -->
    <script type="text/javascript">
    	$(document).ready(function(){

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
	                
	                checked_email(email);
	                if(cnic != ""){
	                	checked_cnic(cnic);
	                }
	                
				});
    		/*Checked Email Already Exist In DB:End*/

    		/*Checked Applicant CNIC Already Exist In DB:Start*/
	    		$(document).on("blur","#cnic",function(){
	    			var email = $("#email").val();
	    			var cnic = $(this).val();
	                
	                checked_cnic(cnic);
	                if(email != ""){
	                	checked_email(email);
	                }

				});
    		/*Checked Applicant CNIC Already Exist In DB:End*/
    	});

		function checked_email(email=null){
			
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
		}

		function checked_cnic(cnic = null){
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
		}
	</script>
    <!-- Internal Script Code:End -->

  	