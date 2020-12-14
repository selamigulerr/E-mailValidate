
<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
E-mail: <input type="text" name="email">
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php

$email = "";

$emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $emailtxt = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($emailtxt, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
      }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

// Include library file
require_once 'VerifyEmail.class.php'; 

// Initialize library class
$mail = new VerifyEmail();

// Set the timeout value on stream
$mail->setStreamTimeoutWait(20);

// Set debug output mode
$mail->Debug= TRUE; 
$mail->Debugoutput= 'html'; 

// Set email address for SMTP request
$mail->setEmailFrom('from@email.com');

// Email to check
$email = $emailtxt; 

// Check if email is valid and exist
if($mail->check($email)){ 
    echo 'Email &lt;'.$email.'&gt; is exist!'; 
}elseif(verifyEmail::validate($email)){ 
    echo 'Email &lt;'.$email.'&gt; is valid, but not exist!'; 
}else{ 
    echo 'Email &lt;'.$email.'&gt; is not valid and not exist!'; 
} 

?> 



</body>
</html>
