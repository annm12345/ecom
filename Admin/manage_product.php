<?php
require('top.inc.php');
$categories_id='';
$sub_categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$image_required='required';
$best_seller='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=='')
{
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from product where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $row=mysqli_fetch_assoc($res);
        $categories_id=$row['categories_id'];
        $sub_categories_id=$row['sub_categories_id'];
        $name=$row['name'];
        $mrp=$row['mrp'];
        $price=$row['price'];
        $qty=$row['qty'];
        $image=$row['image'];
        $short_desc=$row['short_desc'];
        $description=$row['description'];
        $meta_title=$row['meta_title'];
        $meta_desc=$row['meta_desc'];
        $meta_keyword=$row['meta_keyword'];
        $best_seller=$row['best_seller'];
    }
    else
    {
        header('location:product.php');
    }
    
}
if(isset($_POST['submit']))
{
    $categories_id=get_safe_value($con,$_POST['categories_id']);
    $sub_categories_id=get_safe_value($con,$_POST['sub_categories_id']);
    $name=get_safe_value($con,$_POST['name']);
    $mrp=get_safe_value($con,$_POST['mrp']);
    $price=get_safe_value($con,$_POST['price']);
    $qty=get_safe_value($con,$_POST['qty']);
    //$image=get_safe_value($con,$_POST['image']);
    $short_desc=get_safe_value($con,$_POST['short_desc']);
    $description=get_safe_value($con,$_POST['description']);
    $meta_title=get_safe_value($con,$_POST['meta_title']);
    $meta_desc=get_safe_value($con,$_POST['meta_desc']);
    $meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
    $best_seller=get_safe_value($con,$_POST['best_seller']);
    $res=mysqli_query($con,"select * from product where name='$categories_id'");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $msg="Product already exist";
    }
    else
    {
        if(isset($_GET['id']) && $_GET['id']!=='')
        {
            if($_FILES['image']['name']!='')
            {
                $image=rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
                $update_sql="update product set categories_id='$categories_id',sub_categories_id='$sub_categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',
                meta_keyword='$meta_keyword',best_seller='$best_seller' where id='$id'";
            }
            else
            {
                $update_sql="update product set categories_id='$categories_id',sub_categories_id='$sub_categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller' where id='$id'";
            }
            mysqli_query($con,$update_sql);
            $msg="Product changing complete";
            ?>
            <script>
                window.location.href='product.php';
            </script>
            <?php
        }
        else
        {
            $image=rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
            mysqli_query($con,"insert into product (categories_id,name,mrp,price,qty,image,short_desc,description,meta_title,meta_desc,meta_keyword,best_seller) values ('$categories_id','$name','$mrp','$price','$qty','$image','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','$best_seller') ");
            $msg="Product adding complete";
            ?>
            <script>
                window.location.href='product.php';
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
            <h6 class="mb-4">Categories</h6>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="categories_id" name="categories_id" class="form-label">Products</label>
                <select name="categories_id" class="form-control">
                    <option value="">Enter Categories name</option>
                        <?php
                            $res=mysqli_query($con,"select id,categories from categories order by categories asc");
                            while($row=mysqli_fetch_assoc($res))
                            {
                                if($row['id']==$categories_id)
                                {
                                    echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                }
                                else
                                {
                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                }
                                
                            }
                        ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="sub_categories_id" name="sub_categories_id" class="form-label">Products</label>
                <select name="sub_categories_id" class="form-control">
                    <option value="">Enter Sub Categories name</option>
                        <?php
                            $res=mysqli_query($con,"select id,sub_categories from sub_categories where categories_id='$categories_id' and status='1'");
                            if(mysqli_num_rows($res)>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    echo "<option selected value=".$row['id'].">".$row['sub_categories']."</option>";
                                }
                            }else
                            {
                                $cat=mysqli_query($con,"select id,sub_categories from sub_categories where status='1'");
                                while($row=mysqli_fetch_assoc($cat))
                                {
                                    echo "<option value=".$row['id'].">".$row['sub_categories']."</option>";
                                }
                            }
                        ?>
                </select>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product Name</label>
                <input name="name" class="form-control" type="text" placeholder="Enter product name" require value="<?php echo $name?>">
            </div>
            <div class="mb-3">
                <label for="categories_id" name="categories_id" class="form-label">Best Seller</label>
                <select name="best_seller" class="form-control" required>
                    <option value="">Select</option>
                    <?php
                        if($best_seller==1)
                        {
                            echo '<option value="1" selected>Yes</option>
                            <option value="0">No</option>';
                        }elseif($best_seller==0){
                            echo '<option value="1">Yes</option>
                            <option value="0" selected>No</option>';
                        }
                        else{
                            echo '<option value="1">Yes</option>
                            <option value="0">No</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product mrp</label>
                <input name="mrp" class="form-control" type="text" placeholder="Enter product mrp" require value="<?php echo $mrp?>">
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product price</label>
                <input name="price" class="form-control" type="text" placeholder="Enter product price" require value="<?php echo $price?>">
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product quantity</label>
                <input name="qty" class="form-control" type="text" placeholder="Enter product quantity" require value="<?php echo $qty?>">
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product image</label>
                <input name="image" class="form-control" type="file" placeholder="Enter product image" <?php echo $image_required ?>>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product short_desc</label>
                <textarea name="short_desc" class="form-control" placeholder="Enter Product short_desc" required><?php echo $short_desc?></textarea>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product description</label>
                <textarea name="description" class="form-control" placeholder="Enter Product description" required><?php echo $description?></textarea>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product meta_title</label>
                <textarea name="meta_title" class="form-control" placeholder="Enter Product meta_title" required ><?php echo $meta_title?></textarea>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product meta_desc</label>
                <textarea name="meta_desc" class="form-control" placeholder="Enter Product meta_desc" required ><?php echo $meta_desc?></textarea>
            </div>
            <div class="mb-3">
                <label name="" class="form-label">Product meta_keyword</label>
                <textarea name="meta_keyword" class="form-control" placeholder="Enter Product meta_keyword" ><?php echo $meta_keyword?></textarea>
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