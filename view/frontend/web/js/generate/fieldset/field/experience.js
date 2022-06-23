define([
  "jquery",
  "Victor3w_Resume/js/generate/fieldset/field/common-field",
  "mage/translate",
  "jquery-ui-modules/datepicker"
], function ($, Component, $t) {
  "use strict"
  return Component.extend({
    defaults: {
      template: 'Victor3w_Resume/generate/fieldset/field/experience'
    },
    initCalendar: function () {
      $(document).ready(function () {
        $('.datepicker').datepicker({
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          currentText: $t('Go Today'),
          closeText: $t('Close'),
          showWeek: true,
          dateFormat: 'yy-mm-dd',
          yearRange: `${(new Date).getFullYear() - 40}:${(new Date).getFullYear()}`
        })
      })
    }
  })
});
