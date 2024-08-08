<?php
require('top.inc.php');
$sub_categories='';
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=='')
{
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from sub_categories where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $row=mysqli_fetch_assoc($res);
        $categories=$row['categories_id'];
        $sub_categories=$row['sub_categories'];
    }
    else
    {
        ?>
        <script>
        window.location.href='sub_categories.php';
        </script>
        <?php
    }
    
}
if(isset($_POST['submit']))
{
    $categories=get_safe_value($con,$_POST['categories_id']);
    $sub_categories=get_safe_value($con,$_POST['sub_categories']);
    $res=mysqli_query($con,"select * from sub_categories where categories_id='$categories' and sub_categories='$sub_categories' ");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $msg="Sub Categories already exist";
    }
    else
    {
        if(isset($_GET['id']) && $_GET['id']!=='')
        {
            mysqli_query($con,"update sub_categories set categories_id='$categories',sub_categories='$sub_categories' where id='$id'");
            $msg="Sub Categories changing complete";
            ?>
            <script>
            window.location.href='sub_categories.php';
            </script>
            <?php
        }
        else
        {
            mysqli_query($con,"insert into sub_categories (`id`, `categories_id`, `sub_categories`, `status`) VALUES ('','$categories','$sub_categories','1') ");
            
            $msg="Sub Categories adding complete";
            ?>
            <script>
            window.location.href='sub_categories.php';
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
            <form action="" method="post">
            <div class="mb-3">
                <label for="categories" name="categories" class="form-label">Sub Categories</label>
                <select name="categories_id"  class="form-control" required>
                    <option value="">Select categories</option>
                    <?php
                    $res=mysqli_query($con,"select * from categories where status='1'");
                    while($row=mysqli_fetch_Assoc($res))
                    {
                        if($row['id']==$categories)
                        {
                            echo "<option value=".$row['id']." selected>".$row['categories']."</option>";
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
                <label name="" class="form-label">Sub Categories Name</label>
                <input name="sub_categories" class="form-control" type="text" placeholder="Enter Sub Categories name" require value="<?php echo $sub_categories?>">
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