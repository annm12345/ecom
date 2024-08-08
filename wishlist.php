<?php
require('top.php');

if(!isset($_SESSION['USER_LOGIN']))
{
    ?>
    <script>
        window.location.href='login.php';
    </script>
    <?php
}
if(isset($_GET['id']))
{
    $wid=$_GET['id'];
    $uid=$_SESSION['USER_ID'];
    mysqli_query($con,"DELETE FROM `wishlist` WHERE id='$wid' and user_id='$uid'");
}
$uid=$_SESSION['USER_ID'];
$res=mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid' ")
?>
<!-- Cart Start -->
<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>MRP</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        while($row=mysqli_fetch_assoc($res))
                        { ?>
                        <tr>
                            <td class="align-middle"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt="" style="width: 50px;"></td>
                            <td class="align-middle"><?php echo $row['name'] ?> </td>
                            <td class="align-middle"><?php echo $row['mrp'] ?> </td>
                            <td class="align-middle"><?php echo $row['price'] ?></td>
                            <td class="align-middle"><a class="btn btn-sm " type="submit" href="wishlist.php?wish_id=<?php echo $row['id'] ?>" ><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a class="btn  btn-primary font-weight-bold my-3 py-3">Continue Shopping</a>
                <a href="checkout.php" style="float:right;" class="btn  btn-primary font-weight-bold my-3 py-3"> Checkout</a>
            </div>
            
    <!-- Cart End -->
    <script src="active.js"></script>

<?php
require('foot.php');
?>