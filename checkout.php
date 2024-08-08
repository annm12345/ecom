<?php
require('top.php');
$cupon_id='';
$dd='';
$cupon_str='';
$name='';
$email='';
$mobile='';
$password='';
$msg='';
if(!isset($_SESSION['USER_LOGIN']))
{
    ?>
    <script>
        window.location.href='login.php';
    </script>
    <?php
}

if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0 )
{?>
    <script>
        window.location.href='index.php';
    </script>
<?php }

$cart_total=0;
foreach($_SESSION['cart']as $key=>$val)
{
$productArr=get_product($con,'','',$key,'','','','');
$price=$productArr ['0'] ['price'];
$qty=$val['qty'];
$cart_total=$cart_total+($price*$qty); 
}  
if(isset($_POST['submit']))
{
    $uname=get_safe_value($con,$_POST['uname']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $address=get_safe_value($con,$_POST['address']);
    $state=get_safe_value($con,$_POST['state']);
    $city=get_safe_value($con,$_POST['city']);
    $country=get_safe_value($con,$_POST['country']);
    $pincode=get_safe_value($con,$_POST['pincode']);
    $payment_type=get_safe_value($con,$_POST['payment_type']);
    $user_id=$_SESSION['USER_ID'];
    $payment_status='pending';
    if($payment_type=='kpay')
    {
        $payment_status='success';
    }
    $order_status='1';
    $added_on=date('Y-m-d h:i:s');
    if(isset($_SESSION['COUPON_ID']))
    {
        $cupon_id=$_SESSION['COUPON_ID'];
        $dd=$_SESSION['COUPON_VALUE'];
        $cupon_str=$_SESSION['COUPON_CODE'];
        $final_price=$cart_total-$dd;
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_VALUE']);
        unset($_SESSION['COUPON_CODE']);
    }else{
        $cupon_id=$_SESSION['COUPON_ID'];
        $dd=0;
        $cupon_str=$_SESSION['COUPON_CODE'];
        $final_price=$cart_total;
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_VALUE']);
        unset($_SESSION['COUPON_CODE']);
    }

    mysqli_query($con,"INSERT INTO `order`(`id`, `user_id`, `uname`, `email`, `mobile`, `address`, `state`, `city`, `country`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `cupon_id`, `cupon_value`, `cupon_code`, `added_on`) VALUES ('[value-1]','$user_id','$uname','$email','$mobile','$address','$state','$city','$country','$pincode','$payment_type','$final_price','$payment_status','$order_status','$cupon_id','$dd','$cupon_str','$added_on')");

    $order_id=mysqli_insert_id($con);

    foreach($_SESSION['cart']as $key=>$val)
    {
    $productArr=get_product($con,'','',$key,'','','','');
    $price=$productArr ['0'] ['price'];
    $qty=$val['qty'];
    
    mysqli_query($con,"INSERT INTO `order_detail`(`id`, `order_id`, `product_id`, `qty`, `price`) VALUES ('[value-1]','$order_id','$key','$qty','$price')");
    setInvoice($con,$order_id);
    ?>
        
        <script>
            window.location.href='thank_you.php';
        </script>
    <?php }  
    unset($_SESSION['cart']);

    
        
}

?>
<!-- Breadcrumb Start -->
<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="uname" placeholder="John" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" name="email" placeholder="example@email.com" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" name="mobile" placeholder="+123 456 789" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line </label>
                            <input class="form-control" type="text" name="address" placeholder="123 Street" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <select class="custom-select" name="state" required>
                                <option selected>States/Union</option>
                                <option>Kachin</option>
                                <option>Kayar</option>
                                <option>Kayin</option>
                                <option>Chin</option>
                                <option>Mon</option>
                                <option>Rakhine</option>
                                <option>Shan</option>
                                <option>NayPyiTaw</option>
                                <option>Yangon</option>
                                <option>Madalay</option>
                                <option>Sigaing</option>
                                <option>Bago</option>
                                <option>Tanintharyi</option>
                                <option>Magway</option>
                                
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" placeholder="MinGaLarDon" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control" type="text" name="country" placeholder="Myanmar" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" name="pincode" placeholder="123" required>
                        </div>
                        <div class="mb-5">
                            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                            <div class="bg-light p-30">
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="payment_type" id="paypal" value="kpay" required>
                                        <label class="custom-control-label" for="paypal">KBZ Pay</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="payment_type" id="directcheck" value="WPay" required>
                                        <label class="custom-control-label" for="directcheck">WAVE Pay</label>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="payment_type" id="banktransfer" value="MYTEL Pay" required>
                                        <label class="custom-control-label" for="banktransfer">MYTEL Pay</label>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-block btn-primary font-weight-bold py-3" name="submit" value="Payment">
                            </div>
                        </div>
                        
                    </div>
                    </form>
                    <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#login">User Login</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount" data-toggle="collapse" data-target="#register">Create an account</label>
                            </div>
                        </div>
                </div>
                <?php 
                if(!isset($_SESSION['USER_LOGIN']))
                { ?>
                <div class="collapse mb-5" id="login">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Login</span></h5>
                    <div class="bg-light p-30">
                    <form action="check_login.php" method="post">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="floatingInput">Email address</label>
                                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" require value="<?php echo $email ?>">
                            
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="floatingPassword">Password</label>
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" require value="<?php echo $password ?>">
                            </div>
                            <input type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit" value="Login">
                            <div style="color:red;"><?php echo $msg ?></div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="collapse mb-5" id="register">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Register</span></h5>
                    <div class="bg-light p-30">
                        <form action="check_register.php" method="post">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="floatingInput">User name</label>
                                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Usre name" require value="<?php echo $name ?>">
                            
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="floatingInput">Email address</label>
                                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" require value="<?php echo $email ?>">
                            
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="floatingPassword" require value="<?php echo $mobile ?>">Mobile</label>
                                <input type="text" class="form-control" id="floatingPassword" name="mobile" placeholder="+959123456789">
                            
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="floatingPassword">Password</label>
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" require value="<?php echo $password ?>">
                            </div>
                            <input type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit" value="Register">
                            <div style="color:red;"><?php echo $msg ?></div>
                        </div>
                        </form>
                    </div>
                </div>
                <?php } ?>
                
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    <?php
                        $cart_total=0;
                        foreach($_SESSION['cart']as $key=>$val){
                        $productArr=get_product($con,'','',$key,'','','','');
                        $pname=$productArr ['0'] ['name'];
                        $mrp=$productArr ['0'] ['mrp'];
                        $price=$productArr ['0'] ['price'];
                        $image=$productArr ['0'] ['image'];
                        $qty=$val['qty'];
                        $cart_total=$cart_total+($price*$qty);   
                    ?>
                        <div class="d-flex justify-content-between">
                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" style="width:75px; border:1px solid white;" alt="">
                            <p><?php echo $pname ?></p>
                            <p><?php echo $price ?></p>
                            <p><?php echo $qty ?></p>
                            <p><?php echo $price*$qty ?></p>
                            <a class="btn btn-sm " type="submit" href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    <?php } ?>    
                    </div>
                    <div class="pt-2 cupon_box">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Coupon Value</h5>
                            <h5 id="coupon_price"></h5>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="order_total_price"><?php echo $cart_total ?></h5>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control" type="text" id="cupon_str" placeholder="Cupon Code" required><br>
                        <input type="submit" class="btn btn-primary py-3 w-100 mb-4" name="" value="Apply Cupon" onclick="set_cupon()">
                    </div>
                    <div id="coupon_result"></div>
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- Checkout End -->
    <style>
        #coupon_result
        {
            color:blue;
        }
        .cupon_box
        {
            display:none;
        }
    </style>
    <script src="active.js"></script>
    <script>
        function set_cupon(){
            var cupon_str=jQuery('#cupon_str').val();
            if(cupon_str!='')
            {
                jQuery('#coupon_result').html('');
                jQuery.ajax({
                    url:'set.cupon.php',
                    type:'post',
                    data:'cupon_str='+cupon_str,
                    success:function(result){
                        var data=jQuery.parseJSON(result);
                        if(data.is_error=='yes'){
                            jQuery('.cupon_box').hide();
                            jQuery('#coupon_result').html(data.dd);
                            jQuery('#order_total_price').html(data.result);
                        }
                        if(data.is_error=='no'){
                            jQuery('.cupon_box').show();
                            jQuery('#coupon_price').html(data.dd);
                            jQuery('#order_total_price').html(data.result);
                            
                        }
                    }

                })
            }
        }
    </script>

<?php
require('foot.php');
?>
