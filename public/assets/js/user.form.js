$(document).ready(function ($) {
    $('#userClub_id').multiselect();
    $("input[name='user_type']").click(function () {
        if ($(this).val() == "2") {
            var userDivType = "adminUser";
        } else if ($(this).val() == "7") {
            var userDivType = "paUser";
        }
        $.ajax({
            type: 'POST',
            url: '/user/getAccessDiv',
            data: {
                userDivType: userDivType
            },
            success: function (data) {
                $("#accessShowDiv").html(data);
            }
        });
    });

});
