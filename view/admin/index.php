<?php
	require_once("../../library/session.php");
	require_once("../../library/general.php");
	require_once("../../controller/bll_support_poor_student.php");

	$session 		= new Session();
	$beneficiary 	= new BLL_Beneficiary();

	$session->admin_session();

	$result = $beneficiary->get_all_beneficiary();

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
			<div class="col-md-12"><a href="download_excel_process.php" class="btn btn-success float-end">Download Excel</a></div>
			<div class="col-md-12 mt-5">
				<!-- <div class="table-responsive"> -->
			  	<table class="table table-striped mb-0 stripe row-border order-column text-center" id="beneficiary-table">
				    <thead>
				        <tr>
				          <th>#</th>
				          <th>Applicant picture</th>
				          <th>Applicant Id</th>
				          <th>Submission Date</th>
				          <th>Applicant FullName</th>
				          <th>Applicant Student ID/Enrollment Card</th>
				          <th>Gender</th>
				          <th>Contact Number</th>
				          <th>Email</th>
				          <th>DOB</th>
				          <th>CNIC</th>
				          <th>Applicant CNIC Image</th>
				          <th>Current Address</th>
				          <th>Permanent Address</th>
				          <th>Apply For Stipend</th>
				          <th>Eligible For Zakat</th>
				          <th>Why</th>
				          <th style="width: auto;">Is Father Alive</th>
				          <th>Death Certificate</th>
				          <th>Father Full Name</th>
				          <th>Father CNIC</th>
				          <th>Father Occuption</th>
				          <th>Is Current Enrolled At University</th>
				          <th>Admission Type</th>
				          <th>Univeristy</th>
				          <th>Degree</th>
				          <th>Degree Attachment</th>
				          <th>Currently Enrolled Year</th>
				          <th>Passing Year</th>
				          <th>Education Expenses</th>
				          
				          <th>Is Currently Working</th>
				          <th>How Much Earn Per Month</th>
				          <th>Does Applicant Have Skill</th>
				          <th>What Skill</th>
				          <th>Does Applicant Recieved Financial Help</th>
				          <th>How Much</th>
				          <th>From Where</th>
				          <th>Recieved Financial Help Financial Image</th>
				          <th>Total No Of Family Members</th>
				          <th>Adults</th>
				          <th>Children Under 18</th>
				          <th>Total Family Monthly Income</th>
				          <th>How Many Earning Members In The Family</th>
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
									<tr>
										<td><?php echo ++$count; ?></td>
										 <td>
											<a class="elem" 
                                                href="<?php echo $applicant_picture; ?>"
                                                title="Image : Applicant Profile Picture" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $applicant_picture;  ?>" class="rounded-circle border border-light border-5 light-box" onerror="this.src='../assets/user_default.png'" alt="No Image" width="50px" height="50px" />
                                            </a>
											 <p><a class="text-decoration-none" href="view_beneficiary_detail.php?beneficiary_id=<?php echo $beneficiary_id;?>" title='view detail'>View Detail</a></p> 
										</td>	
										<td>
											<?php echo $beneficiary_id;  ?> 
										</td>
										<td>
											<?php echo date("d-M-Y", strtotime($created_at));  ?> 
										</td>
										<td>
											<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> 
										</td>
										<td>
											<a class="<?php echo isset($applicant_student_id_card_image)?'elem2':''; ?>" 
                                                <?php echo isset($applicant_student_id_card_image)?"href=$applicant_student_id_card_image":''; ?>
                                                title="Document : Applicant Student ID Card Scanned Image" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $applicant_student_id_card_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded" width="50px" height="50px" /> 
                                            </a>
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
											<?php echo date("d-M-Y", strtotime($applicant_date_of_birth));  ?> 
										</td>
										<td>
											<?php echo $applicant_cnic;  ?> 
										</td>
										<td>
											<a class="<?php echo isset($applicant_cnic_image)?'elem':'' ?>" 
                                                <?php echo isset($applicant_cnic_image)?"href=$applicant_cnic_image":''; ?>
                                                title="Document : Applicant National ID Card Scanned Image" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> " 
                                                style="text-decoration: none;">
                                              <img src="<?php echo $applicant_cnic_image;  ?>" alt="No Image" onerror="this.src='../assets/default.jpg'" class="rounded" width="50px" height="50px" />
                                            </a> 
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
										
											<a class="<?php echo isset($father_death_certificate_image)?'elem':'' ?>" 
                                                <?php echo isset($father_death_certificate_image)?"href=$father_death_certificate_image":''; ?>
                                                title="Document : Applicant Father`s Death Certificate Scanned Image" 
                                                data-lcl-txt="<?php echo $father_first_name." ".$father_middle_name." ".$father_last_name;  ?> " 
                                                style="text-decoration: none;">
                                                <img src="<?php echo $father_death_certificate_image;  ?>" onerror="this.src='../assets/default.jpg'" class="rounded" alt="No Image" width="50px" height="50px" /> 
                                            </a> 
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
															 	<a class="<?php echo  isset($academic_degree_attachment)?'elem':''?>" 
					                                                href="<?php echo $academic_degree_attachment??"#"; ?>"
					                                                title="Document : Applicant Degree Attachment Scanned Image" 
					                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
					                                                style="text-decoration: none;">

					                                               <img src="<?php echo $academic_degree_attachment;  ?>" class="rounded" alt="No Image" width="50px" height="50px" onerror="this.src='../assets/default.jpg'" /> 
					                                            </a>
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
												echo (isset($passing_degree_year))?substr(date("d-M-Y", strtotime($passing_degree_year)), 3):"";  
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
											<a class="<?php echo  isset($financial_help_image)?'elem':''?>" 
                                               <?php echo isset($financial_help_image)?"href=$financial_help_image":''; ?>
                                                title="Document : Applicant Financial Help Notification Scanned Image" 
                                                data-lcl-txt="<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?>  " 
                                                style="text-decoration: none;">

                                              <img src="<?php echo $financial_help_image;  ?>" class="rounded" onerror="this.src='../assets/default.jpg'" alt="No Image" width="50px" height="50px" />
                                            </a>
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
                left: 5
            },
            columnDefs: [
            	{ targets: 0, className: '' },
            	{ targets: 1, className: '' },
            	{ targets: 2, className: '' }
            ],
            "pageLength": 10
            
    	});

		/*$('.dtfc-fixed-left').css('border-right','1px solid #ddd');
        $('.dtfc-fixed-left').css('border-bottom','1px solid #ddd');
        $('.dtfc-fixed-left').css('border-top','1px solid #ddd');*/

        // $("#beneficiary-table_wrapper .row").addClass('mb-1');
        // $("#beneficiary-table_length select").removeClass('form-select form-select-sm');

        

	});
</script>