<?php
require('top.php');
$msg='';
$password='';
$email='';
if(isset($_POST['submit']))
{
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);
    
    if(empty(get_safe_value($con,$_POST['email'])))
    {
        $msg="Please enter vaild email";
    }
    else if(empty(get_safe_value($con,$_POST['password'])))
    {
        $msg="Please enter new password";
    }
    else 
    {
        $sql="select * from users where email='$email'";
        $res=mysqli_query($con,$sql);
        $count=mysqli_num_rows($res);
        if(!$count>0)
        {
            $msg="Please enter current register email";
        }
        else
        {
            $row=mysqli_fetch_assoc($res);
            if($password==$row['password'])
            {
                $msg="Try another password";
            }
            else
            {
                mysqli_query($con,"UPDATE `users` SET `password`='$password' WHERE email='$email'");
                ?>
                <script>
                    window.location.href='login.php';
                </script>
                <?php
            }
        }
    }
}

?>
<!-- Sign Up Start -->
<div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form action="" method="post">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">     
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>HEC | SHOP</h3>
                            </a>
                            <h3>create Password</h3>
                        </div>                  
                        <!----create new password--->
                        <div class="form-floating mb-4 ">
                        <input type="text" class="form-control " id="email" name="email" placeholder="Your Current Email" require value="<?php echo $email ?>">
                        </div>
                        <div class="form-floating mb-4 ">
                        <input type="text" class="form-control " id="password" name="password" placeholder="Password" require value="<?php echo $password ?>">
                        <button type="submit" class="btn btn-primary py-3 w-40 mb-4" name="submit" >Create New Password</button>
                        </div>
                        
                        <br><span id="password_error" class="field_error"><?php echo $msg ?></span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
        <script>/*
        
        function new_password()
            {
                jQuery('#password_error').html('');
                var password=jQuery('#password').val();
                if(password==''){
                    jQuery('#password_error').html('Please enter vaild password');
                }
                else
                {
                    jQuery.ajax({
                        url:'password_create.php',
                        type:'post',
                        data:'password='+password,
                        success:function(result)
                        {
                            
                        }
                    });
                        
                
                }
            }*/
        </script>
        <style>
            
            .field_error
            {
                color:red;
            }
        </style>
<?php
require('foot.php');
?>