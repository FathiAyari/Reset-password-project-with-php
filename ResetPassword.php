<?php
include("config.php");

if (! isset($_GET["code"])) {
    exit("can't find the page");



}
$code= $_GET["code"];
$getEmailQuery= mysqli_query($connect,"SELECT email FROM reset WHERE code='$code'");


if (mysqli_num_rows($getEmailQuery)==0) {
    exit("no existant email ");


    
}

if (isset($_POST["reset"])) {
    $pwd= $_POST["pwd"];
    $pwd=md5($pwd);
    $row = mysqli_fetch_array($getEmailQuery);
    $email=$row["email"];
    $query=mysqli_query($connect,"UPDATE user SET password='$pwd' WHERE email='$email' ");

    if ($query) {
    $query=mysqli_query($connect,"DELETE FROM reset WHERE code='$code' ");
    exit("password updated with success .");
    }
    else {
        exit("smthng went wrong");
    }
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

 
              

            

<form   method="Post">
<div class="form-group">
    <label for="pwd">New password</label>
    <input type="password" name="pwd" class="form-control"  > <br>
    <div class="flex-container">
        
    <div>
        <input type="submit" value="reset" name="reset" class="btn btn-primary" >
    </div>
   
    </div>

 
</div>
</form>

</body>
</html>

