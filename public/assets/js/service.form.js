$(document).ready(function($) {
    // $('#add_service_category_box').toggle();
    $('#add_service_category').click(function() {
    	$('#add_service_category_box').toggle();
    	return false;
    });
    $('#add_service_category_cancel').click(function() {
    	$('#add_service_category_box').toggle();
    	return false;
    });
    
    $('#add_service_sub_category').click(function() {
    	$('#add_service_sub_category_box').toggle();
    	return false;
    });
    $('#add_service_sub_category_cancel').click(function() {
    	$('#add_service_sub_category_box').toggle();
    	return false;
    });
    
    $('#add_price_icon').click(function() {
    	$( "#price_table_body" ).append( $( "<tr><td>&nbsp;</td><td><input class=\"form-control inline\" placeholder=\"mins\" name=\"price[0][]\" type=\"text\"></td><td>&nbsp;</td><td><input class=\"form-control\" placeholder=\"$\" name=\"price[0][]\" type=\"text\"></td><td>&nbsp;</td><td><i class=\"fa fa-minus-circle fa-lg\"></i></td> </tr>" ) );
    });
    
    // $('.fa-minus-circle').on('click', (function(){
    $('#price_table_body').on('click', '.fa-minus-circle', (function(){
    	$(this).closest('tr').remove();
    }));
});
