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
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Update</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        foreach($_SESSION['cart']as $key=>$val){
                            $productArr=get_product($con,'','',$key,'','','','');
                            $pname=$productArr ['0'] ['name'];
                            $mrp=$productArr ['0'] ['mrp'];
                            $price=$productArr ['0'] ['price'];
                            $image=$productArr ['0'] ['image'];
                            $qty=$val['qty'];
                       
                        ?>
                        <tr>
                            <td class="align-middle"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" alt="" style="width: 50px;"></td>
                            <td class="align-middle"><?php echo $pname ?> </td>
                            <td class="align-middle"><?php echo $mrp ?> </td>
                            <td class="align-middle"><?php echo $price ?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="<?php echo $key ?>qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $qty ?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?php echo $qty*$price ?></td>
                            <td class="align-middle"><button class="btn btn-sm " type="submit" href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')"><i class="fa-solid fa-cart-plus"></i></button></td>
                            <td class="align-middle"><button class="btn btn-sm " type="submit" href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="fa-solid fa-trash"></i></button></td>
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