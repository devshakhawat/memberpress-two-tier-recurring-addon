jQuery(function($){

    let periodType = $('#_mepr_product_period_type-presets').val();
   

    if( $('#tt_payment').is(':checked') ) {
        $('.second_year_price').show();
    } else {
        $('.second_year_price').hide();
    }

    $( '#tt_payment' ).on( 'change', function() {
        if( $(this).is(':checked') ) {
            $('.second_year_price').show();                        
        } else {
            $('.second_year_price').hide();                        
        }
    });
    
    $('#_mepr_product_period_type-presets').on('change', function() {
    
        periodType = $(this).val();

        if(periodType == 'yearly') {
            $( '#mepr-recurring-options' ).find( '.mp_second_year' ).hide();
        } else {
            $( '#mepr-recurring-options' ).find( '.mp_second_year' ).hide();
        }
        
    });

});