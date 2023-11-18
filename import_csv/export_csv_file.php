<?php 
require_once("connection.php");

$file_resource=fopen("List of Students (SAU).csv", "r");

while ($data=fgetcsv($file_resource)) {


$applicant_full_name = explode(" ",$data[1]);
$applicant_count = count($applicant_full_name);

if ($applicant_count == 3) {
	$q1 = "applicant_first_name,applicant_middle_name,applicant_last_name";
	$x = "'".$applicant_full_name[0]."', '".$applicant_full_name[1]."', '".$applicant_full_name[2]."'";
}else{
	$q1 = "applicant_first_name,applicant_last_name";
	$x = "'".$applicant_full_name[0]."', '".$applicant_full_name[1]."'";
}

$father_full_name = explode(" ",$data[2]);
$father_count = count($father_full_name);

if ($father_count == 3) {
	$q2 = "father_first_name,father_middle_name,father_last_name";
	$y = "'".$father_full_name[0]."', '".$father_full_name[1]."', '".$father_full_name[2]."'";
}else{
	$q2 = "father_first_name,father_last_name";
	$y = "'".$father_full_name[0]."', '".$father_full_name[1]."'";
}

 $query ="INSERT INTO beneficiary ($q1,$q2,applicant_gender,applicant_contact_number,applicant_cnic, applicant_email,bank_account_title,bank_account_number,bank_branch_name,bank_name,created_at,is_form_submitted,is_father_alive,unversity_id) 
	VALUES($x,$y,'".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."',CURRENT_DATE,'1','No','6')";

$result=mysqli_query($connection,$query) or die(mysqli_error($connection));
	
}

if ($result) {
		
	echo "Records Inserted Successss";

}else{
	echo "Not Inserted ";
}


?>