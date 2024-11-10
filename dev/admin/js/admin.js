jQuery(function($){

    let billingType = $('#mepr-product-billing-type').val();
    let periodType = $('#_mepr_product_period_type-presets').val();

    if( billingType === 'recurring' && periodType === 'yearly' ) {
        $('.mp_second_year').show();
    }

    $('#mepr-product-billing-type, #_mepr_product_period_type-presets').on( 'change', function() {
        billingType = $('#mepr-product-billing-type').val();
        periodType  = $('#_mepr_product_period_type-presets').val();

        if( billingType === 'recurring' && periodType === 'yearly' ) {
            $('.mp_second_year').show();
        } else {
            $('.mp_second_year').hide();
        }
        
    })
    
    if( $('#tt_payment').is(':checked') ) {
        $('.second_year_price').show();
    }

    $( '#tt_payment' ).on( 'change', function() {
        if( $(this).is(':checked') ) {
            $('.second_year_price').show();                        
        } else {
            $('.second_year_price').hide();                        
        }
    });

});