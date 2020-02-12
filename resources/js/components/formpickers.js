(function($) {
  'use strict';
  if ($("#datepicker-popup").length) {
      $.each($('#datepicker-popup'), function(){
          $(this).datepicker({
              enableOnReadonly: true,
              todayHighlight: true,
              format: 'dd/mm/yyyy',
              weekStart:1,
          });
      });
  }
  if ($("#inline-datepicker").length) {
      $.each($('#inline-datepicker'), function(){
          $(this).datepicker({
              enableOnReadonly: true,
              todayHighlight: true,
          });
      });
  }
  if ($(".datepicker-autoclose").length) {
    $('.datepicker-autoclose').datepicker({
      autoclose: true
    });
  }
  if ($('input[name="date-range"]').length) {
    $('input[name="date-range"]').daterangepicker();
  }
  if ($('input[name="date-time-range"]').length) {
    $('input[name="date-time-range"]').daterangepicker({
      timePicker: true,
      timePickerIncrement: 10,
      locale: {
        format: 'DD/MM/YYYY h:mm A'
      },
      weekStart:1,

    });
  }
})(jQuery);
