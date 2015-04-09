var checkColumnsSelected;

checkColumnsSelected = void 0;

$('.infinite-div').infinitescroll({
  loading: {
    msgText: "<em>Loading the next set of rows...</em>",
    finishedMsg: '<em>End</em>'
  },
  navSelector: '.paginate_links',
  nextSelector: '.paginate_links a:first',
  itemSelector: '.infinite-table',
  path: function(index) {
    return current_url + '&page=' + index;
  }
});

$('#table-actions').toggle($('.select-id').checked);

$(document).on('change', '#select-all', function() {
  $('.select-id').prop('checked', this.checked);
  return $('#table-actions').toggle(this.checked);
});

$(document).on('change', '.select-id', function() {
  var selectedexists;
  selectedexists = void 0;
  selectedexists = $('input[class^=\'select-id\']:checkbox:checked').map(function() {
    return $(this).val();
  }).get();
  if (selectedexists.length === 0) {
    $('#table-actions').hide();
    $('#select-all').prop('checked', false);
  } else {
    $('#table-actions').show();
  }
});

checkColumnsSelected = function() {
  if ($('#column_settings_form').closest('form').find('input:checkbox:checked').length > 0) {
    return true;
  } else {
    alert('Please select atleast one column for Display');
    return false;
  }
};

$('#delete-records').submit(function() {
  var x;
  x = void 0;
  x = void 0;
  x = confirm('Are you sure you want to delete?');
  if (x) {
    $('.select-id').appendTo('#delete-records');
    return true;
  } else {
    $('#select-all').focus();
    return false;
  }
});

$('#download-records').submit(function() {
  var selectedexists;
  selectedexists = void 0;
  selectedexists = $('input[class^=\'select-id\']:checkbox:checked').map(function() {
    return $(this).val();
  }).get();
  $('#hdn_downloads').val(selectedexists);
  return true;
});

$('#column_settings_form').submit(function() {
  return checkColumnsSelected;
});
