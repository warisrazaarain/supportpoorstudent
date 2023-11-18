<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';
require '../assets/PHPMailer/src/Exception.php';

	class BLL_Mail_Send extends PHPMailer
	{ 
		public function __construct(){
			//Tell PHPMailer to use SMTP
			$this->isSMTP();

			// $this->SMTPDebug = SMTP::DEBUG_SERVER;
			$this->Host = 'smtp.gmail.com';
			
			$this->Port = 587;
			//Set the encryption mechanism to use - STARTTLS or SMTPS
			$this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			//Whether to use SMTP authentication
			$this->SMTPAuth = true;
			//Username to use for SMTP authentication - use full email address for gmail
			$this->Username = 'histdummy1@gmail.com'; //Change
			$this->Password = 'fpcdakscuzlmqovm'; //Change

			//Set who the message is to be sent from
			$this->setFrom('histdummy1@gmail.com', 'Hidaya Trust'); //Change
		
			//Set the subject line
			$this->Subject = 'Hidaya Trust Spread Education - Support Poor Students (Monthly)';
		}



	/*Manage Approve Reject Status Email Send:Start*/
		public function approve_reject_mail_send($data)
		{
	 		extract($data);
			//Set who the message is to be sent to
			$this->addAddress($applicant_email, 'Hidaya');
			
			if ($applicant_status == 1) {
				$applicant_status ="Approved";
				$message = "<p>".$applicant_gender." ".$applicant_first_name." ".$applicant_last_name." Your Application Status Has Been <span style ='color:green;'><b>".$applicant_status." On ".date("d-M-Y")."</b></span>  </p>";
			}else{
				$applicant_status ="Rejected";
				$message = "<p>".$applicant_gender." ".$applicant_first_name." ".$applicant_last_name." Your Application Status Has Been <span style ='color:red;'><b>".$applicant_status." On ".date("d-M-Y")."</b></span> </p>";
			}

			$message .= "<p>Comment: <b>".$comment."</b></p> ";
					
			$this->msgHTML($message);
			$flag = $this->send();

			return $flag;
			
		}
	/*Manage Approve Reject Status Email Send:End*/


	/*Manage Support Start Stop And Amount Status Email Send:Start*/
		public function support_start_stop_mail_send($data)
		{
	 		extract($data);
			//Set who the message is to be sent to
			$this->addAddress($applicant_email, 'Hidaya');
			
			if ($support_stop !='') {

				$message = "<p>".$applicant_gender." ".$applicant_first_name." ".$applicant_last_name." You'r Support Has Been <b style='color:red;'> Stopped On ".date("d M Y", strtotime($support_stop))."</b><br/>";
				$message.="And You'r Support Amount Is <b>Rs: ".$support_amount."</b></p>";

			}else{

				$message = "<p>".$applicant_gender." ".$applicant_first_name." ".$applicant_last_name." You'r Support Has Been <b style='color:green;'> Started On ".date("d M Y", strtotime($support_start))."</b><br/>";
				$message.="And You'r Support Amount Is <b>Rs: ".$support_amount."</b></p>";
			}
				
			$this->msgHTML($message);
			$flag = $this->send();

			return $flag;
			
		}
	/*Manage Support Start Stop And Amount Status Email Send:End*/


	/*Bulk Application Approved Reject Status Email Send :Start*/
		public function bulk_approve_reject_mail_send($data)
		{
			extract($data);	
			//Set who the message is to be sent to
			$this->addAddress($applicant_email, 'Hidaya');
			
			if ($status == 1) {
				$applicant_status ="Approved";
				$message = "<p>".$applicant_gender." ".$applicant_first_name." ".$applicant_last_name." Your Application Status Has Been <span style ='color:green;'><b>".$applicant_status." On ".date("d M Y")."</b></span> .</p>";
			}else{
				$applicant_status ="Rejected";
				$message = "<p>".$applicant_gender." ".$applicant_first_name." ".$applicant_last_name." Your Application Status Has Been <span style ='color:red;'><b>".$applicant_status." On ".date("d M Y")."</b></span> .</p>";
			}			

			$this->msgHTML($message);
			$flag = $this->send();

			return $flag;
			
		}
	/*Bulk Application Approved Reject Status Email Send :End*/


	/*Bulk Application Support Start Stop Status Email Send:Start*/
		public function bulk_support_start_stop_mail_send($data)
		{			
			extract($data);	

			$this->full_name = $applicant_first_name." ".$applicant_last_name;
			//Set who the message is to be sent to
			$this->addAddress($applicant_email, 'Hidaya');
			
			if ($status =='3') {

			$message = "<p>".$applicant_gender." ".$applicant_first_name." ".$applicant_last_name." You'r Support Has Been <b style='color:red;'> Stopped On ".date("d M Y")."</b>";
			}else{
				$message = "<p>".$applicant_gender." $this->full_name You'r Support Has Been <b style='color:green;'> Started On ".date("d M Y")."</b>";
			}
				
			$this->msgHTML($message);
			$flag = $this->send();

			return $flag;
			
		}
	/*Bulk Application Support Start Stop Status Email Send:End*/

	/*Resubmit Form Email Send To The Beneficiary By Admin :Start*/
		public function resubmit_form_mail_send($data){
			extract($data);
			$this->addAddress($applicant_email, 'Some Name');

			$this->msgHTML($message);
			
			if (!$this->send()) {
			    // echo 'Mailer Error: ' . $mail->ErrorInfo;
				header("location:../admin/index.php?message=Some thing went wrong email didn't sent to the beneficiary&class=danger");
				die();
			}else{
				header("location:../admin/index.php?message=Applicant ID $applicant_id staus has been updated successfully&class=success");
				die();
			}
			
		}

	/*Resubmit Form Email Send To The Beneficiary By Admin :End*/

	/*Resubmit Saved Form Email Send To The Beneficiary By Self :Start*/
		public function resubmit_save_form_mail_send($data){
			extract($data);
			$this->addAddress(base64_decode($applicant_email), 'Some Name');

			$this->msgHTML($message);

			if (!$this->send()) {
			   header("location:request_to_save_form.php?msg=Some thing went wrong email didn't sent.&class=danger");
			   die();
			} else {
			    header("location:request_to_save_form.php?msg=Email has been sent successfully.&class=success");
			   	die();
			}
			
		}
	/*Resubmit Saved Form Email Send To The Beneficiary By Self :End*/


	}

 ?>