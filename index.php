   <?php require('top.php') ?>
   <!-- Carousel Start -->
   <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4" style=""><span class="bg-secondary pr-3">Best Seller</span></h2>
                <div class="row px-xl-5 pb-3">
                    <?php
                        $res=mysqli_query($con,"select * from product where best_seller=1");
                        while($row=mysqli_fetch_assoc($res))             
                        {?>
                    <div class=" col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <a class="text-decoration-none" href="product.php?id=<?php echo $row['id'] ?>">
                                <div class="cat-item d-flex align-items-center mb-4">
                                    <div class="product-img position-relative overflow-hidden"  style="width:250px;height:200px;">
                                    <a class="text-decoration-none" href="product.php?id=<?php echo $row['id'] ?>">
                                        <img class="img-fluid w-100" style="width:250px;height:200px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row ['image'] ?>" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="manage_cart('<?php echo $row['id']?>','add')"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="wish_cart('<?php echo $row['id']?>','add')"><i class="far fa-heart"></i></p></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                        </div>
                                    </a>
                                    </div>
                                    <a class="text-decoration-none" href="product.php?id=<?php echo $row['id'] ?>">
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="product.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5><?php echo $row['mrp'] ?> MMK</h5>
                                            <h5 style="margin-left:20px;"><?php echo $row['price'] ?> MMK</h5>
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
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> 
                    <?php } ?>           
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
   
   <!-- Categories Start -->
   <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            <?php
                    $get_product=get_product($con,'','','','','','');
                    foreach($get_product as $list)
                    {?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <a class="text-decoration-none" href="product.php?id=<?php echo $list['id'] ?>">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="product-img position-relative overflow-hidden"  style="width:250px;height:200px;">
                            <a class="text-decoration-none" href="product.php?id=<?php echo $list['id'] ?>">
                                <img class="img-fluid w-100" style="width:250px;height:200px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list ['image'] ?>" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="javascript:void(0)" onclick="wish_cart('<?php echo $list['id']?>','add')"><i class="far fa-heart"></i></p></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </a>
                            </div>
                            <a class="text-decoration-none" href="product.php?id=<?php echo $list['id'] ?>">
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
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            </div> 
            <?php } ?>           
        </div>
    </div>
    <script src="active.js"></script>
    <script src="active_wish.js"></script>
    <!-- Categories End -->
    
    
    <?php require('foot.php') ?>