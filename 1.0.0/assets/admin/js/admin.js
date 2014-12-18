jQuery(document).ready(function($) {
  $('#edd_time_enable').on('click', function() {
    var checked = $(this).attr('checked');
    if(checked == 'checked') {
      $('#edd_time_start').removeAttr('disabled');
      $('#edd_time_end').removeAttr('disabled');
    } else {
      $('#edd_time_start').attr('disabled', 'disable');
      $('#edd_time_end').attr('disabled', 'disable');
    }
  });
  $('#edd_time_start').timepicker();
  $('#edd_time_end').timepicker();
});
