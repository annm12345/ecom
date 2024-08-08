   <?php 
   ob_start();
   require('top.php');
   $product_id=mysqli_real_escape_string($con,$_GET['id']);
   $get_product=get_product($con,'','',$product_id,'','','');
   
   ?>

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?php echo $get_product ['0']['name'] ?></span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <form action="">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" style="width:100px;height:500px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product ['0'] ['image'] ?>" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="manage_cart('<?php echo $product_id?>','add')"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="wish_cart('<?php echo $product_id?>','add')"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?php echo $get_product ['0']['name'] ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?php echo $get_product ['0']['mrp'] ?> MMK</h5> 
                            <h5 style="margin-left:20px;"><?php echo $get_product ['0']['price'] ?> MMK</h5>
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
                            <?php
                              $productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product ['0']['id']);
                              $soldqty=$get_product ['0']['qty'];
                              $pending_qty=$get_product ['0']['qty']-$productSoldQtyByProductId;
                              $cart_show='yes';
                              if($soldqty>$productSoldQtyByProductId)
                              {
                                $stock="In Stock";
                                
                              }
                              else
                              {
                                $stock="Not in Stock";
                                $cart_show='';
                              }
                            ?>
                            <h5><span>Avalability:</span><?php echo $stock ?>
                            </h5> 
                            
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                        <?php
                            if($cart_show !='')
                            {?>
                            <h5>Qty:
                                <select id="qty" class="form-control">
                                    <?php
                                    for($i=1;$i<=$pending_qty;$i++)
                                    {
                                        echo "<option>$i</option>";
                                    }
                                    ?>
                                    
                                </select>
                            </h5>
                            
                            <?php } ?> 
                        </div>
                        <h5><span id="qty_result"></span></h5>
                        <a href="#"><?php  $get_product ['0']['categories_id'] ?></a>
                        
                        <?php
                            if($cart_show !='')
                            {?>
                        <div>
                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $product_id?>','add')" class="btn btn-primary py-2 px-4">Add To Cart</a>
                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $product_id?>','add','yes')" class="btn btn-primary py-2 px-4" style="background-color:lightgreen;">Buy Now</a>
                        </div>
                        <?php } ?>
                        <div class="share_box">
                            <a href="http://facebook.com/share.php?url=<?php echo $meta_url ?>"><i class="fa-brands fa-facebook" style="color:blue"></i></a>
                            <a href="http://twitter.com/share?url=<?php echo $meta_url ?>&text=<?php echo $get_product ['0']['name'] ?>"><i class="fa-brands fa-twitter" style="color:#5DADE2"></i></a>
                            <a href="http://tiktok.com/share?text=<?php echo $get_product ['0']['name'] ?>"><i class="fa-brands fa-tiktok" style="color:black"></i></a>
                            <a href="http://viber.com/share?text=<?php echo $get_product ['0']['name'] ?>&url=<?php echo $meta_url ?>"><i class="fa-brands fa-viber" style="color:#8E44AD"></i></a>
                        </div>
                        <p class=" position-relative text-justify mx-xl-5 mb-4" style="margin-top:20px;"><b>Description:</b> <?php echo $get_product ['0'] ['description'] ?></p>
                    </div>
                </div>
                
                    
                </form>
            </div>

            <?php
            //unset($_COOKIE['recently_viewed']);
                if(isset($_COOKIE['recently_viewed'])) {
                    //pr(unserialize($_COOKIE['recently_viewed']));
                    $arrRecentview=unserialize($_COOKIE['recently_viewed']);
                    $arrRecentviewId=implode(",",$arrRecentview);
                    $res=mysqli_query($con,"select * from product where id IN ($arrRecentviewId)");
             ?>
                    
                    <div class="container-fluid pt-5 pb-3 float" style="width:100%;">
                        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Viewed</span></h2>
                        <div class="row px-xl-5">
                            <?php 
                            while($list=mysqli_fetch_assoc($res)){ ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 pb-1 flex" style="height:300px;">
                                <a href="product.php?id=<?php echo $list['id']?>" style="height:500px;border-radius:10px;" >
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden"  >
                                            <a class="text-decoration-none" href="product.php?id=<?php echo $list['id'] ?>">
                                                <img class="img-fluid w-100" style="width:150px;height:200px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list ['image'] ?>" alt="">
                                            </a>
                                            <div class="product-action " style="height:200px;">
                                                <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="wish_cart('<?php echo $list['id']?>','add')"><i class="far fa-heart"></i></p></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                            </div>
                                        
                                    </div>
                                        <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="product.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5><?php echo $list['mrp'] ?> MMK</h5>
                                            <h5 style="margin-left:20px;"><?php echo $list['price'] ?> MMK</h5>
                                        </div>
                                    </div>
                                    
                                </div>
                                </a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
            <?php 
            
            $arrRecent=unserialize($_COOKIE['recently_viewed']);
           if($key= array_search($product_id,$arrRecent)!==false){
                unset($arrRecent[$key]);
            }
            $arrRecent[]=$product_id;
            setcookie('recently_viewed',serialize($arrRecent),time()+60*60*24*365);
            }else{
            $arrRecent[]=$product_id;
            setcookie('recently_viewed',serialize($arrRecent),time()+60*60*24*365);
            } ?>
        </div>
    </div>
    <style>
        .share_box{
            margin-left:10px;
        }
        .fa-brands{
            padding:15px;
            font-size:40px;
        }
        .recent_form{
            
            margin-left:100px;
        }
        .flex{
            display:inline-flex;
        }
        .float{
            display:flex;
            float:right;
        }

    </style>
    <script src="active.js"></script>
    <script src="active_wish.js"></script>
    <!-- Products End -->
    <?php 
    require('foot.php');
    ob_flush();
     ?>