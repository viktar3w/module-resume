define([
  "Victor3w_Resume/js/generate/fieldset/field/common-field"
], function (Component) {
  "use strict"
  return Component.extend({
    defaults: {
      template: 'Victor3w_Resume/generate/fieldset/field/language',
      enableLevel: false,
      tracks: {
        enableLevel: true
      }
    },
    enableLanguageLevel: function (_, element) {
      this.enableLevel = element.target.value.length >= 2;
      let name = this.enableLevel ? `resume[languages][${this.increment}][name]` : ''
      element.target.setAttribute('name', name)
    },
    /**
     * @return {string}
     */
    getClass: function () {
      return this.enableLevel ? "input-text validate-length maximum-length-50 validate-no-html-tags" : ""
    }
  })
})
