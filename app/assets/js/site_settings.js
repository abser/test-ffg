$(function() {
  $('#sortable-fields').sortable({
    placeholder: 'ui-state-highlight',
    revert: true,
    stop: function(event, ui) {
      if (ui.item.hasClass('draggable')) {
        ui.item.removeClass('draggable');
        ui.item.append('<input type="text" name="lbl_' + ui.item.attr('data-field') + '" id= "lbl_' + ui.item.attr('data-field') + '" route= "' + ui.item.attr('route') + '" params= "' + ui.item.attr('params') + '" access= "' + ui.item.attr('access') + '"  value="' + ui.item.attr('label') + '"/>' + '<a href="#" class="right delete_list" data-field="' + ui.item.attr('data-field') + '">remove</a>');
        $('div[data-field=\'' + ui.item.attr('data-field') + '\']').draggable({
          disabled: 'true'
        });
      }
    }
  });
  $('.draggable').draggable({
    connectToSortable: '#sortable-fields',
    helper: 'clone',
    revert: 'invalid',
    snap: 'true'
  });
  $('ul, li').disableSelection();
  $(document.body).on('click', '.delete_list', function() {
    $(this).closest('div').remove();
    $('div[data-field=\'' + $(this).attr('data-field') + '\']').draggable('enable');
  });
  $('#site_setting').submit(function(event) {
    var fields;
    fields = [];
    $('#sortable-fields').find('div').each(function(n) {
      var x;
      x = [];
      fields[n] = new Array($(this).children('input:text').attr('route') + ':' + $(this).children('input:text').val() + ':' + $(this).children('input:text').attr('params') + ':' + $(this).children('input:text').attr('access'));
    });
    $('[name="sitemenu"]').val(fields);
  });
});
