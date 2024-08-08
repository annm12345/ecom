<?php
require('top.inc.php');
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=='')
{
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from categories where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $row=mysqli_fetch_assoc($res);
        $categories=$row['categories'];
    }
    else
    {
        ?>
        <script>
        window.location.href='categories.php';
        </script>
        <?php
    }
    
}
if(isset($_POST['submit']))
{
    $categories=get_safe_value($con,$_POST['categories']);
    $res=mysqli_query($con,"select * from categories where categories='$categories'");
    $check=mysqli_num_rows($res);
    if($check>0)
    {
        $msg="Categories already exist";
    }
    else
    {
        if(isset($_GET['id']) && $_GET['id']!=='')
        {
            mysqli_query($con,"update categories set categories='$categories' where id='$id'");
            $msg="Categories changing & adding complete";
        }
        else
        {
            mysqli_query($con,"insert into categories (categories,status) values ('$categories','1') ");
            $msg="Categories changing & adding complete";
        }
        ?>
        <script>
        window.location.href='categories.php';
        </script>
        <?php
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
                <label for="categories" name="categories" class="form-label">Categories</label>
                <input name="categories" class="form-control" type="text" placeholder="Enter categories name" require value="<?php echo $categories?>">
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