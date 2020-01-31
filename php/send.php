<?php
 require("class.phpmailer.php");
  require("class.smtp.php");
if(isset($_POST['formEmail'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "service@getadoc.co.za";
 
    $email_subject = "Website Contact Request";
    $email_Port = "465";   
  
    $email_Smtp = "ssl://smtp.gmail.com";
    $email_username = "noreply@getadoc.co.za";
 
    $email_password = "n0r3plypw";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['formName']) ||
 
       
 
        !isset($_POST['formEmail']) ||
 
        
 
        !isset($_POST['formMsg'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $contactname = $_POST['formName']; // required
 
  
 
    $email_from = $_POST['formEmail'];
    
    
 
  
 
    $message = $_POST['formMsg']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
    if(!preg_match($email_exp,$email_from)) {
 
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
    }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
    if(!preg_match($string_exp,$contactname)) {
 
        $error_message .= 'The  Name you entered does not appear to be valid.<br />';
 
    }
 

 
    if(strlen($message) < 2) {
 
        $error_message .= 'The message you entered do not appear to be valid.<br />';
 
    }
 
    if(strlen($error_message) > 0) {
 
        died($error_message);
 
    }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
        $bad = array("content-type","bcc:","to:","cc:","href");
 
        return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Name: ".clean_string($contactname)."\n";
 
  
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
     
    
 
   
    $email_message .= "message: ".clean_string($message)."\n";
 
     
 
     
 
    // create email headers
 
    $headers = 'From: '.$email_from."\r\n".
 
    'Reply-To: '.$email_from."\r\n" .
 
    'X-Mailer: PHP/' . phpversion();
 
    require("class.phpmailer.php");

    $mail = new PHPMailer();

    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->SMTPAuth   = true; // SMTP authentication
    
    $smtp_mail->SMTPSecure = "ssl";  
    $mail->CharSet = 'UTF-8';
    $mail->Host       = $email_Smtp ; // SMTP server
    $mail->Port       = $email_Port ; // SMTP Port
    $mail->Username   = $email_username; // SMTP account username
    $mail->Password   = $email_password ;        // SMTP account password
$mail->AddReplyTo($email_from, $contactname);
    $mail->SetFrom($email_username, 'Info'); // FROM
   
    $mail->AddAddress($email_to, 'Info'); // recipient email

    $mail->Subject    = "Website Contact Request"; // email subject
    $mail->Body       = $email_message;

    if(!$mail->Send()) {
        echo 'Message was not sent.';
        died(  $mail->ErrorInfo);
    } else {
        echo 'Message has been sent.';
    } 
    header("Location: ../index.html?success=1");
    die()
    ?>

<?php
 
    }
 
?>