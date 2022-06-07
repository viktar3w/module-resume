define([
  'jquery',
  "uiComponent",
  'Magento_Ui/js/modal/modal',
  'mage/translate'
], function ($, Component, modal, $t) {
  "use strict"
  return Component.extend({
    defaults: {
      modalBox: '#default-template-modal',
      templateModal: null,
      defaultLogo: '',
      tracks: {
        defaultLogo: true
      },
      imports: {
        defaultLogo: 'resume_generate:defaultLogo'
      }
    },
    showPdf: function () {
      if (!this.templateModal) {
        const options = {
          type: 'popup',
          responsive: true,
          innerScroll: true,
          title: $t('Default Template'),
          buttons: [{
            text: $t('Close'),
            class: '',
            click: function () {
              this.closeModal();
            }
          }]
        }
        let modalBox = $(this.modalBox)
        if (modalBox.length) {
          this.templateModal = modal(options, $(this.modalBox));
        }
      }
      $(this.modalBox).modal('openModal')
    }
  })
});
