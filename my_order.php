<?php
require('top.php');
?>

<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Address</th>
                            <th>Payment type</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $uid=$_SESSION['USER_ID'];
                        $res=mysqli_query($con,"SELECT `order`.*,order_status.name as order_status FROM `order`,order_status where `order`.user_id='$uid' and order_status.id=`order`.order_status");
                        while($row=mysqli_fetch_assoc($res))
                        {
                        ?>
                        <tr>
                            <td class="align-middle" style="width:150px;height:120px;"><a href="my_order_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['added_on'] ?></td>
                            <td class="align-middle" style="width:150px;height:120px;">
                            <?php echo $row['address'] ?>
                            <?php echo $row['state'] ?>
                            <?php echo $row['city'] ?>
                            <?php echo $row['pincode'] ?>
                            </td>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['payment_type'] ?></td>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['payment_status'] ?></td>
                            <td class="align-middle" style="width:150px;height:120px;"><?php echo $row['order_status'] ?></td>
                        </tr>
                        <?php } ?>
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