<?php
if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please click back and check that you have filled in the captcha form.</h2>';
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=**************************************&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>If you are a spammer, please leave</h2>';
        }else
        {
          echo '<h2>Thank you for your contact request!</h2>';
        }
	/* Enter your name or company name below
	 * You can also use your website URL
	--------------------------------------------- */
	$receiver_name = "Client Name";
	
	/* Enter your message subject below
	 * This subject is the one you will see in your email
	------------------------------------------------------ */	
	$receiver_subject = "Website Contact Request";
	
	/* Form message will be sent to this email address
	 * For more than one email go to smartprocess.php then
	 * Add addresses to the recipients section
	------------------------------------------------------ */

	$receiver_email = "junaidsadien@gmail.com";

	
	/* If you want to redirect to another page after sending the form
	 * Change the $redirectForm option below from (false) to (true)
	 * Then add your redirect page URL replace - http://example.com/thankyou.php
	----------------------------------------------------------------------------- */	
	$redirectForm = true;
	$redirectForm_url = "/";
	
	/* Powered BY
	 * You will use both your website NAME and URL
	 * By default its powered by SMARTFORMS - http://www.doptiq.com/smart-forms
	----------------------------------------------------------------------------- */
	$poweredby_name = "Avily";
	$poweredby_url = "http://www.avily.co.za/";	
	
	/* If you want to store all form data in a CSV file
	 * Change the generateCSV option from (false) to (true)
	------------------------------------------------------------ */
	$generateCSV = false;
	
	/* Name for generated CSV file 
	 * Please don't change this name unless you have to
	------------------------------------------------------------ */	
	$csvFileName = "formcsv.csv";
	
	/* If you want to automatically reply to the sender 
	 * Change the autoresponder option below from (false) to (true)
	-------------------------------------------------------------------- */	
	$autoResponder = false;
	
	/* Add your SMTP details below
	 * Please specify servers, username, password, encryption type and port
	---------------------------------------------------------------------------- */                     
	$SMTP_host = 'ssl://smtp.gmail.com'; 			// SMTP servers 
	$SMTP_username = 'noreply@getadoc.co.za'; 		// SMTP username       
	$SMTP_password = 'n0r3plypw';		// SMTP password
	$SMTP_protocol = 'ssl';						// SMTP encryption 'ssl' or 'tls' accepted	  
	$SMTP_port = 465;							// SMTP Port number e.g 25, 465, 587	
   
  
?>