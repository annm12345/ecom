<?php
require('top.inc.php');

$sql="select* from users order by id asc";
$res=mysqli_query($con,$sql);
?>
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
                
                   
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Order</h6>
                            
                                    <table class="table">
                                        <thead class="thead">
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
                                            $res=mysqli_query($con,"SELECT `order`.*,order_status.name as order_status FROM `order`,order_status where order_status.id=`order`.order_status");
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                            ?>
                                            <tr style="color:black;">
                                                <td class="align-middle" style="width:150px;height:120px;color:black;background-color:aqua;"><a href="order_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
                                                <td class="align-middle" style="width:150px;height:120px;color:black;background-color:aqua;"><?php echo $row['added_on'] ?></td>
                                                <td class="align-middle" style="width:150px;height:120px;color:black;background-color:aqua;">
                                                <?php echo $row['address'] ?>
                                                <?php echo $row['state'] ?>
                                                <?php echo $row['city'] ?>
                                                <?php echo $row['pincode'] ?>
                                                </td>
                                                <td class="align-middle" style="width:150px;height:120px;color:black;background-color:aqua;"><?php echo $row['payment_type'] ?></td>
                                                <td class="align-middle" style="width:150px;height:120px;color:black;background-color:aqua;"><?php echo $row['payment_status'] ?></td>
                                                <td class="align-middle" style="width:150px;height:120px;color:black;background-color:aqua;"><?php echo $row['order_status'] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                    </div>
</div>
                    
            <!-- Table End -->
<?php
require('footer.inc.php');
?>