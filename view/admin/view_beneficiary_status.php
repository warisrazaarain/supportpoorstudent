<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../library/forms.php");
	require_once("../../controller/bll_support_poor_student.php");
	
	$forms  = new Forms("update_beneficiary_record.php", "POST");

	$session 		= new Session();
	$beneficiary 	= new BLL_Beneficiary();

	$session->admin_session();

	if (isset($_GET['beneficiary_id'])) {
		$beneficiary_id = $_GET['beneficiary_id'];
	}else{
		header('location:index.php');
	}

	$result  			= $beneficiary->get_single_beneficiary_doc_status($beneficiary_id);
	$marksheet_data  	= $beneficiary->get_all_beneficiary_degree_attachments($beneficiary_id);
	$applicant_last_support_record = $beneficiary->get_applicant_last_support_record($beneficiary_id);
	$applicant_support_record  	= $beneficiary->get_applicant_support_record($beneficiary_id);

	General::site_header();
	General::site_logo();

	General::admin_navbar();  

			    
	$record = mysqli_fetch_assoc($result);
	$record['marksheet'] = 0;
	$record['applicant_support_record'] = 0;
	$record['last_applicant_support_record'] = 0;
	$record['applicant_support_record'] = null;

	if($marksheet_data->num_rows > 0){
		$record['marksheet'] = true;
	}

	if($applicant_last_support_record->num_rows > 0){
		$record['last_applicant_support_record'] = mysqli_fetch_assoc($applicant_last_support_record);
	}
		$record['applicant_support_record'] = $applicant_support_record;

	?>

	<!-- Loading Modal:Start -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	    	<div class="modal-body p-5">
	        	<div class="d-flex justify-content-center">
	          		<div class="spinner-border text-primary" role="status">
	            		<span class="visually-hidden"></span>
	          		</div>
	        	</div>
	        	<h3 class="display-8 text-center text-danger">Processing...</h3>
	      	</div>
	    </div>
	  </div>
	</div>
	<!-- Loading Modal:End -->
	
	
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
					<div class="row">
						<div class="col-md-8">
							<h4 class="text-primary fw-bolder"><?php  echo $record['applicant_first_name']." ".$record['applicant_last_name']; ?></h4>
						</div>
						<div class="col-md-4"><a href="index.php" class="float-end btn btn btn-secondary">Back</a></div>
					</div>
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
					    <button class="nav-link <?php echo !isset($_REQUEST['tab_2'])?'active':''; ?>" id="essential-doc-tab" data-bs-toggle="tab" data-bs-target="#essential_doc" type="button" role="tab" aria-controls="nav-doc" aria-selected="true">Applicant Essential Documents</button>
					     <button class="nav-link <?php echo isset($_REQUEST['tab_2'])?'active':''; ?>" id="applicant-status-tab" data-bs-toggle="tab" data-bs-target="#applicant-status" type="button" role="tab" aria-controls="nav-status" aria-selected="true">Application Status</button>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<!-- First Tab :Start -->
						<div class="tab-pane fade <?php echo !isset($_REQUEST['tab_2'])?'show active':''; ?>" id="essential_doc" role="tabpanel" aria-labelledby="essential_doc-tab">
							<div id="first_tab">
							<?php $forms->beneficiary_essential_doc_form($record,$beneficiary_id); ?>
							</div>
						</div>
					<!-- First Tab :End -->

					<!-- Second Tab :Start -->
						<div class="tab-pane fade <?php echo isset($_REQUEST['tab_2'])?'show active':''; ?>" id="applicant-status" role="tabpanel" aria-labelledby="applicant-status-tab">
							<?php $forms->beneficiary_support_status_form($record,$beneficiary_id); ?>
						</div>
					<!-- Second Tab :End -->
				</div>
	</div>



<?php

	// $forms->beneficiary_essential_doc_form($record,$beneficiary_id);
 
	General::site_footer();
?>

<!-- Internal Script Code:Start -->
    <script type="text/javascript">

    	$(document).on('change','input[name=applicant_status]:checked',function(){

			if ($(this).val() == "1") {
				$('#applicant-support-box').show();
			}else{
				$('#applicant-support-box').hide();
			}
    	});

    	/*Next Button:Start*/
	    	$(document).on("click","#nextBtn",function(){
	    		    			
	    			$('#first_tab').hide();
	    			$('#essential_doc').removeClass('show').removeClass('active');
	    			$('#applicant-status').addClass('show').addClass('active');
	    			$('#applicant-status-tab').addClass('active');
	    			$('#essential-doc-tab').removeClass('active');
	    		    
	    	});
	    /*Next Button:End*/

    	$(document).on("click","#essential-doc-tab",function(){
    			$('#first_tab').show();
    			$('#applicant-status').removeClass('show').removeClass('active');
    			$('#essential_doc').addClass('show').addClass('active');

    			$('#applicant-status-tab').removeClass('active');
    			$('#essential-doc-tab').addClass('active');
    	});	
    </script>
<!-- Internal Script Code:End -->
