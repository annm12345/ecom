<?php
echo '<b> Transaction In Process, Please do not reload </b>';

echo '<pre>';
print_r($_POST);

$payment_mode=$_POST['mode'];
$pay_id=$_POST['mihpayid'];
$status=$_POST['status'];
$firstname=$_POST['firstname'];
$amount=$_POST['amount'];
$txnid=$_POST['txnid'];
$posted_hash=$_POST['hash'];
$key=$_POST['key'];
$productinfo=$_POST['productinfo'];
$email=$_POST['email'];
$MERCHANT_KEY="gtKFFX";
$SALT="eCwWELxi";
$udf5='';
$keystring=$MERCHANT_KEY.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
$keyArray=explode("|",$keystring);
$reverseKeyArray=array_reverse($keyArray);
$reverseKeyString=implode("|",$reverseKeyArray);
$saltString=$SALT.'|'.$status.'|'.$reverseKeyString;
$sentHashStrinng=strtolower(hash('sha512',$saltString));

if($sentHashStrinng != $posted_hash)
{
    $status='Fail';
}
else{
    $status='Completed';
}
echo $status;
?>
