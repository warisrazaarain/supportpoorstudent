<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../controller/bll_support_poor_student.php");

	$session 		= new Session();
	$beneficiary 	= new BLL_Beneficiary();

	$session->admin_session();

	// echo "<pre>";
	// print_r($_SESSION);
	// echo "</pre>";
	// die();

    $user_id = $_SESSION['user']['user_id'];
    $is_super_admin = $_SESSION['user']['is_super_admin'];

	if (isset($_REQUEST['search'])) {

		extract($_REQUEST);
	
		$result = $beneficiary->search_records_from_date_to_date($from_date,$to_date, $user_id, $is_super_admin);
		$total_applicant_count = mysqli_num_rows($result);
		$total_count = $beneficiary->search_total_count_is_form_submitted($from_date,$to_date, $user_id, $is_super_admin);
		$total_submitted_count = mysqli_fetch_assoc($total_count);

	}elseif (isset($_REQUEST['filter'])) {
		
		extract($_REQUEST);
		$result = $beneficiary->search_Filter_records($application_status, $user_id, $is_super_admin);
		$total_applicant_count = mysqli_num_rows($result);
	}
	else{

		$result = $beneficiary->get_all_beneficiary( $user_id, $is_super_admin);
		$total_applicant_count = mysqli_num_rows($result);
		$total_count = $beneficiary->total_count_is_form_submitted($user_id, $is_super_admin);
		$total_submitted_count = mysqli_fetch_assoc($total_count);
	}


	General::site_header();
	General::site_logo();

?>
	<style type="text/css">
		/* The Modal (background) */
		.doc-modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /*Fallback color */
			background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
		}

		/* Modal Content/Box */
		.doc-modal-contentt {
			background-color: #fefefe;
			margin: 30px 25%; /* 20% from the top and centered */
			padding: 0px;
			width: 50%; /* Could be more or less, depending on screen size */
			border-radius: 0px;
		}
		.doc-model-header {
			padding: 25px;
			color: white;
			font-size: 20px;
			font-weight: bold;
			text-align: center;
		}

		.doc-model-footer {
			padding: 5px;
			font-size: 20px;
			font-weight: bold;
		}

		#iframe {
  			width: 100%;
			height: 600px;
			margin-left: -2px;
		}

		#cancel{
			float: right;
			color: white;
			margin-top: -35px;
			margin-right: -35px;
			background-color: gray;
			border-radius: 20px;
			padding: 2px;
			cursor: pointer;
			border: 1px solid black;
			font-weight: normal;

		}
	</style>
	
	<!-- PDF Modal: Start -->
	<div id="documentModal" class="doc-modal border">
		<!-- Modal content -->
		<!-- <div class=""> -->
			<div class="doc-modal-contentt">
				<div class="doc-model-header">
					<span id="filetype"></span>
					<span id="cancel">&nbsp;X&nbsp;</span>
				</div>
				<div class="doc-model-footer"> 
					<iframe src="" id="iframe"></iframe>
				</div>
			</div>
		<!-- </div>	 -->
	</div>
	<!-- PDF Modal: End -->

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

	<?php  General::admin_navbar();  ?>
	<div class="container-fluid">
	    <?php
	    if(isset($_REQUEST['message'])){
	    ?>
	    <div class="row mt-5">
	    	<div class="col-md-12">
	    		<div class="alert alert-<?php echo $_REQUEST['class']??''; ?> alert-dismissible fade show" role="alert">
  					<?php echo $_REQUEST['message']??"" ?>
  					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  				</div>
			</div>
	    </div> 
		<?php } ?>

		<!-- Total Applicant & Download Button :Start -->
				<div class="row mt-5">
				   	<div class="col-sm-6">
				   		<h5 class="text-danger">Total Applicants : <span class="text-dark"><b><?php echo  $total_applicant_count ?></b></span></h5>
				   		<h5 class="text-danger">Total Resubmit Request : <span class="text-dark"><b><?php echo  $total_submitted_count['Total_Form_Submitted']??"0";?></b></span></h5>
				   	</div>
				   	<div class="col-md-6">
				   		<?php
				   			if (isset($from_date) && isset($to_date)) {
				   			?>
				   				<a href="download_excel_process.php?from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>" class="btn btn-success float-end">Download Excel</a>
				   			<?php
				   			}elseif (isset($application_status)) {
				   				?>
			   						<a href="download_excel_process.php?application_status=<?php echo $application_status;?>" class="btn btn-success float-end">Download Excel</a>
				   				<?php
				   			}
				   			else{
				   			 ?>		
				   			  <a href="download_excel_process.php" class="btn btn-success float-end">Download Excel</a>
				   			 <?php						
				   			}
				   		?>
				   	</div>
				</div>
		<!-- Total Applicant & Download Button :End -->

