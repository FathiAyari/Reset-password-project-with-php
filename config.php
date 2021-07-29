<?php

$connect=mysqli_connect("localhost","root","","resetpassword");
if (mysqli_connect_errno()) {
    echo " failed to connect to database".mysqli_connect_errno();
    
}

?>