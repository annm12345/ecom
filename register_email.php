<?php
require('top.php');

?>
<!-- Sign Up Start -->
<div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form action="" method="post">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3 ">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>E- SHOP</h3>
                            </a>
                            <h3>Login</h3>
                        </div>
                        <div class="form-floating mb-3 first_box">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Usre name" required>
                            <label for="floatingInput">User name</label>
                            <br>
                            <span id="name_error" class="field_error"></span>
                        </div>
                        <div class="form-floating mb-3 first_box">
                            <input type="email" class="form-control " id="email" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                            <br>
                            <span id="email_error" class="field_error"></span>
                        </div> 
                        <div class="form-floating mb-4 first_box">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
                            <label for="floatingPassword" required>Mobile</label>
                            <br>
                            <span id="mobile_error" class="field_error"></span>
                        </div>
                        <div class="form-floating mb-4 first_box">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                            <br>
                            <span id="password_error" class="field_error"></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4 first_box">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary py-3 w-100 mb-4 first_box" name="submit" onclick="sent_otp()" value="Register">
                        <p class="text-center mb-0 first_box">Already have an Account? <a href="login.php">Login</a></p>
                        <br>
                        <span id="register_error" class="field_error"></span>


                        <div class="form-floating mb-4 second_box">
                        <input type="text" class="form-control " id="otp" name="otp" placeholder="OTP" required>
                        <button type="submit" class="btn btn-primary py-3 w-40 mb-4" onclick="verify_otp()">Verify OTP</button>
                        </div>
                        <br>
                        <span id="otp_result" class="field_error"></span>
                        <br><span id="otp_error" class="field_error"></span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
        <script>
            /* email otp code send by smtp server*/
            function sent_otp()
            {
                jQuery('#email_error').html('');
                var name=jQuery('#name').val();
                var email=jQuery('#email').val();
                var mobile=jQuery('#mobile').val();
                var password=jQuery('#password').val();

                if(name=='')
                {
                    jQuery('#name_error').html('Please enter name');
                }
                if(email==''){
                    jQuery('#email_error').html('Please enter email');
                }
                if(mobile==''){
                    jQuery('#mobile_error').html('Please enter mobile');
                }
                if(password==''){
                    jQuery('#password_error').html('Please enter password');
                }
                else
                {
                    jQuery.ajax({
                        url:'sent_otp.php',
                        type:'post',
                        data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
                        success:function(result)
                        {
                            if(result=='new'){
                                jQuery('#email').attr('disabled',true);
                                jQuery('.second_box').show();
                                jQuery('.first_box').hide();
                            }else
                            {
                                jQuery('#email_error').html('Please enter vaild email address');
                            }
                        }
                    });
                        
                
                }
            }
            /* verify otp code from localhost*/
            function verify_otp()
            {
                jQuery('#email_error').html('');
                var otp=jQuery('#otp').val();
                if(otp=='')
                {
                    jQuery('#otp_error').html('Please enter OTP');
                }else
                {
                    jQuery.ajax({
                        url:'check_otp.php',
                        type:'post',
                        data:'otp='+otp,
                        success:function(result)
                        {
                            if(result=='yes'){
                                window.location.href='login.php';
                            }
                            if(result=='no')
                            {
                                jQuery('#email_error').html('Please enter vaild OTP');
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
            .field_error
            {
                color:red;
            }
        </style>

<?php
require('foot.php');
?>