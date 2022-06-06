define([
  "jquery",
  "uiComponent",
  "Victor3w_Resume/js/generate/fieldset/field/experience",
  "Victor3w_Resume/js/generate/fieldset/field/skill",
  "mage/validation"
], function ($, Component, Experience, Skill) {
  "use strict"
  return Component.extend({
    defaults: {
      experienceBoxes: [],
      skillBoxes: [],
      increment: 1,
      tracks: {
        experienceBoxes: true,
        increment: true,
        skillBoxes: true
      }
    },
    initialize: function (config) {
      this._super(config)
      this.addExperienceBox()
      return this
    },
    addExperienceBox: function () {
      this.experienceBoxes.push(new Experience({
        show: true,
        increment: this.increment
      }))
      this.increment++
    },
    addSkill: function () {
      let skill = $('#skill')
      if (!this.validateSkill(skill[0]) || !skill.val()) {
        return
      }
      this.skillBoxes.push(new Skill({
        show: true,
        value: skill.val(),
        increment: this.increment
      }))
      this.increment++
      skill.val('')
    },

    /**
     * @param {Element} $skill
     */
    validateSkill: function ($skill) {
      let form = $('[name="resume-generate"]')
      if (!form.length) {
        return false
      }
      let validator = form.validate()
      return validator.element($skill);
    }
  })
});
