<?php
require('top.inc.php');
$order_id=get_safe_value($con,$_GET['id']);
if(isset($_POST['update_order_status']))
{
   $update_order_status=$_POST['update_order_status'];
   mysqli_query($con,"update `order` set order_status='$update_order_status' where id='$order_id'");
}
$cupon_detail=mysqli_fetch_assoc(mysqli_query($con,"SELECT cupon_value FROM `order` where id='$order_id'"));
$cupon_value=$cupon_detail['cupon_value'];
?>
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Order Detail</h6>
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
                        $res=mysqli_query($con,"SELECT distinct(order_detail.id), order_detail.*,product.image,product.name,product.price from order_detail,product,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and product.id=order_detail.product_id");
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
                        <tr class="price" >
                            <td colspan="4" class="align-middle" style="width:65px;height:65;">Coupon Value</td>
                            <td class="align-middle" style="width:65;height:65;"><?php echo $cupon_value ?></td>
                        </tr>
                        <?php } ?>
                        <tr class="price">
                            <td colspan="4" class="align-middle" style="width:65px;height:65;">Total Price</td>
                            <td class="align-middle" style="width:65;height:65;"><?php echo $final_price ?></td>
                        </tr>
                        
                    </tbody>
                </table>
                
                <div id="address_detail">
                <?php
                $res=mysqli_query($con,"select `order`.address,`order`.state,`order`.city,`order`.pincode from `order` where `order`.id='$order_id' ");
                        $total_price=0;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $address=$row['address'];
                            $state=$row['state'];
                            $city=$row['city'];
                            $pincode=$row['pincode'];
                            
                            ?>
                    <strong style="color:gold;">Address</strong>
                    <?php echo $address ?>,<?php echo $city ?>,<?php echo $state ?>,<?php echo $pincode ?><br/><br/>
                    <strong style="color:gold;">Order Status</strong>
                    <?php
                    $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"select order_status.name from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id"));
                    echo $order_status_arr['name'];
                    ?>
                    <?php } ?>
                    <div>
                        <form action="" method="post">
                            <select name="update_order_status" class="form-control">
                            <option value="">Select Status</option>
                                <?php
                                    $res=mysqli_query($con,"select * from order_status");
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        if($row['id']==$categories_id)
                                        {
                                            echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row['id'].">".$row['name']."</option>";
                                        }
                                        
                                    }
                                ?>
                            </select>
                            <input type="submit" class="form-control">
                        </form>
                    </div>
                </div>
            
            </div>
</div>
                    
            <!-- Table End -->

            </style>
<?php
require('footer.inc.php');
?>