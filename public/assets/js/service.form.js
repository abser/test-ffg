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
});
