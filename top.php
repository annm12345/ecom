<?php
require('connection.inc.php');
require('function.inc.php');
require('add_to_cart.inc.php');
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc ");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res))
{
    $cat_arr[]=$row;
}

$obj=new add_to_cart();
$totalproduct=$obj->totalproduct();

if(isset($_SESSION['USER_LOGIN']))
{
    if(isset($_GET['wish_id']))
    {
        $wid=$_GET['wish_id'];
        $uid=$_SESSION['USER_ID'];
        mysqli_query($con,"DELETE FROM `wishlist` WHERE id='$wid' and user_id='$uid'");
    }
    $uid=$_SESSION['USER_ID'];
    $wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid' "));
}

$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];

$meta_tile="My Ecom Website";
$meta_desc="My Ecom Website";
$meta_keyword="My Ecom Website";
$meta_url=SITE_PATH;
$meta_image="";
if($mypage=='categories.php' || $mypage=='sub_categories.php'){
    $cid=get_safe_value($con,$_GET['id']);;
    $categories_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from categories where id='$cid'"));
    $meta_tile=$categories_meta['categories'];
}
if($mypage=='product.php'){
$pid=get_safe_value($con,$_GET['id']);;
$product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$pid'"));
$meta_tile=$product_meta['meta_title'];
$meta_desc=$product_meta['meta_desc'];
$meta_keyword=$product_meta['meta_keyword'];
$meta_url=SITE_PATH."product.php?id=".$pid;
$meta_image=PRODUCT_IMAGE_SITE_PATH.$product_meta['image'];
}

if($mypage=='contact.php')
{
    $meta_tile="Contact Us";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $meta_tile ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo $meta_keyword ?>" name="keywords">
    <meta content="<?php echo $meta_desc ?>" name="description">
    <meta property="og:title" content="<?php echo $meta_tile ?>">
    <meta property="og:image" content="<?php echo $meta_image ?>">
    <meta property="og:url" content="<?php echo $meta_url ?>">
    <meta property="og:site_name" content="<?php echo SITE_PATH ?>">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .bedge
        {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="search.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products" name="str">
                        <div class="input-group-append">
                            <button type="submit" class="form-control" >
                                <span class="input-group-text bg-transparent text-primary" style="border:none;">
                                <i class="fa fa-search"></i>
                            </span>
                            </button>
                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
      <!-- Navbar Start -->
      <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <?php
                            foreach($cat_arr as $list)
                            {?>
                            <div class="nav-item dropdown">
                                <a href="categories.php?id=<?php echo $list['id']?>" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $list['categories']?></a>
                                <?php
                                    $cat_id=$list['id'];
                                    $sub_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
                                    if(mysqli_num_rows($sub_res)>0)
                                    { ?>
                                        <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                           <?php 
                                           while($sub_row=mysqli_fetch_assoc($sub_res))
                                            {
                                                echo '<a href="categories.php?id='.$list['id'].'&sub_categories='.$sub_row['id'].'" class="dropdown-item">'.$sub_row['sub_categories'].'</a>';
                                            }
                                            
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="nav-item dropdown">
                                <a href="checkout.php" class="nav-link " >Shop </i></a>
                            </div>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="wishlist.php" class="btn px-0 ml-3">
                                <?php
                                if(isset($_SESSION['USER_ID']))
                                { ?>
                                <i class="fas fa-heart text-primary"></i>
                                <a href="wishlist.php"><span class="bedge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $wishlist_count ?></span></a>
                                <?php } ?>
                            </a>
                            <?php
                                if(isset($_SESSION['USER_LOGIN']))
                                {
                                $uid=$_SESSION['USER_ID'];
                                $row=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$uid'"));
                                if($row['id'] == $uid)
                                { ?>
                            <a href="cart.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <a href="cart.php"><span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $totalproduct ?></span></a>
                            </a>
                            <?php }} ?>
                        </div>
                        
                        <?php if(isset($_SESSION['USER_LOGIN']))
                        {
                            $uid=$_SESSION['USER_ID'];
                            $row=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$uid'"));
                        ?><p style="color:gold;margin-top:17px;margin-left:13px;"><?php echo $row['name'] ?></p>
                        <?php
                        }
                        ?>
                        <?php if(isset($_SESSION['USER_LOGIN']))
                        {
                            echo '<a href="logout.php" class="nav-item nav-link">Logout</a>  <a href="my_order.php" class="nav-item nav-link">My Order</a>' ;
                        }
                        else
                        {
                           echo '<a href="login.php" class="nav-item nav-link">Login | Register</a>';
                        }
                        ?>
                        
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    