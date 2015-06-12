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
    
    
    var append_email, getServiceSubCategories;    
    getServiceSubCategories = function(category_id) {
      return $.get(url_api_services_sub_category + "/" + category_id, function(data) {
        var model;
        model = $("#service_sub_category_id");
        model.empty();
        model.append("<option value=''></option>");
        $.each(data, function(index, element) {
          var selected;
          selected = (element.id === service_sub_category_id ? "selected = \"selected\"" : "");
          model.append("<option value='" + element.id + "' " + selected + ">" + element.name + "</option>");
        });
      });
    };
    if ($("#service_category_id").val() !== "") {    	
    	getServiceSubCategories($("#service_category_id").val());
    }
    $("#service_category_id").change(function() {
    	getServiceSubCategories($(this).val());
    });
    
});
