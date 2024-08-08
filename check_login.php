<?php
require('connection.inc.php');
require('function.inc.php');
$msg='';
$email='';
$password='';
if(isset($_POST['submit']))
{
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);
    if(empty(get_safe_value($con,$_POST['email'])))
    {
        $msg="Please enter user email";
    }
    else if(empty(get_safe_value($con,$_POST['password'])))
    {
        $msg="Please enter user password";
    }
    else 
    {
        $sql="select * from users where email='$email' and password='$password' ";
        $res=mysqli_query($con,$sql);
        $count=mysqli_num_rows($res);
        if($count>0)
        { 
            $row=mysqli_fetch_assoc($res);
            $_SESSION['USER_LOGIN']='yes';
            $_SESSION['USER_ID']=$row['id'];
            $_SESSION['USER_EMAIL']=$row['email'];
            ?>
            <script>
            window.location.href='checkout.php';
            </script>
        <?php }
        else
        {
            $msg="Please enter correct login detail";
        }
    }

}
?>