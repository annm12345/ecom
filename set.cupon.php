<?php
require('connection.inc.php');
require('function.inc.php');

$cupon_str=get_safe_value($con,$_POST['cupon_str']);
$count=mysqli_num_rows(mysqli_query($con,"select * from cupon where cupon_code='$cupon_str' and status='1'"));

if(isset($_SESSION['COUPON_ID'])){
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
}
$cart_total=0;
foreach($_SESSION['cart']as $key=>$val)
{
$productArr=get_product($con,'','',$key,'','','','');
$price=$productArr ['0'] ['price'];
$qty=$val['qty'];
$cart_total=$cart_total+($price*$qty);
}   
$jsonArr=array();
if($count>0)
{
    $row=mysqli_fetch_assoc(mysqli_query($con,"select * from cupon where cupon_code='$cupon_str' and status='1'"));
    $id=$row['id'];
    $cupon_value=$row['cupon_value'];
    $cupon_type=$row['cupon_type'];
    $cart_min_value=$row['cart_min_value'];
    
    if($cart_min_value>$cart_total)
    {
        $jsonArr=array('is_error'=>'yes','result'=>$cart_total,'dd'=>'Cart value must be'.$cart_min_value);
        echo "less_total";
    }else{
        if($cupon_type=='mmk')
        {
           $final_price=$cart_total-$cupon_value;
        }else{
            $final_price=$cart_total-(($cart_total*$cupon_value)/100);
        }
        $dd=$cart_total-$final_price;
        $_SESSION['COUPON_ID']=$id;
        $_SESSION['FINAL_PRICE']=$final_price;
        $_SESSION['COUPON_VALUE']=$dd;
        $_SESSION['COUPON_CODE']=$cupon_str;
        $_SESSION['CART_TOTAL']=$cart_total;
        $jsonArr=array('is_error'=>'no','result'=>$final_price,'dd'=>$dd);
    }
}else{
    
    $jsonArr=array('is_error'=>'yes','result'=>$cart_total,'dd'=>'coupon Code not_found');
}

echo json_encode($jsonArr);



?>
