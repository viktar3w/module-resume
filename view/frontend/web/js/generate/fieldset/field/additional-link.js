define([
  "Victor3w_Resume/js/generate/fieldset/field/common-field"
], function (Component) {
  "use strict"
  return Component.extend({
    defaults: {
      template: 'Victor3w_Resume/generate/fieldset/field/additional-link',
      additionalLinks: {},
      enableUrl: false,
      tracks: {
        additionalLinks: true,
        enableUrl: true
      }
    },
    enableLinkType: function (_, element) {
      this.enableUrl = element.target.value !== '';
      let name = this.enableUrl ? `resume[additions][${this.increment}][type]` : ''
      element.target.setAttribute('name', name)
    },
    /**
     * @return {string}
     */
    getClass: function () {
      return this.enableUrl
        ? "input-text validate-no-html-tags validate-url required-entry" : ""
    }
  })
})
