<?php
require('top.inc.php');
if(isset($_GET['type']) && $_GET['type']!='')
{
    $type=get_safe_value($con,$_GET['type']);
   if($type=='status')
   {
    $operation=get_safe_value($con,$_GET['operation']);
    $id=get_safe_value($con,$_GET['id']);
    if($operation=='active')
    {
        $status='1';
    }
    else
    {
        $status='0';
    }
    $update_status="update categories set status='$status' where id='$id'";
    mysqli_query($con,$update_status);
   }
   if($type=='delete')
   {
    $id=get_safe_value($con,$_GET['id']);
    $delete_status="delete from categories where id='$id'";
    mysqli_query($con,$delete_status);
   }
}
$sql="select* from categories order by categories asc";
$res=mysqli_query($con,$sql);
?>
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
                
                   
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Categories</h6>
                            <h6 class="mb-4"><a href="manage_categories.php"> Add Categories</a></h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Categories</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    while($row=mysqli_fetch_Assoc($res)) 
                                    { ?> 
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['categories']; ?></td>
                                        <td>
                                        <?php 
                                         if($row['status']==1)
                                         {
                                            echo "<span style='background-color:#adff2f;padding:10px;border-radius:8px;'>
                                            <a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>&nbsp
                                            </span>";
                                         }
                                         else
                                         {
                                            echo "<span style='background-color:#dda0dd;padding:10px;border-radius:8px;'>
                                            <a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a>&nbsp
                                            </span>";
                                         }
                                         echo "<span style='background-color:blue;padding:10px;border-radius:8px;'>
                                         <a href='manage_categories.php?id=".$row['id']."'>Edit</a>
                                         </span>";
                                         echo "&nbsp;<span style='background-color:#ff0000;padding:10px;border-radius:8px;'>
                                         <a href='?type=delete&id=".$row['id']."'>Delete</a>
                                         </span>";
                                         ?>
                                         </td>
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