<!-- search form :Start -->

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-2"></div>
			<div class="col-md-8 coustom-border" style="text-align:center;">
				<h3 class="text-success pb-3 mt-2"><b>Search</b></h3>
				<form class="row g-3" action="" method="POST"class="" action="">
					
					<div class="col-md-2  text-end gap">
						<label class="text-danger"><b>From Date :</b></label>
					</div>
					<div class="col-md-2">
						<input class="form-control" type="date" name="from_date" class="text-secondary" required="" value="<?php echo isset($from_date)? $from_date:"";?>">
					</div>
					<div class="col-lg-1 col-sm-2">
						<label class="text-danger"><b>To Date :</b></label>
					</div>
					<div class="col-md-2">
						<input class="form-control" type="date" name="to_date"class="text-secondary" required="" value="<?php echo isset($to_date) ?$to_date:"";?>">
					</div>
					<div class="col-md-4  text-start space">
					    <input type="submit" name="search" value="Search" class="btn btn-success">
					    &nbsp;
					    <a href="index.php" class="btn btn-secondary clear-search-btn">Clear Search</a> 
					</div>
					<div class="col-md-12 mt-5"></div>
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
<!-- search form :End -->



<!--Filter search form :Start -->
	<div class="row mt-3">
	   	<div class="col-md-2"></div>
	   	<div class=" col-md-8">
	   	<fieldset style="width:100%; text-align:center; border: 1px solid #c3b8b8;" class="form-group  p-3">
	   		<legend class="text-success"><b>Filter Search</b></legend>
	   		<form action="" method="POST">
	   			<table align="center" cellpadding="10">
	   				<tr>
	   					<th class="text-danger" width="50px">Filter :</th>
	   					<td colspan="3">
					  		<select class="form-select" name="application_status" id="select" required="">
					      	<option value="">--Please Select--</option>
					      		<option value="" <?php echo isset($_POST['application_status']) && $_POST['application_status']=='' ?"selected":"";?>>New Application</option>

					      		<option value="1"<?php echo isset($_POST['application_status']) && $_POST['application_status']=='1' ?"selected":"";?> >Application Approved</option>

					      		<option value="0"<?php echo isset($_POST['application_status']) && $_POST['application_status']=='0' ?"selected":"";?> >Application Rejected</option>

					      		<option value="2"<?php echo isset($_POST['application_status']) && $_POST['application_status']=='2' ?"selected":"";?>>Financial Support Started</option>

					      		<option value="3"<?php echo isset($_POST['application_status']) && $_POST['application_status']=='3' ?"selected":"";?>>Financial Support Stop</option>
					      	</select>
   					</td>
   					<td colspan="2" class="text-center">
   						<input type="submit" name="filter" value="Apply Filter" class="btn btn-success">
   						<!-- <button type="button" class="btn btn-success"id="filter">Search</button> -->
   						&nbsp;&nbsp;&nbsp;
   						<a href="index.php" class="text-light btn btn-secondary">Clear Filter</a>
   					</td>
	   				</tr>
	   			</table>
	   		</form>
	   	</fieldset>
	   	</div>
	   	<div class="col-md-2"></div>
	   	<div class="col-md-12">
	   		
	   	</div>
	</div>
