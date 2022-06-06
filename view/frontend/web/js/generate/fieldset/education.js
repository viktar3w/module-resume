define([
  "uiComponent",
  "Victor3w_Resume/js/generate/fieldset/field/education"
], function (Component, Education) {
  "use strict"
  return Component.extend({
    defaults: {
      educationBoxes: [],
      increment: 1,
      tracks: {
        educationBoxes: true,
        increment: true,
      }
    },
    initialize: function (config) {
      this._super(config)
      this.addEducationBox()
      return this
    },
    addEducationBox: function () {
      this.educationBoxes.push(new Education({
        show: true,
        increment: this.increment
      }))
      this.increment++
    }
  })
});
