<?php
header('Content-Type:application/vnd-ms-excel');
header('Content-Disposition:attachment; filename=beneficiary_excel_data.xls');
header('Cache-Control:no-cache, no-store, must-revalidate');
header('Pragma:no-cache');
header('Expires:0');

require_once('../../controller/bll_support_poor_student.php');
$bll_support_poor_student = new BLL_Beneficiary();
$result = $bll_support_poor_student->get_all_beneficiary();

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
			border: 2px solid blue;
			margin-bottom: 5px;
		}
	</style>
</head>
<body>
	<div id="heading">
		HIDAYA SUPPORT POOR STUDENTS SHEET
	</div>
	<table class="table" id="beneficiary-table" style="border:1px solid black;">
				    <thead>
						<!-- <tr>
						    <th colspan="34" style="" id="heading">
						    	HIDAYA SUPPORT POOR STUDENTS SHEET
						    </th>
					    </tr> -->
				        <tr>
				          <!-- <th scope="col">Applicant picture</th> -->
				          <th scope="col">Applicant Id</th>
				          <th scope="col">Applicant FullName</th>
				          <th scope="col">Gender</th>
				          <th scope="col">Contact Number</th>
				          <th scope="col">Email</th>
				          <th scope="col">DOB</th>
				          <th scope="col">CNIC</th>
				          <th scope="col">Current Address</th>
				          <th scope="col">Permanent Address</th>
				          <th scope="col">Apply For Stipend</th>
				          <th scope="col">Eligible For Zakat</th>
				          <th scope="col">Why</th>
				          <th scope="col">Is Father Alive</th>
				          <!-- <th scope="col">Death Certificate</th> -->
				          <th scope="col">Father Full Name</th>
				          <th scope="col">Father CNIC</th>
				          <!-- <th scope="col">Father CNIC Image</th> -->
				          <th scope="col">Father Occuption</th>
				          <th scope="col">Is Current Enrolled At University</th>
				          <th scope="col">Admission Type</th>
				          <th scope="col">Univeristy</th>
				          <th scope="col">Degree</th>
				          <th scope="col">Currently Enrolled Year</th>
				          <th scope="col">Passing Year</th>
				          <th scope="col">Education Expenses</th>
				          <th scope="col">Is Currently Working</th>
				          <th scope="col">How Much Earn Per Month</th>
				          <th scope="col">Does Applicant Have Skill</th>
				          <th scope="col">What Skill</th>
				          <th scope="col">Does Applicant Recieved Financial Help</th>
				          <th scope="col">How Much</th>
				          <th scope="col">From Where</th>
				          <!-- <th scope="col">Recieved Financial Help Financial Image</th> -->
				          <th scope="col">Total No Of Family Members</th>
				          <th scope="col">Adults</th>
				          <th scope="col">Children Under 18</th>
				          <th scope="col">Total Family Monthly Income</th>
				          <th scope="col">How Many Earning Members In The Family</th>
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
											<?php echo $applicant_first_name." ".$applicant_middle_name." ".$applicant_last_name;  ?> 
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

					