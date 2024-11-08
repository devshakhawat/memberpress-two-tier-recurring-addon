jQuery(function($){

    $('#mepr-product-billing-type, #_mepr_product_period_type-presets').on('change', function(){

        if( $(this).val() == 'recurring' ){
            console.log('recurring');
            
        }else{
            console.log('one-time');
            
        }

        if( $(this).val() == 'yearly' ){
            console.log('yearly');
            
        }else{
            console.log('others');
            
        }

    });
    

});