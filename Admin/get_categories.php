<?php
require('connection.inc.php');
require('function.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!='')
{

}
else
{
    header('location:login.php');
    
}
$categories_id=get_safe_value($con,$_GET['categories_id']);
$res=mysqli_query($con,"select id,sub_categories from sub_categories where categories_id='$categories_id'");
    if(mysqli_num_rows($res)>0)
    {
        $html='';             
        while($row=mysqli_fetch_assoc($res))
        {
            $html.="<option selected value=".$row['id'].">".$row['sub_categories']."</option>";
            
        }
        echo $html;
    }
    else
    {
       echo "<option >No Sub categories Found</option>";
    }
?>