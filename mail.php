<?php
require('connection.inc.php');
require('function.inc.php');
$order_id=$_GET['id'];

$res=mysqli_query($con,"SELECT distinct(order_detail.id), order_detail.*,product.image,product.name,product.price  from order_detail,product,`order` where order_detail.order_id='$order_id' and  product.id=order_detail.product_id");

$cupon_detail=mysqli_fetch_assoc(mysqli_query($con,"SELECT cupon_value FROM `order` where id='$order_id'"));
$cupon_value=$cupon_detail['cupon_value'];

$user_order=mysqli_fetch_assoc(mysqli_query($con,"select `order`.*,users.name,users.email from `order`,users where users.id=`order`.user_id and `order`.id='$order_id'"));
$email=$user_order['email'];
$html='<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        .container
        {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
        }
        .body{
            width: 500px;
        }
        .first_head{
            display: inline;
        }
        .second{
            background-color: bisque;
            width: 100%;
            height: 80px;
            display: block;
        }
        .third{
            margin-top: 50px;
        }
        .table{
            width: 100%;
            border-top:2px solid red;
            border-bottom:2px solid red;
        }
        td{
            width:30%;
        }
        .tdd{
            text-align:right;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="body">
            <h2 class="first_head">Hi ,</h2><h2 class="first_head">'.$user_order['uname'].'</h2>,
            <p>thanks for using <b>our products</b>. This is an invoice for your recent purchase.</p>
            <div class="second">
            
                <p>Amount Due: <b>'.$user_order['total_price'].'</b> </p>
                <p>Due By: <b>'.$user_order['added_on'].'</b> </p> 
            </div>
            <div class="third">
                <p style="float: left;"><b>'.$user_order['id'].'</b></p>
                <p style="float: right;"><b>'.$user_order['added_on'].'</b></p>
            </div>
            <br>
            <br>
            Invoice Details
            <div class="">
                <p style="float: left;font-size: 13px;">Description</p>
                <p style="float: right;font-size: 13px;">Amount</p>
            </div>
            <br>
            <br>
            
                
                    ';
                    while($row=mysqli_fetch_assoc($res)){
                        $html.='
                        <div>
                            <table class="table">
                                <tr>
                                    <td class="td">Description</td>
                                    <td class="td">QTY</td>
                                    <td class="td">Price</td>
                                    <td class="tdd">Amount</td>
                                </tr>
                                <tr>
                                    <td class="td">'.$row['name'].'</td>
                                    <td class="td">'.$row['qty'].'</td>
                                    <td class="td">'.$row['price'].'</td>
                                    <td class="tdd">'.$row['price']*$row['qty'].'</td>
                                </tr>
                            </table>
                        </div>';
                    }
                
                
            
            
            if($cupon_value!='')
                {
                    $html.='
                        <div>
                        <table style="width:100%;border-bottom:2px solid black;">
                            <tr>
                                <td class="" style="text-align:right;idth:80%;" >Coupon Value</td>
                                <td style="text-align:right;">'.$cupon_value.'</td>
                            </tr>
                        </table>
                        </div>';
                }
            

            $html.='<div>
            <table style="width:100%;">
                <tr>
                    <td class="" style="text-align:right;idth:80%;" >Total Price</td>
                    <td style="text-align:right;">'.$user_order['total_price'].'</td>
                </tr>
            </table>
            </div>
            <br><br>
            <div>
                <p ><b>if you have any questions about this invoice, simply reply to this emial or reach out to our support <a href="#">support Team</a> for help.</b> </p>
                
            </div>
        </div> 
        
    </div>
</body>
</html>';

if($email!='')
{
    require 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'aungnyinyimin32439@gmail.com';                 // SMTP username
    $mail->Password = 'gdbcegflheqtzjjd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('aungnyinyimin32439@gmail.com', 'beauty life');
    $mail->addAddress($email);               // Name is optional

    $mail->addAttachment('');         // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Invoice Details';
    $mail->Body    =  $html;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'sent';
    }
}

?>
