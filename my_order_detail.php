<?php
require('top.php');
$order_id=get_safe_value($con,$_GET['id']);
$cupon_detail=mysqli_fetch_assoc(mysqli_query($con,"SELECT cupon_value FROM `order` where id='$order_id'"));
$cupon_value=$cupon_detail['cupon_value'];
?>
<div class="container-fluid">
<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $uid=$_SESSION['USER_ID'];
                        $res=mysqli_query($con,"SELECT distinct(order_detail.id), order_detail.*,product.image,product.name,product.price  from order_detail,product,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and product.id=order_detail.product_id");
                        $total_price=0;
                        while($row=mysqli_fetch_assoc($res))
                        {
                           $total_price=$total_price+($row['price']*$row['qty']);
                           $final_price=$total_price-$cupon_value;     
                        ?>
                        <tr>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['name'] ?></td>
                            <td class="align-middle" style="width:150px;height:120px;"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="" style="width:150px;" ></td>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['qty'] ?></td>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['price'] ?></td>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['price']*$row['qty'] ?></td>
                        </tr>
                        <?php }
                        if($cupon_value!='')
                        { ?>
                        <tr style="background-color:blue;color:white;">
                            <td colspan="4" class="align-middle" style="width:65px;height:65;">Coupon Value</td>
                            <td class="align-middle" style="width:65;height:65;"><?php echo $cupon_value ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="background-color:blue;color:white;">
                            <td colspan="4" class="align-middle" style="width:65px;height:65;">Total Price</td>
                            <td class="align-middle" style="width:65;height:65;"><?php echo $final_price ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->

</div>
<?php
require('foot.php');
?>