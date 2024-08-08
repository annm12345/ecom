        
        function send_message()
        {
            var name=jQuery("#name").val();
            var email=jQuery("#email").val();
            var mobile=jQuery("#mobile").val();
            var message=jQuery("#message").val();
            var is_error="";

            if(name=="")
            {
                alert('please enter name');
                is_error="";
            }
            else if(email=="")
            {
                alert('please enter email');
                is_error="";
            }
            else if(mobile=="")
            {
                alert('please enter mobile');
                is_error="";
            }
            else if(message=="")
            {
                alert('please enter message');
                is_error="";
            }
            else
            {
                jQuery.ajax({
                    url:'send_message.php',
                    type:'post',
                    data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
                    success:function(result)
                    {
                        alert('Thank you for your message');
                    }
                });
            }
        }
    function manage_cart(pid,type,checkout){
        jQuery('#qty_result').html('');
        if(type=='update'){
            var qty=jQuery("#"+pid+"qty").val();
        }
        else{
            var qty=jQuery('#qty').val();
        }
        
        jQuery.ajax({
            url:'manage_cart.php',
            type:'post',
            data:'pid='+pid+'&qty='+qty+'&type='+type,
            success:function(result)
            {
                if(type=='update' || type=='remove')
                {
                    window.location.href=window.location.href;
                }
                
                if(result!='not available')
                {
                    if(checkout=='yes')
                    {
                        window.location.href="checkout.php";
                    }
                    jQuery('.badge').html(result);
                    
                }else{

                }
            }
        });
    }
    