define([
  "uiElement",
], function (Component) {
  "use strict"
  return Component.extend({
    defaults: {
      show: false,
      increment: 1,
      tracks: {
        show: true,
        increment: true
      }
    },
    remove: function () {
      this.show = false
    }
  })
});
