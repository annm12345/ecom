<?php
require('connection.inc.php');
require('function.inc.php');

$password=get_safe_value($con,$_POST['password']);
$res=mysqli_query($con,"select * from users where password='$password'");
$count=mysqli_num_rows($res);
if($count>0)
{
        echo 'exist';
    
}
else
{
    echo 'no';
}

?>