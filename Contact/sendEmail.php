<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Contact - Andrew Hackmann</title>

<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
<link href="../styles/layout.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../styles/style1.css" rel="stylesheet" type="text/css" media="screen"/>
</head>

<body>


<?php
if(isset($_POST['email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "bossinctv@gmail.com";
    $email_subject = "Contact";
     
     
    function died($error) {
    	print '<script type="text/javascript">'; 
		print 'alert("These feilds are not valid:\n'. $error.'")'; 
		print '</script>'; 
        ?>
        <script language="javascript" type="text/javascript">
        window.location = '../Contact/';
        </script>
        <?php
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['your_name']) ||
        !isset($_POST['company_name']) ||
        !isset($_POST['website']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])) {
        died();       
    }
     
    $first_name = $_POST['your_name']; // required
    $last_name = $_POST['company_name']; // not required
    $website = $_POST['website']; // not required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[^<,\"@/{}()*$%?=>:|;#]*$/i";
  if(strlen($first_name) < 3) {
    $error_message .= 'Your Name\n';
  }
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Email\n';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'Comments\n';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($first_name)."\n";
    $email_message .= "Company: ".clean_string($last_name)."\n";
    $email_message .= "Website: ".clean_string($website)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
?>
<script language="javascript" type="text/javascript">
        // Print a message
        alert('Thank you for your message. Andrew Hackmann will contact you shortly.');
        // Redirect to some page of the site. You can also specify full URL, e.g. http://template-help.com
        window.location = '../Contact/';
</script>
<?php
}
?>

</body>

</html>
