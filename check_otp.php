<?php
require('connection.inc.php');
require('function.inc.php');

$email=$_SESSION['EMAIL'];
$otp=get_safe_value($con,$_POST['otp']);
$res=mysqli_query($con,"select * from users where email='$email' and otp='$otp'");
$count=mysqli_num_rows($res);
if($count>0)
{
    mysqli_query($con,"update users set otp='' where email='$email'");
    echo 'yes';
}
else
{
    echo 'no';
}




?>