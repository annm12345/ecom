   <?php 
   require('top.php');
   $str=mysqli_real_escape_string($con,$_GET['str']);

if($str!='')
    {
        $get_product=get_product($con,'','','',$str,'','');
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
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Result for <?php echo $str ?></span></h2>
        <div class="row px-xl-5">
            <?php
                    foreach($get_product as $list) 
                    {?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a href="product.php?id=<?php echo $list['id']?>" >
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" style="width:150px;height:410px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="">
                        <div class="product-action">
                            
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?php echo $list['name'] ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?php echo $list['mrp'] ?></h5>
                            <h5 style="margin-left:20px;"><?php echo $list['price'] ?>Ks</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
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
    
    <!-- Products End -->
    <?php require('foot.php') ?>