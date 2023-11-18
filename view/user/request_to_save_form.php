<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../library/forms.php");

	$forms  = new Forms("request_to_save_form_process.php", "POST");

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
	    		<div class="alert alert-<?php echo $_REQUEST['class']??''; ?> alert-dismissible fade show" role="alert">
  					<?php echo $_REQUEST['msg']??"" ?>
  					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  				</div>
			</div>
	    </div>
		<?php } ?>
	    
	    <?php	
	    	
	    	$forms->request_to_save_form();
	     ?>
    </div>
    <!-- Main Container:End -->
   
<?php 
	
	General::site_footer();
	session_destroy();
?>
    <!-- Internal Script Code:Start -->
    <script type="text/javascript">
    	$(document).ready(function(){
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

    	});

		function checked_email(email=null,id=null){
			
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
                    data: {applicant_id:id,email:email,action:'checked_email' },
                    success: function(responseText, statusText, HTTPRequest) {
                        if(Number(responseText) != "1"){
                        	$('button[name=submit]').attr('disabled', true);
        					$('input[name=email]').addClass('is-invalid');
        					$('#error-email').html("This email does not exist.");
                        	
                        }
                    }
        		});
        	}
		}

		
	</script>
    <!-- Internal Script Code:End -->

  	