<?php
require('top.inc.php');
$cupon_code='';
$cupon_type='';
$cupon_value='';
$cart_min_value='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=='')
{
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from cupon where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $row=mysqli_fetch_assoc($res);
        $cupon_code=$row['cupon_code'];
        $cupon_type=$row['cupon_type'];
        $cupon_value=$row['cupon_value'];
        $cart_min_value=$row['cart_min_value'];
    }
    else
    {
        header('location:cupon.php');
    }
    
}
if(isset($_POST['submit']))
{
    $cupon_code=get_safe_value($con,$_POST['cupon_code']);
    $cupon_type=get_safe_value($con,$_POST['cupon_type']);
    $cupon_value=get_safe_value($con,$_POST['cupon_value']);
    $cart_min_value=get_safe_value($con,$_POST['cart_min_value']);
    $res=mysqli_query($con,"select * from cupon where cupon_code=''");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $msg="Cupon code already exist";
    }
    else
    {
        if(isset($_GET['id']) && $_GET['id']!=='')
        {
           
            $update_sql="UPDATE `cupon` SET `id`='$id',`cupon_code`='$cupon_code',`cupon_value`='$cupon_value',`cupon_type`='$cupon_type',`cart_min_value`='$cart_min_value',`status`='1' WHERE id='$id'";
            mysqli_query($con,$update_sql);
            $msg="Cupon changing complete";
            ?>
            <script>
                window.location.href='cupon.php';
            </script>
            <?php
        }
        else
        {
            mysqli_query($con,"INSERT INTO `cupon`(`id`, `cupon_code`, `cupon_value`, `cupon_type`, `cart_min_value`, `status`) VALUES ('','$cupon_code','$cupon_value','$cupon_type','$cart_min_value','1') ");
            $msg="Product adding complete";
            ?>
            <script>
                window.location.href='cupon.php';
            </script>
            <?php
        }
    }   
}


?>
 <!-- Form Start -->
 <div class="container-fluid pt-4 px-4">
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Cupon</h6>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label name="" class="form-label">Cupon Code</label>
                <input name="cupon_code" class="form-control" type="text" placeholder="Enter Cupon Code" require value="<?php echo $cupon_code?>">
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Cupon Value</label>
                <input name="cupon_value" class="form-control" type="text" placeholder="Enter Cupon Value" require value="<?php echo $cupon_value?>">
            </div>
            <div class="mb-3">
                <label for="categories_id" name="" class="form-label">Cupon Type</label>
                <select name="cupon_type" class="form-control" required>
                    <option value="">Select</option>
                    <?php
                        if($cupon_type=='percentage')
                        {
                            echo '<option value="percentage" selected>Percentage</option>
                            <option value="mmk">MMK</option>';
                        }elseif($cupon_type=='mmk'){
                            echo '<option value="percentage">Percentage</option>
                            <option value="mmk" selected>MMK</option>';
                        }
                        else{
                            echo '<option value="percentage">Percentage</option>
                            <option value="mmk">MMK</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Cart Minimum Value </label>
                <input name="cart_min_value" class="form-control" type="text" placeholder="Enter Cart Minnimum value" require value="<?php echo $cart_min_value?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Add </button>
            <div style="color:red;">
            <?php echo $msg; ?>
            </div>
            </form>
    </div>
                    
<?php
require('footer.inc.php');
?>