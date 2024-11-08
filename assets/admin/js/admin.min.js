// jQuery(function($){

//     let periodType = $('#_mepr_product_period_type-presets').val();
//     add_field( periodType );
//     $('#_mepr_product_period_type-presets').on('change', function() {
       
//         periodType = $(this).val();

//         if(periodType == 'yearly') {
//             add_field( periodType );
//         } else {
//             $( '#mepr-recurring-options' ).find( '.mp_second_year' ).remove();
//         }
        
//     });

//     function add_field( periodType ) {

//         if (periodType == 'yearly') {
            
//             $( '#mepr-recurring-options' ).append( '<div class="mp_second_year"><p><strong>Second Year Price ($):</strong></p><p><input name="mepr_tt_product_price" id="mepr_tt_product_price" type="text" value=""></p></div>' );
            
//         }
//     }
    
// });