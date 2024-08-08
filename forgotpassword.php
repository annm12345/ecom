<?php
require('top.php');
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
                            <h3>Forget Password</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control first_box" id="email" placeholder="name@example.com" name="email" required>
                            <label for="floatingInput">Email address</label>
                            <br>
                            <span id="email_error" class="field_error"></span>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4 first_box" name="submit" onclick="forget_password()">OTP Send</button>
                        <p class="text-center mb-0">Already have an Account? <a href="login.php">Login</a></p>
                        <!-----comfirm password----->
                        <div class="form-floating mb-4 second_box">
                        <input type="text" class="form-control " id="password" name="password" placeholder="Password" required>
                        <button type="submit" class="btn btn-primary py-3 w-40 mb-4" onclick="verify_password()">Comfirm New Password</button>
                        </div>
                        <br>
                        <span id="password_result" class="field_error"></span>
                        <br><span id="password_error" class="field_error"></span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
        <script>
        function forget_password()
            {
                jQuery('#email_error').html('');
                var email=jQuery('#email').val();
                if(email==''){
                    jQuery('#email_error').html('Please enter vaild email');
                }
                else
                {
                    jQuery.ajax({
                        url:'get_password.php',
                        type:'post',
                        data:'email='+email,
                        success:function(result)
                        {
                            if(result=='exist'){
                                jQuery('#email').attr('disabled',true);
                                jQuery('.second_box').show();
                                jQuery('.first_box').hide();
                            }else
                            {
                                jQuery('#email_error').html('Please enter vaild email');
                            }
                        }
                    });
                        
                
                }
            }
            function verify_password()
            {
                jQuery('#password_error').html('');
                var password=jQuery('#password').val();
                if(password==''){
                    jQuery('#password_error').html('Please enter vaild password');
                }
                else
                {
                    jQuery.ajax({
                        url:'verify_password.php',
                        type:'post',
                        data:'password='+password,
                        success:function(result)
                        {
                            if(result=='exist'){
                                window.location.href='new_password.php';
                            }else
                            {
                                jQuery('#password_error').html('Please enter vaild password');
                            }
                        }
                    });
                        
                
                }
            }
        </script>
        <style>
            .second_box
            {
                display:none;
            }
            .third_box
            {
                display:none;
            }
            .field_error
            {
                color:red;
            }
        </style>
<?php
require('foot.php');
?>