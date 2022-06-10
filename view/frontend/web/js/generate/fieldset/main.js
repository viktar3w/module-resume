define([
  "uiComponent",
  "Victor3w_Resume/js/generate/fieldset/field/additional-link",
  "Victor3w_Resume/js/generate/fieldset/field/language"
], function (
  Component,
  AdditionalLink,
  Language
) {
  "use strict"
  return Component.extend({
    defaults: {
      addition_links: {},
      fileTypes: [],
      max_file_size: 10000,
      customer: {},
      linkBoxes: [],
      languageBoxes: [],
      increment: 1,
      showPhoto: false,
      tracks: {
        addition_links: true,
        customer: true,
        linkBoxes: true,
        languageBoxes: true,
        increment: true,
        showPhoto: true
      },
      imports: {
        customer: '${ $.parentName }:customer'
      }
    },
    initialize: function (config) {
      this._super(config)
      this.addLinkBox()
      this.addLanguageBox()
      return this
    },
    addLinkBox: function () {
      this.linkBoxes.push(new AdditionalLink({
        addition_links: this.addition_links,
        show: true,
        increment: this.increment
      }))
      this.increment++
    },
    addLanguageBox: function () {
      this.languageBoxes.push(new Language({
        show: true,
        increment: this.increment
      }))
      this.increment++
    },
    doPreviewPhoto: function (_, element) {
      const [file] = element.target.files
      if (file && this.fileTypes.includes(file.type) && file.size < 1048576) {
        document.getElementById('photo-preview').src = URL.createObjectURL(file)
        this.showPhoto = true
      } else {
        element.target.value = ''
        this.showPhoto = false
      }
    },
    removePhoto: function () {
      const photo = document.getElementById('photo')
      if (photo) {
        photo.value = ''
      }
      this.showPhoto = false
    },
    /**
     * @return {string}
     */
    getFileTypes: function () {
      return this.fileTypes.join(', ')
    }
  })
})
