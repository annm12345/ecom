<?php
require('connection.inc.php');
require('function.inc.php');
$name='';
$email='';
$mobile='';
$password='';
$msg='';
if(isset($_POST['submit']))
{
    
    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $password=get_safe_value($con,$_POST['password']);
    $added_on=date('Y-m-d h:i:s');
    if(empty(get_safe_value($con,$_POST['name'])))
    {
        $msg="Please enter user name";
    }
    else if(empty(get_safe_value($con,$_POST['email'])))
    {
        $msg="Please enter user email";
    }
    else if(empty(get_safe_value($con,$_POST['mobile'])))
    {
        $msg="Please enter user mobile";
    }
    else if(empty(get_safe_value($con,$_POST['password'])))
    {
        $msg="Please enter user password";
    }
    else 
    {
            $sql="select * from users where email='$email'";
            $res=mysqli_query($con,$sql);
            $count=mysqli_num_rows($res);
            
            if($count==1)
            {
                echo $msg="email already exist";
            }
            else{
            $query=mysqli_query($con,"INSERT INTO `users`(`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES ('','$name','$password','$email','$mobile','$added_on')");
            if($query)
            { ?>
                <script>
                    window.location.href='checkout.php';
                </script>
                echo " <script> alert ( 'Sucessfully saved'); </script> ";
            <?php }}
    }
    
        
    
}