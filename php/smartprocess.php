<?php 

	if (!isset($_SESSION)) session_start(); 
	if(!$_POST) exit;
	
	include dirname(__FILE__).'/settings/settings.php';
	include dirname(__FILE__).'/functions/emailValidation.php';
	
	
	/* Current Date Year
	------------------------------- */		
	$currYear = date("Y");	
	
 
  
  /*	---------------------------------------------------------------------------
	: HI AVILY PLEASE KEEP THESE VALUES THE SAME ON HTML!
	--------------------------------------------------------------------------- */
  
  //PATIENT NAME
	$username = strip_tags(trim($_POST["username"]));		
  //PATIENT EMAIL
	$emailaddress = strip_tags(trim($_POST["emailaddress"]));
  //PATIENT PHONE NUMBER
	$telephone = strip_tags(trim($_POST["telephone"]));
 // PATIENT MESSAGE
	$sendermessage = strip_tags(trim($_POST["sendermessage"]));


/*	----------------------------------------------------------------------
	: Prepare form field variables for CSV export
	----------------------------------------------------------------------- */	
	if($generateCSV == true){
		$csvFile = $csvFileName;	
		$csvData = array(
			"$username",	
		
			"$emailaddress",
			"$telephone"
		);
	}

/*	-------------------------------------------------------------------------
	: Prepare serverside validation 
	------------------------------------------------------------------------- */
	$errors = array();

	//validate email address
	if(isset($_POST["emailaddress"])){
		if (!$emailaddress) {
			$errors[] = "You must enter an email.";
		} else if (!validEmail($emailaddress)) {
			$errors[] = "Your must enter a valid email address.";
		}
	}
			
	
	//In case there are errors, output them in a list
	if ($errors) {
		$errortext = "";
		foreach ($errors as $error) {
			$errortext .= '<li>'. $error . "</li>";
		}
		echo '<div class="alert notification alert-error">The following errors occured:<br><ul>'. $errortext .'</ul></div>';
	
	} else{		
		
		if ($_FILES['orderfiles']['error'] == 0) {
			move_uploaded_file($_FILES['orderfiles']['tmp_name'], '../smuploads/' .$order_upload);	
		
			include dirname(__FILE__).'/phpmailer/PHPMailerAutoload.php';
			include dirname(__FILE__).'/templates/smartmessage.php';
				
			$mail = new PHPMailer();	
			$mail->isSMTP();                                      
			$mail->Host = $SMTP_host;                    
			$mail->SMTPAuth = true;                              
			$mail->Username = $SMTP_username;               
			$mail->Password = $SMTP_password;               
			$mail->SMTPSecure = $SMTP_protocol;            
      $mail->AddReplyTo($emailaddress, $username);
      $mail->Port = $SMTP_port;
			$mail->IsHTML(true);
			$mail->From = $emailaddress;
			$mail->CharSet = "UTF-8";
			$mail->FromName = $username;
			$mail->Encoding = "base64";
			$mail->Timeout = 200;
			$mail->ContentType = "text/html";
			$mail->addAddress($receiver_email, $receiver_name);
			$mail->Subject = $receiver_subject;
			$mail->Body = $message;
			$mail->AltBody = $message;
					
			// For multiple email recepients from the form 
			// Simply change recepients from false to true
			// Then enter the recipients email addresses
			// echo $message;
			$recipients = false;
			if($recipients == true){
				$recipients = array(
					"address@example.com" => "Recipient Name",
					"address@example.com" => "Recipient Name"
				);
				
				foreach($recipients as $email => $username){
					$mail->AddBCC($email, $username);
				}	
			}
			
			if($mail->Send()) {
			/*	-----------------------------------------------------------------
				: Generate the CSV file and post values if its true
				----------------------------------------------------------------- */		
				if($generateCSV == true){	
					if (file_exists($csvFile)) {
						$csvFileData = fopen($csvFile, 'a');
						fputcsv($csvFileData, $csvData );
					} else {
						$csvFileData = fopen($csvFile, 'a'); 
						$headerRowFields = array(
							"username",
							"Email Address",
							"Telephone",
							"Website",
							"Services",
							"Budget",
							"Time Frame"										
						);
						fputcsv($csvFileData,$headerRowFields);
						fputcsv($csvFileData, $csvData );
					}
					fclose($csvFileData);
				}
				
			/*	---------------------------------------------------------------------
				: Send the auto responder message if its true
				--------------------------------------------------------------------- */
				if($autoResponder == true){
				
					include dirname(__FILE__).'/templates/autoresponder.php';
					
					$automail = new PHPMailer();	
					$automail->isSMTP();                                      
					$automail->Host = $SMTP_host;                    
					$automail->SMTPAuth = true;                              
					$automail->Username = $SMTP_username;               
					$automail->Password = $SMTP_password;               
					$automail->SMTPSecure = $SMTP_protocol;                            
					$automail->Port = $SMTP_port;
					$automail->From = $receiver_email;
					$automail->FromName = $receiver_name;
					$automail->isHTML(true);                                 
					$automail->CharSet = "UTF-8";
					$automail->Encoding = "base64";
					$automail->Timeout = 200;
					$automail->ContentType = "text/html";
					$automail->AddAddress($emailaddress, $username);
					$automail->Subject = "Thank you for contacting us";
					$automail->Body = $automessage;
					$automail->AltBody = $automessage;
					$automail->Send();	 
				}
				
				if($redirectForm == true){
					echo '<script>setTimeout(function () { window.location.replace("'.$redirectForm_url.'") }, 8000); </script>';
				}
							
			  	echo '<div class="alert notification alert-success">Message has been sent successfully! You will be redirected back to the website shortly...</div>'; 
			  
				// Start delete function 
				// Automatically deletes files from the smuploads folder after successful sending
				// You can remove this function if you want to keep uploads on your server
				$files = glob('../smuploads/*'); 
				foreach($files as $file){ 
				  if(is_file($file))
					unlink($file); 
				}	  
			  
				} 
				else {
					echo '<div class="alert notification alert-error">Message not sent - server error occured!</div>';	
				}
		}
	}
?>