function wish_cart(pid,type){
    jQuery.ajax({
        url:'wishlist_manage.inc.php',
        type:'post',
        data:'pid='+pid+'&type='+type,
        success:function(result)
        {
            if(result=='nologin')
            {
                window.location.href='login.php';
            }
            
                jQuery('.bedge').html(result);
            
        }
    });
}