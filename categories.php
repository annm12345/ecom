   <?php 
   require('top.php');
   $cat_id=mysqli_real_escape_string($con,$_GET['id']);
   $sub_categories='';

   if(isset($_GET['sub_categories']))
   {
    $sub_categories=mysqli_real_escape_string($con,$_GET['sub_categories']);
   }
   if(isset($_GET['sort']))
   {
    $sort=mysqli_real_escape_string($con,$_GET['sort']);
    if(sort=="price_high")
    {
        $sort_order=" order by product.price desc";
    }
   }

   if($cat_id>0)
    {
        $get_product=get_product($con,'',$cat_id,'','','',$sub_categories);
    }else
    { ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php }
   
   
   ?>
    
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <?php if(count($get_product)>0) { ?>
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Categories</span></h2>
        <div class="row px-xl-5">
            
            <?php
                    foreach($get_product as $list) 
                    {?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1" style="height:700px;">
                <a href="product.php?id=<?php echo $list['id']?>" style="height:500px;border-radius:10px;" >
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden"  style="height:600px;">
                            <a class="text-decoration-none" href="product.php?id=<?php echo $list['id'] ?>">
                                <img class="img-fluid w-100" style="width:300px;height:500px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list ['image'] ?>" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="wish_cart('<?php echo $list['id']?>','add')"><i class="far fa-heart"></i></p></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </a>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="product.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?php echo $list['mrp'] ?> MMK</h5>
                            <h5 style="margin-left:20px;"><?php echo $list['price'] ?> MMK</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <input type="hidden" id="qty" value="1">
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php }
            else{
                echo "Data not found"; 
            }?>
    </div>
    <script src="active.js"></script>
    <script src="active_wish.js"></script>
    <!-- Products End -->
    <?php require('foot.php') ?> 
    