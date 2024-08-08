function set_cupon(){
    var cupon_str=jQuery('#cupon_str').val();
    if(cupon_str!='')
    {
        jQuery('#coupon_result').html('');
        jQuery.ajax({
            url:'set.cupon.php',
            type:'post',
            data:'cupon_str='+cupon_str,
            success:function(result){
                var data=jQuery.parseJSON(result);
                if(data.is_error=='yes'){
                    jQuery('.cupon_box').hide();
                    jQuery('#coupon_result').html(data.dd);
                    jQuery('#order_total_price').html(data.result);
                }
                if(data.is_error=='no'){
                    jQuery('.cupon_box').show();
                    jQuery('#coupon_price').html(data.dd);
                    jQuery('#order_total_price').html(data.result);
                    
                }
            }

        })
    }
}