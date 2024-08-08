<?php
require('top.inc.php');
if(isset($_GET['type']) && $_GET['type']!='')
{
    $type=get_safe_value($con,$_GET['type']);
   if($type=='delete')
   
   {
    $id=get_safe_value($con,$_GET['id']);
    $delete_status="delete from users where id='$id'";
    mysqli_query($con,$delete_status);
   }
}
$sql="select* from users order by id asc";
$res=mysqli_query($con,$sql);
?>
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
                
                   
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Users</h6>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Date</th>
                                        <th scope="col"></th>
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
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['mobile']; ?></td>
                                        <td><?php echo $row['added_on']; ?></td>
                                        <td>
                                        <?php 
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