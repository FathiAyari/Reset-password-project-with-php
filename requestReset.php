<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';

//Create an instance; passing `true` enables exceptions

if (isset($_POST["reset"]) && ($_POST["email"]) !=""){


  


    $mailTo=$_POST["email"];
    $code=uniqid(true);
    
    $query=mysqli_query($connect,"INSERT INTO reset(code,email) VALUES('$code','$mailTo')");
    if (!$query) {
        echo " error";
    }
    
     $mail = new PHPMailer(true);
    

try {
    //Server settings
                 //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ayarif648@gmail.com';                     //SMTP username
    $mail->Password   = 'rayenwifekbahija';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ayarif648@gmail.com', ' Php Mailer');
    $mail->addAddress("$mailTo" , 'Joe User');     //Add a recipient           //Name is optional

   
    //Content
    $url="http://". $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/ResetPassword.php?code=$code";
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "<h1>you requested a password reset 
    click this <a href='$url'>link</a>to change it </h1>".$code;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
exit();



}




?>
				

     

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <title>test</title>
</head>
<body>

    
<?php 


               
if (isset($_GET['result'])) {
    if ($_GET['result']=='oui') {
        ?>
    <div class="alert alert-success" role="alert" id="c1">
<strong>admin</strong> ajoute avec succees.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>   
</div>
<?php

}elseif($_GET['result']=='non'){

?>

<div class="alert alert-danger" role="alert" id="c1">
<strong>admin</strong> empty email .
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
            <?php }   }?>
              

            

<form   method="Post">
<div class="form-group">
    <label for="email">email</label>
    <input type="email" name="email" class="form-control"  > <br>
    <div class="flex-container">
        
    <div>
        <input type="submit" value="reset" name="reset" class="btn btn-primary" >
    </div>
   
    </div>

 
</div>
</form>

</body>
</html>
