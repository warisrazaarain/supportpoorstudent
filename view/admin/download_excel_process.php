<?php
header('Content-Type:application/vnd-ms-excel');
header('Content-Disposition:attachment; filename=beneficiary_excel_data.xls');
header('Cache-Control:no-cache, no-store, must-revalidate');
header('Pragma:no-cache');
header('Expires:0');

session_start();
require_once('../../controller/bll_support_poor_student.php');
$bll_support_poor_student = new BLL_Beneficiary();

$user_id = $_SESSION['user']['user_id'];
$is_super_admin = $_SESSION['user']['is_super_admin'];


if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date'])) {
		extract($_REQUEST);
		$result = $bll_support_poor_student->search_records_from_date_to_date($from_date,$to_date,$user_id,$is_super_admin);
		$total_applicant_count = mysqli_num_rows($result);
		$total_count = $bll_support_poor_student->search_total_count_is_form_submitted($from_date,$to_date,$user_id,$is_super_admin);
	    $total_submitted_count = mysqli_fetch_assoc($total_count);
}elseif (isset($_REQUEST['application_status'])) {

		$application_status = $_REQUEST['application_status'];
		$result = $bll_support_poor_student->search_Filter_records($application_status, $user_id, $is_super_admin);
		$total_applicant_count = mysqli_num_rows($result);
}
else{
	$result = $bll_support_poor_student->get_all_beneficiary($user_id,$is_super_admin);
	$total_applicant_count = mysqli_num_rows($result);
	$total_count = $bll_support_poor_student->total_count_is_form_submitted($user_id,$is_super_admin);
	$total_submitted_count = mysqli_fetch_assoc($total_count);
}



?>

			  	
<!DOCTYPE html>
<html>
<head>
	<title>Download Excel Sheet</title>
	<style type="text/css">
		#beneficiary-table th{
			background-color: /*#003d99*/ #0047b3; 
			color:white; height:40px;
			font-size:15px; 
			width:200px; 
			text-align: center; 
			border-width: 0px 1px; 
			border-style: solid; 
			border-color: black; 
			box-sizing: border-box;
		}
		#beneficiary-table tr td{
			border:1px solid black;
			background-color:#d3d3d3;
			box-sizing: border-box;
			text-align: center;
		}
		#heading{
			background-color:#ffff;
			text-align:left;
			color:blue;
			height:60px;
			font-size:30px; 
			font-family: arial; 
			font-weight: bold;
			/*border: 2px solid blue*/;
			margin-bottom: 5px;
		}
	</style>
