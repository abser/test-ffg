$(document).ready(function($) {
    var append_email, getRegions;    
    getRegions = function(country) {
      return $.get(url_api_regions + "/" + country, function(data) {
        var model;
        model = $("#region");
        model.empty();
        model.append("<option value=''></option>");
        $.each(data, function(index, element) {
          var selected;
          selected = (element.id === region_id ? "selected = \"selected\"" : "");
          model.append("<option value='" + element.id + "' " + selected + ">" + element.name + "</option>");
        });
      });
    };
    if ($("#country").val() !== "") {    	
      getRegions($("#country").val());
    }
    $("#country").change(function() {
      getRegions($(this).val());
    });
});
