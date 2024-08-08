<?php
require('top.php');
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
            window.location.href='index.php';
            </script>
        <?php }
        else
        {
            $msg="Please enter correct login detail";
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
                            <h3>Login</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" require value="<?php echo $email ?>">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" require value="<?php echo $password ?>">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="forgotpassword.php">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Login</button>
                        <p class="text-center mb-0">Already have an Account? <a href="register_email.php">Register</a></p>
                        <div style="color:red;"><?php echo $msg ?></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
<?php
require('foot.php');
?>