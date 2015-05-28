$(document).ready(function($) {
	
	
	
	// $('#conjunct_box').toggle(!$('#is_conjunct').is(':checked'));
    $('#is_conjunct').click(function() {
    	$('#conjunct_box').toggle();
    	$('#conjunct').multiselect();
    	return false;
    });    
});