</head>
<body>
	<div id="heading">
		<?php
			if (isset($from_date) && isset($to_date)) {
			?>
				<h1>HIDAYA SUPPORT POOR STUDENTS SHEET <span>(From Date : <?php echo date("d M Y", strtotime($from_date))?>) (To Date : <?php echo date("d M Y", strtotime($to_date));?>)</span></h1>
				<p style="font-size: 24px;">
					<?php echo "Total Applicant : ". $total_applicant_count."<br/>"." Total Submitted Request : ".$total_submitted_count['Total_Form_Submitted'];?>
				</p>
				<!-- <p style="font-size: 24px;">Search : <span>From Date: ( <?php echo date("d M Y", strtotime($from_date));?> )  
					To Date: ( <?php echo date("d M Y", strtotime($to_date));?> ) </span>
				</p> -->		
			<?php
			}elseif (isset($_REQUEST['application_status'])) {
			?>
				<h1>HIDAYA SUPPORT POOR STUDENTS SHEET</h1>
				<p style="font-size: 24px;">
					<?php echo "Total Applicant : ". $total_applicant_count."<br/>"." Total Submitted Request : 0";
					?>
				</p>
			<?php
				if (isset($_REQUEST['application_status']) && $_REQUEST['application_status'] =='0') {
						?><p style="font-size: 24px;">Filter :<span> Application Rejected</span></p><?php		
					}elseif (isset($_REQUEST['application_status']) && $_REQUEST['application_status'] =='1') {
						?><p style="font-size: 24px;">Filter :<span> Application Approved</span></p><?php
					}elseif (isset($_REQUEST['application_status']) && $_REQUEST['application_status'] =='2') {
						?><p style="font-size: 24px;">Filter :<span> Financial Support Started</span></p><?php
					}elseif (isset($_REQUEST['application_status']) && $_REQUEST['application_status'] =='3') {
						?><p style="font-size: 24px;">Filter :<span> Financial Support Stopped</span></p><?php
					}elseif (isset($_REQUEST['application_status']) && $_REQUEST['application_status'] =='') {
						?><p style="font-size: 24px;">Filter :<span> New Application</span></p><?php
					}
			}
			else{
				?>
				   <h1>HIDAYA SUPPORT POOR STUDENTS SHEET</h1>
				   <p style="font-size: 24px;">
				   	<?php echo "Total Applicant : ". $total_applicant_count."<br/>"." Total Submitted Request : ".$total_submitted_count['Total_Form_Submitted'];?>
				   </p>
				<?php
			}
		?>
	</div>
	
	<table class="table" id="beneficiary-table" style="border:1px solid black;">
				    <thead>
		    			<tr>
		    	          <!-- <th scope="col">Applicant picture</th> -->
		    	          <th scope="col">Applicant Id</th>
		    	          <th scope="col">Submission Date</th>
		    	          <th scope="col">Name of Applicant</th>
		    	          <th scope="col">Gender</th>
		    	          <th scope="col">Contact Number</th>
		    	          <th scope="col">Contact Email</th>
		    	          <th scope="col">Date of Birth</th>
		    	          <th scope="col">National ID Card No</th>
		    	          <th scope="col">Current Address</th>
		    	          <th scope="col">Permanent Address</th>
		    	          <th scope="col">Apply For Stipend</th>
		    	          <th scope="col">(Muslim Only) Is The Applicant Eligible To Receive Zakat</th>
		    	          <th scope="col">Why</th>
		    	          <th scope="col">Is Father Alive</th>
		    	          <!-- <th scope="col">Death Certificate</th> -->
		    	          <th scope="col">Father Name</th>
		    	          <th scope="col">Father National ID Card No</th>
		    	          <!-- <th scope="col">Father CNIC Image</th> -->
		    	          <th scope="col">Father Occuption</th>
		    	          <th scope="col">Currently Enrolled At University</th>
		    	          <th scope="col">University Admission</th>
		    	          <th scope="col">In Which University</th>
		    	          <th scope="col">Highest Academic Degree</th>
		    	          <th scope="col">In Which Year Currently Studying</th>
		    	          <th scope="col">In Which Month And Year The Current Degree Will Be Completed</th>
		    	          <th scope="col">Total yearly educational expenses</th>
		    	          <th scope="col">Currently Working</th>
		    	          <th scope="col">If Yes, How Much Money Earn Per Month</th>
		    	          <th scope="col">Have Any Skills Or Completed Any Skilful Training</th>
		    	          <th scope="col">If Yes, What</th>
		    	          <th scope="col">Received Any Financial Help From Other Sources Besides Parents Such As Government Or University, In Last 2 Years</th>
		    	          <th scope="col">If yes, how much</th>
		    	          <th scope="col">From Where</th>
		    	          <!-- <th scope="col">Recieved Financial Help Financial Image</th> -->
		    	          <th scope="col">Total Number of Family Members</th>
		    	          <th scope="col">Adults</th>
		    	          <th scope="col">Children Under 18</th>
		    	          <th scope="col">Total Monthly Family Income</th>
		    	          <th scope="col">How Many Earning Members In The Family</th>
		    	          <th scope="col">Bank Name</th>
		    	          <th scope="col">Bank Branch Name</th>
		    	          <th scope="col">Bank Account Title</th>
		    	          <th scope="col">Bank Account Number</th>
		    	        </tr>
		    	    </thead>
		    	    <tbody>
						<?php
							if($result->num_rows)
							{
								while($beneficiary_data = mysqli_fetch_assoc($result))
								{
									extract($beneficiary_data);
								?>
									<tr>
										<!-- <td>
											<img src="<?php //echo $applicant_picture;  ?>" alt="No Image" width="50px" height="50px" /> 
										</td> -->
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
												<!-- <p class="mt-1">
													<b><a target="_blank" href="view_beneficiary_status.php?beneficiary_id=<?php //echo $beneficiary_id; ?>" class=" text-decoration-none applicant-status">Manage Application</a></b>
												</p> -->
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
										<!-- <td>
											<img src="<?php //echo $father_death_certificate_image;  ?>" alt="No Image" width="50px" height="50px" /> 
										</td> -->
										<td>
											<?php echo $father_first_name." ".$father_middle_name." ".$father_last_name;  ?> 
										</td>
										<td>
											<?php echo $father_cnic;  ?> 
										</td>
										<!-- <td>
											<img src="<?php //echo $father_cnic_image;  ?>" alt="No Image" width="50px" height="50px" /> 
										</td> -->
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
											<?php echo $enrolled_year;  ?> 
										</td>
										<td>
											<?php echo (isset($passing_degree_year))?substr(date("d-M-Y", strtotime($passing_degree_year)), 3):"";  ?> 
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
										<!-- <td>
											<img src="<?php //echo $financial_help_image;  ?>" alt="No Image" width="50px" height="50px" /> 
										</td> -->
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

</body>
</html>				

					