<!-- Filter search form :End -->

		<div class="row mt-5">
			<!-- <div class="col-md-12"><a href="download_excel_process.php" class="btn btn-success float-end">Download Excel</a></div> -->
			<form action="bulk_process.php" method="POST" class="">
				<fieldset style="text-align: center; width:100%;"class="form-group  p-3">
   					 <legend class="text-success" style="display:<?php echo isset($_POST['application_status']) ?'block':'none';?>"><b>Select Bulk Action</b></legend>
					<div class="col-md-12 "style="display:<?php echo isset($_POST['application_status']) ?'block':'none';?>">
						<table align="center">
							<tr>
							<td style="width:90%;">
								<select class="form-select" name="application_status" id="select"
								 required ="">
						    	<option value="">--------Please Select Bulk Action----------</option>
						    		<option value="1">Application Approved</option>
						    		<option value="0">Application Rejected</option>
						    		<option value="2">Financial Support Started</option>
						    		<option value="3">Financial Support Stop</option>
						    	</select>
							</td>
							<td>
								&nbsp;
								<input type="submit" name="bulk_action" id="bulk-btn" value="Apply Bulk Action" class="btn btn-success">
							</td>
						</tr>
						</table>
					</div>
				</fieldset>
				<?php
					if (isset($_POST['application_status']) && $_POST['application_status'] =='0') {
						?><h5 class="text-danger">Filter :<span class="text-success fw-bolder"> Application Rejected</span></h5><?php		
					}elseif (isset($_POST['application_status']) && $_POST['application_status'] =='1'){
						?><h5 class="text-danger">Filter :<span class="text-success fw-bolder"> Application Approved</span></h5><?php
					}elseif (isset($_POST['application_status']) && $_POST['application_status'] =='2'){
						?><h5 class="text-danger">Filter :<span class="text-success fw-bolder"> Financial Support Started</span></h5><?php
					}elseif (isset($_POST['application_status']) && $_POST['application_status'] =='3'){
						?><h5 class="text-danger">Filter :<span class="text-success fw-bolder"> Financial Support Stopped</span></h5><?php
					}elseif (isset($_POST['application_status']) && $_POST['application_status'] ==''){
						?><h5 class="text-danger">Filter :<span class="text-success fw-bolder"> New Application</span></h5><?php
					}elseif(isset($from_date) && isset($to_date)){
						?><h5 class="text-danger">Search : <span class="text-success fw-bolder">From Date: ( <?php echo date("d M Y", strtotime($from_date));?> ) To Date: ( <?php echo date("d M Y", strtotime($to_date));?> ) </span></h5><?php
					}
				?>
			<div class="col-md-12 mt-3">
				<!-- <div class="table-responsive"> -->
			  	<table class="table table-striped mb-0 stripe row-border order-column text-center" id="beneficiary-table">
				    <thead>
				    	    <tr>
				    	      <th>#</th>
				    	      <th><input type="checkbox" name="select_all" value="checked"> Select</th>
				    	      <th>Picture</th>
				    	      <th>Applicant ID</th>
				    	      <th>Submission Date</th>
				    	      <th>Name of Applicant</th>
				    	      <th>Scanned Image of Student ID Card/Enrollment Card</th>
				    	      <th>Gender</th>
				    	      <th>Contact Number</th>
				    	      <th>Contact Email</th>
				    	      <th>Date of Birth</th>
				    	      <th>National ID Card No</th>
				    	      <th>Scanned Image of National ID Card No</th>
				    	      <th>Current Address</th>
				    	      <th>Permanent Address</th>
				    	      <th>Apply For Stipend</th>
				    	      <th>(Muslim Only) Is The Applicant Eligible To Receive Zakat</th>
				    	      <th>Why</th>
				    	      <th>Is Father Alive</th>
				    	      <th>Scanned Image of The Father's Death Certificate Issued By The Authorized Department</th>
				    	      <th>Father Name</th>
				    	      <th>Father National ID Card No</th>
				    	      <th>Father Occupation</th>
				    	      <th>Currently Enrolled At University</th>
				    	      <th>University Admission</th>
				    	      <th>In Which University</th>
				    	      <th>Highest Academic Degree</th>
				    	      <th>Scanned Image of The Last 2 Academic Records</th>
				    	      <th>In Which Year Currently Studying</th>
				    	      <th>In Which Month And Year The Current Degree Will Be Completed</th>
				    	      <th>Total Yearly Educational Expenses</th>
				    	      <th>Currently Working</th>
				    	      <th>If Yes, How Much Money Earn Per Month</th>
				    	      <th>Have Any Skills Or Completed Any Skilful Training</th>
				    	      <th>If Yes, What</th>
				    	      <th>Received Any Financial Help From Other Sources Besides Parents Such As Government Or University, In Last 2 Years</th>
				    	      <th>If Yes, How Much</th>
				    	      <th>From Where</th>
				    	      <th>Scanned Image of The Notification of Financial Help</th>
				    	      <th>Total Number of Family Members</th>
				    	      <th>Adults</th>
				    	      <th>Children Under 18</th>
				    	      <th>Total Monthly Family Income</th>
				    	      <th>How Many Earning Members In The Family</th>
				    	      <th>Scanned Image Of The Nadra Family Registration Certificate
				    	      </th>
				    	      <th>Scanned Image of The Income Document</th>
				    	      <th>Scanned Image of The Father National Id Card</th>
				    	      <th>Bank Name</th>
				    	      <th>Bank Branch Name</th>
				    	      <th>Bank Account Title</th>
				    	      <th>Bank Account Number</th>
				    	    </tr>
				    </thead>
				    <tbody>
						<?php
							if($result->num_rows)
							{
								$count = 0;
								while($beneficiary_data = mysqli_fetch_assoc($result))
								{
									extract($beneficiary_data);
								?>
									<tr class="<?php echo ($is_form_submitted == "2")?'table-primary':''  ?>">
										<td><?php echo ++$count; ?></td>
										<td> <input type="checkbox" name="checkbox[]" class="checked-box" value="<?php echo $beneficiary_id;?>">
										</td>
										<td>
											<?php if((pathinfo($applicant_picture,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="elem" 
                                                href="<?php echo $applicant_picture; ?>"
                                                title="Profile Picture" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $applicant_picture;  ?>" class="rounded-circle border border-light border-5 light-box" onerror="this.src='../assets/user_default.png'" alt="No Image" width="70px" height="70px" />
                                            </a>
											<?php else: ?>
                                            	<a title="Download" href="javascript:void(0)" filetype="<?php echo pathinfo($applicant_picture,PATHINFO_EXTENSION); ?>"   path="<?php echo $applicant_picture ?>" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?>

											 <p><a class="text-decoration-none" href="view_beneficiary_detail.php?beneficiary_id=<?php echo $beneficiary_id;?>" title='view detail' target="_blank">View Detail</a></p> 
											<?php 
												if($is_form_submitted == '2'): 
													$email = base64_encode($applicant_email);
													$cnic  = base64_encode($applicant_cnic);
													$link  = "../user/request_to_resubmit_form_process.php?";
													$link .= "email=$email&cnic=$cnic";
											?>
												<p class="mt-1">
													<b><a href="<?php echo $link??'#'; ?>" class="text-success text-decoration-none approve-request">Approve Resubmit Request</a></b>
												</p>
											<?php elseif($is_form_submitted == '0'): ?>
											<!-- <p class="mt-1">
												<b class="text-light badge bg-primary text-decoration-none">Form Request Approved</b>
											</p> -->	
										<?php endif;?>
										</td>
										<td>
											<?php echo $beneficiary_id;  ?> 
										</td>
										<td>
											<?php echo date("d M Y", strtotime($created_at));  ?> 
										</td>
										<td>
											<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>
											<?php 
												if($is_form_submitted == '1'): 
											?>
												<p class="mt-1">
													<b><a target="_blank" href="view_beneficiary_status.php?beneficiary_id=<?php echo $beneficiary_id; ?>" class=" text-decoration-none applicant-status">Manage Application</a></b>
												</p>
												<!--  Support Status -->
												<p class="mt-1">
												<?php if($application_status == '0'){  ?>
													 <b class="text-light badge bg-danger text-decoration-none">Application Rejected</b>
												<?php }elseif($application_status == '1'){?>
													 <b class="text-light badge bg-success text-decoration-none">Application Approved</b>
													<?php }elseif($application_status == '2'){?>
														<b class="text-light badge bg-success text-decoration-none  p-2">Financial Support Started</b>
													<?php }elseif($application_status == '3'){?>
														<b class="text-light badge bg-danger text-decoration-none p-2">Financial Support Stopped</b>
												<?php }else{  ?>
													 <b class="text-light badge bg-secondary text-decoration-none">New Application</b>
												<?php }  ?>
												</p>
												<!--  Support Status -->
											<?php 	
												elseif($is_form_submitted == '0'): ?>	
													<p class="mt-1">
														<b class="text-light badge bg-primary text-decoration-none">Form Request Approved</b>
													</p>
											<?php endif; ?>
											
										</td>
										<td>
											<?php if((pathinfo($applicant_student_id_card_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="<?php echo (isset($applicant_student_id_card_image) && $applicant_student_id_card_image != '' )?'elem':''; ?>" 
                                                <?php echo (isset($applicant_student_id_card_image) && $applicant_student_id_card_image != '' )?"href=$applicant_student_id_card_image":''; ?>
                                                title="Student ID Card" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $applicant_student_id_card_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded" width="50px" height="50px" /> 
                                            </a>
                                            <?php else: ?>
                                            	<a title="Download" filetype="<?php echo pathinfo($applicant_student_id_card_image,PATHINFO_EXTENSION); ?>"   path="<?php echo $applicant_student_id_card_image ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?>
										</td>
										<td>
											<?php echo $applicant_gender;  ?> 
										</td>
										<td>
											<?php echo $applicant_contact_number;  ?> 
										</td>
										<td>
											<?php echo $applicant_email;  ?> 
										</td>
										<td>
											<?php echo date("d M Y", strtotime($applicant_date_of_birth));  ?> 
										</td>
										<td>
											<?php echo $applicant_cnic;  ?> 
										</td>
										<td>
											<?php if((pathinfo($applicant_cnic_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="<?php echo (isset($applicant_cnic_image) && $applicant_cnic_image != '' )?'elem':'' ?>" 
                                                <?php echo (isset($applicant_cnic_image) && $applicant_cnic_image != '' )?"href=$applicant_cnic_image":''; ?>
                                                title="National ID Card" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                              <img src="<?php echo $applicant_cnic_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded" width="50px" height="50px" />
                                            </a>
                                            <?php else: ?>
                                            	<a title="Download" filetype="<?php echo pathinfo($applicant_cnic_image,PATHINFO_EXTENSION); ?>"   path="<?php echo $applicant_cnic_image ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?> 
                                        </td>
										<td>
											<?php echo $applicant_current_address;  ?> 
										</td>
										<td>
											<?php echo $applicant_permanent_address;  ?> 
										</td>
										<td>
											<?php echo $applicant_apply_for_stipend;  ?> 
										</td>
										<td>
											<?php echo $applicant_eligible_receive_zakat;  ?> 
										</td>
										<td>
											<?php echo $applicant_reason_receive_zakat;  ?> 
										</td>
										<td>
											<?php echo $is_father_alive;  ?> 
										</td>
										<td>
											<?php if((pathinfo($father_death_certificate_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="<?php echo (isset($father_death_certificate_image) && $father_death_certificate_image != '' )?'elem':'' ?>" 
                                                <?php echo (isset($father_death_certificate_image) && $father_death_certificate_image != '' )?"href=$father_death_certificate_image":''; ?>
                                                title="Father`s Death Certificate" 
                                                data-lcl-txt="<?php echo $father_first_name." ".$father_middle_name." ".$father_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $father_death_certificate_image;  ?>" onerror="this.src='../assets/default.jpg'" class="rounded" alt="No Image" width="50px" height="50px" /> 
                                            </a>
                                            <?php else: ?>
                                            	<a title="Download" filetype="<?php echo pathinfo($father_death_certificate_image,PATHINFO_EXTENSION); ?>"  path="<?php echo $father_death_certificate_image ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?>
										</td>
										<td>
											<?php echo $father_first_name." ".$father_middle_name." ".$father_last_name;  ?> 
										</td>
										<td>
											<?php echo $father_cnic;  ?> 
										</td>
										<td>
											<?php echo $father_occupation;  ?> 
										</td>
										<td>
											<?php echo $applicant_currently_enrolled;  ?> 
										</td>
										<td>
											<?php echo $applicant_university_admission_type;  ?> 
										</td>
										<td>
											<?php echo $university_name;  ?> 
										</td>
										<td>
											<?php echo $degree_title;  ?> 
										</td>
										<td>
											<ul style="list-style:none">
											<?php $result2 = $beneficiary->get_all_beneficiary_degree_attachments($beneficiary_id);

												   if ($result2->num_rows>0) {
												   		while ($attachment = mysqli_fetch_assoc($result2)) {
												   	     		extract($attachment);
											?>
															<li class="pb-2">
															 	<?php if((pathinfo($academic_degree_attachment,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
															 	<a class="<?php echo  isset($academic_degree_attachment)?'elem':''?>" 
					                                                href="<?php echo $academic_degree_attachment??"#"; ?>"
					                                                title="Degree Attachment" 
					                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
					                                                style="text-decoration: none;">

					                                               <img src="<?php echo $academic_degree_attachment;  ?>" class="rounded" alt="No Image" width="50px" height="50px" onerror="this.src='../assets/default.jpg'" /> 
					                                            </a>
					                                            <?php else: ?>
					                                            	<a title="Download" filetype="<?php echo pathinfo($academic_degree_attachment,PATHINFO_EXTENSION); ?>"  path="<?php echo $academic_degree_attachment ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1 "></i></a>
					                                            <?php endif; ?>
															 </li>  
											<?php		
												   	    }
												   }else{
												   	        echo "No Attachment";
												   }
											?>
											</ul> 
										</td>
										<td>
											<?php echo $enrolled_year;  ?> 
										</td>
										<td>
											<?php 
												echo (isset($passing_degree_year))?substr(date("d M Y", strtotime($passing_degree_year)), 3):"";  
											?> 
										</td>
										<td>
											<?php echo $expense_Of_education;  ?> 
										</td>
										<td>
											<?php echo $applicant_currently_working;  ?> 
										</td>
										<td>
											<?php echo $applicant_how_much_earn_per_month;  ?> 
										</td>
										<td>
											<?php echo $does_applicant_have_skills;  ?> 
										</td>
										<td>
											<?php echo $what_applicant_skills;  ?> 
										</td>
										<td>
											<?php echo $applicant_receive_financial_help;  ?> 
										</td>
										<td>
											<?php echo $how_much_applicant_received_financial_help;  ?> 
										</td>
										<td>
											<?php echo $from_where;  ?> 
										</td>
										<td>
											<?php if((pathinfo($financial_help_image,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="<?php echo  (isset($financial_help_image) && $financial_help_image != '' )?'elem':''?>" 
                                               <?php echo (isset($financial_help_image) && $financial_help_image != '' )?"href=$financial_help_image":''; ?>
                                                title="Financial Help Notification" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
                                                style="text-decoration: none;">

                                              <img src="<?php echo $financial_help_image;  ?>" class="rounded" onerror="this.src='../assets/default.jpg'" alt="No Image" width="50px" height="50px" />
                                            </a>
                                            <?php else: ?>
                                            	<a title="Download" filetype="<?php echo pathinfo($financial_help_image,PATHINFO_EXTENSION); ?>"  path="<?php echo $financial_help_image ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?> 
										</td>
										<td>
											<?php echo $total_number_of_family_member;  ?> 
										</td>
										<td>
											<?php echo $total_adults;  ?> 
										</td>
										<td>
											<?php echo $total_childrens;  ?> 
										</td>
										<td>
											<?php echo $total_monthly_family_income;  ?> 
										</td>
										<td>
											<?php echo $how_many_earning_family_members;  ?> 
										</td>
										<td>
											<?php 
											if((pathinfo($nadra_family_registration_certificate,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="<?php echo  (isset($nadra_family_registration_certificate) && $nadra_family_registration_certificate != '' )?'elem':''?>" 
                                               <?php echo (isset($financial_help_image) && $nadra_family_registration_certificate != '' )?"href=$nadra_family_registration_certificate":''; ?>
                                                title="Nadra Family Registration Certificate" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
                                                style="text-decoration: none;">

                                              <img src="<?php echo $nadra_family_registration_certificate;  ?>" class="rounded" onerror="this.src='../assets/default.jpg'" alt="No Image" width="50px" height="50px" />
                                            </a>
                                            <?php else: ?>
                                            	<a title="Download" filetype="<?php echo pathinfo($nadra_family_registration_certificate,PATHINFO_EXTENSION); ?>"  path="<?php echo $nadra_family_registration_certificate ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?> 
										</td>
										<td>
											<?php 
											if((pathinfo($income_document,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="<?php echo  (isset($income_document) && $income_document != '' )?'elem':''?>" 
                                               <?php echo (isset($income_document) && $income_document != '' )?"href=$income_document":''; ?>
                                                title="Income Document" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
                                                style="text-decoration: none;">

                                              <img src="<?php echo $income_document;  ?>" class="rounded" onerror="this.src='../assets/default.jpg'" alt="No Image" width="50px" height="50px" />
                                            </a>
                                            <?php else: ?>
                                            	<a title="Download" filetype="<?php echo pathinfo($income_document,PATHINFO_EXTENSION); ?>"  path="<?php echo $income_document ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?> 
										</td>
										<td>
											<?php 
											if((pathinfo($father_national_id_card,PATHINFO_EXTENSION)) != 'pdf'  ): ?>
											<a class="<?php echo  (isset($father_national_id_card) && $father_national_id_card != '' )?'elem':''?>" 
                                               <?php echo (isset($father_national_id_card) && $father_national_id_card != '' )?"href=$father_national_id_card":''; ?>
                                                title="Father National ID Card" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
                                                style="text-decoration: none;">

                                              <img src="<?php echo $father_national_id_card;  ?>" class="rounded" onerror="this.src='../assets/default.jpg'" alt="No Image" width="50px" height="50px" />
                                            </a>
                                            <?php else: ?>
                                            	<a title="Download" filetype="<?php echo pathinfo($father_national_id_card,PATHINFO_EXTENSION); ?>"  path="<?php echo $father_national_id_card ?>" href="javascript:void(0)" class="text-decoration-none fw-normal file"><i class="bi bi-filetype-pdf text-danger fs-1"></i></a>
                                            <?php endif; ?> 
										</td>
										<td>
											<?php echo $bank_name;  ?> 
										</td>
										<td>
											<?php echo $bank_branch_name;  ?> 
										</td>
										<td>
											<?php echo $bank_account_title;  ?> 
										</td>
										<td>
											<?php echo $bank_account_number;  ?> 
										</td>
									</tr>		
								<?php
								}
							}
							else
							{
								?>
									<h4 style="color: red">No Data Available!...</h4>
								<?php
							}
						?>
					</tbody>
				</table>
				<!-- </div> -->
				
			</div>
			</form>
		</div>
	</div>
<?php 
	General::site_footer();
?>
<script type="text/javascript">
	
	$(function() {
		$('#beneficiary-table').DataTable({
    		order: [], 
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            fixedColumns:   {
                left: 6
            },
            columnDefs: [
            	{ targets: 0, className: '' },
            	{ targets: 1, className: '' },
            	{ targets: 2, className: '' }
            ],
            "pageLength": 10
            
    	});

		$(document).on('click', '.approve-request',function(){
			$('#staticBackdrop').modal('show');
		});


		$(document).on('click', '#bulk-btn',function(){
			$('#staticBackdrop').modal('show');
		});

		/*$('.dtfc-fixed-left').css('border-right','1px solid #ddd');
        $('.dtfc-fixed-left').css('border-bottom','1px solid #ddd');
        $('.dtfc-fixed-left').css('border-top','1px solid #ddd');*/

        // $("#beneficiary-table_wrapper .row").addClass('mb-1');
        // $("#beneficiary-table_length select").removeClass('form-select form-select-sm');


	/*-----<< Applicant: Image Viewer Plugin For Admin Index page >>-----*/
            lc_lightbox('.elem', {
                wrap_class: 'lcl_fade_oc',
                gallery : false,
                thumb_attr: 'data-lcl-thumb',
                skin: 'dark',
            });      
	/*-----<<Applicant: Image Viewer Plugin #End >>-----*/   


/* Applicant Update Form Tabs Code - End*/


/*Check All Check Boxes:Start*/

   $(document).on("change","input[name='select_all']",function(){
   	console.log($(this));
   		$(".checked-box").prop( "checked", $(this).prop('checked') );
   });

/*Check All Check Boxes:End*/




/*PDF View Code :Start*/
	$(document).on('click','.file', function(){

				var path = $(this).attr('path');
				var filetype = $(this).attr('filetype');
				var heading = 'Document Viewer';
				var background_color = 'gray'

				if (filetype == 'doc' || filetype == 'docx') 
				{
					heading = 'Word Document';
					background_color = '#185abd';
				}
				else if (filetype == 'xls' || filetype == 'xlsx')
				{
					heading = 'Excel Document';
					background_color = '#107a40';
				}
				else if (filetype == 'ppt' || filetype == 'pptx')
				{
					heading = 'Power Point Document';
					background_color = '#c43f1d';
				}
				else if (filetype == 'pdf')
				{
					heading = 'PDF Document';
					background_color ='#b32436';
				}
				else
				{
					heading = filetype + ' Document';
				}

				$('#filetype').text(heading);
				$('.doc-model-header').css('background-color',background_color);
				$('#iframe').attr('src',path);
				openModel();
			})

			$(document).on('click','#cancel', function(){
				$('#filetype').text('');
				$('.doc-model-header').css('background-color','gray');
				$('#iframe').attr('src','');
				closeModel();
			
			})


			function openModel()
			{
				$('#documentModal').show();
			}

			function closeModel()
			{
				$('#documentModal').hide();
			}  
/*PDF View Code :End*/  


	});
</script>