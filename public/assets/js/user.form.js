$(document).ready(function ($) {
    $('#userClub_id').multiselect();
    $("#admin_user_div").show('slow');

    $("input[name='user_type']").click(function () {
//    $('#show-me').css('display', ($(this).val() === 'a') ? 'block':'none');

        if ($(this).val() == "1") {
            
            $("#pa_user_div").css("display", "none");
            $("#admin_user_div").css("display", "block");

        } else if ($(this).val() == "2") {
          
            $("#pa_user_div").css("display", "block");
            $("#admin_user_div").css("display", "none");
        }
    });

});
