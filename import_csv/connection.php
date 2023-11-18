<?php 
mysqli_report(false);
$connection= mysqli_connect("localhost","root","","support_poor_students");
	if (mysqli_connect_errno()) {
		echo "<p style='color:red;'>Database Connection Problem".mysqli_connect_error()."</p>";
	}
?>