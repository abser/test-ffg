var extractLast, split;

$(document).foundation({
  abide: {
    validators: {
      filesize: function(el, required, parent) {
        var size, valid;
        size = el.value ? el.files[0].size : 0;
        valid = size < 2000000;
        return valid;
      },
      lessThan: function(el, required, parent) {
        var other_num, this_num;
        other_num = document.getElementById(el.getAttribute(this.add_namespace('data-lessthan'))).value;
        this_num = el.value;
        if (this_num !== '' && !$.isNumeric(this_num)) {
          return false;
        }
        if ($.isNumeric(this_num) && $.isNumeric(other_num)) {
          return parseInt(this_num) <= parseInt(other_num);
        }
        return true;
      },
      greaterThan: function(el, required, parent) {
        var other_num, this_num;
        other_num = document.getElementById(el.getAttribute(this.add_namespace('data-greaterthan'))).value;
        this_num = el.value;
        if (this_num !== '' && !$.isNumeric(this_num)) {
          return false;
        }
        if ($.isNumeric(this_num) && $.isNumeric(other_num)) {
          return parseInt(this_num) >= parseInt(other_num);
        }
        return true;
      }
    },
    patterns: {
      sprim_phone: /^[0-9- +]*$/,
      email: /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      blood_pressure: /^\d{1,3}\/\d{1,3}$/,
      decimal: /^\d+(\.\d{1,2})?$/
    }
  }
});

$("form[data-confirm]").submit(function() {
  if (!confirm($(this).attr("data-confirm"))) {
    return false;
  }
});

$("body").on("click", ".delete_photo", function(e) {
  var id, msg;
  msg = "Are you really sure you want to delete this photo?";
  if (!confirm(msg)) {
    return false;
  }
  id = $(this).attr("id");
  $("#delete_photo input[name='photo']").val(id);
  $("#delete_photo").submit();
});

split = function(val) {
  return val.split(/;\s*/);
};

extractLast = function(term) {
  return split(term).pop();
};

$(".jqte").jqte();

$("body").on("click", ".removeclass", function(e) {
  $(this).parent("div").parent("div").remove();
  return false;
});

if (!is_logged_in) {
  $('form#top-nav-login').submit(function() {
    $('#validation-errors').html('');
    $.ajax({
      url: $('form#top-nav-login').attr('action'),
      type: 'post',
      cache: false,
      dataType: 'json',
      data: $('form#top-nav-login').serialize(),
      success: function(data) {
        var arr;
        if (data.success === false) {
          arr = data.errors;
          $.each(arr, function(index, value) {
            if (value.length !== 0) {
              $('#validation-errors').append('<div class="alert alert-error"><strong>' + value + '</strong><div>');
            }
          });
          $('#validation-errors').show();
        } else {
          if (data.subdomain) {
            window.location.href = data.subdomain;
          } else {
            location.reload();
          }
        }
      },
      error: function(xhr, textStatus, thrownError) {
        alert('Something went to wrong.Please Try again later...');
      }
    });
    return false;
  });
}

$('.datepicker').datetimepicker({
  inline: false,
  lang: 'en',
  timepicker: false,
  format: date_format,
  scrollMonth: false
});
