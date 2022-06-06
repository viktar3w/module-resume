define([
  "jquery",
  "uiComponent",
  "Magento_Customer/js/customer-data",
  "mage/url",
  "mage/validation"
], function (
  $,
  Component,
  customerData,
  urlBuilder
) {
  'use strict'
  return Component.extend({
    defaults: {
      generateResumeUrl: '',
      customerUrl: '',
      addition_links: [],
      customer: {},
      enableButton: true,
      defaultLogo: '',
      tracks: {
        customer: true,
        enableButton: true,
        defaultLogo: true
      }
    },
    initialize: function (config) {
      this._super(config)
      this.initCustomer()
      return this
    },
    initCustomer: function () {
      let self = this
      self.customer = customerData.get('customer')()
      if (!this.showForm() || !this.customerUrl) {
        return
      }
      const opts = {};
      opts.url = urlBuilder.build(this.customerUrl)
      opts.method = "GET"
      opts.headers = {
        Authorization: ` Bearer ${this.customer.signin_token}`
      }
      this.sendRequest(opts).then(function (response) {
        let preparedResponse = JSON.parse(response)
        self.customer = {...self.customer, ...preparedResponse}
      }).catch(function (err) {
        console.error(err)
      })
    },
    sendForm: function () {
      if (!this.validate()
        || !this.generateResumeUrl) {
        return
      }
      let self = this
      self.enableButton = false
      const opts = {}
      opts.url = urlBuilder.build(this.generateResumeUrl)
      opts.method = "POST"
      let form = $('[name="resume-generate"]')
      opts.params = new FormData(form[0])
      opts.responseType = 'blob'

      this.sendRequest(opts).then(function (result) {
        let reader = new FileReader()
        reader.readAsText(result.response)
        reader.onload = function () {
          try {
            let jsonData = JSON.parse(this.result)
            if (jsonData.error || jsonData.message) {
              alert(jsonData.message)
            }
          } catch (e) {
            self.showFile(result)
          }
        }
        self.enableButton = true
        // form[0].reset();
      }).catch(function (err) {
        console.error(err)
        self.enableButton = true
      })
    },
    showFile: function (result) {
      let disposition = result.disposition
      let blob = result.response;
      let filename = "";
      if (disposition && disposition.indexOf('attachment') !== -1) {
        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
        var matches = filenameRegex.exec(disposition);
        if (matches != null && matches[1]) {
          filename = matches[1].replace(/['"]/g, '')
        }
      }
      if (typeof window.navigator.msSaveBlob !== 'undefined') {
        window.navigator.msSaveBlob(blob, filename);
      } else {
        let file = new Blob([blob], {type: 'application/pdf'})
        let downloadUrl = URL.createObjectURL(file,{type: 'application/pdf'});
        window.open(downloadUrl, '_blank');
      }
    },
    /**
     * @param {Object} opts
     * @return {Promise}
     */
    sendRequest: function (opts = {}) {
      return new Promise(function (resolve, reject) {
        const xhr = new XMLHttpRequest();
        xhr.open(opts.method, opts.url);
        if (opts.responseType) {
          xhr.responseType = opts.responseType
        }
        xhr.onload = function () {
          if (xhr.status >= 200 && xhr.status < 300) {
            resolve({response: xhr.response, disposition: xhr.getResponseHeader('Content-Disposition')});
          } else {
            reject({
              status: xhr.status,
              statusText: xhr.statusText
            });
          }
        };
        xhr.onerror = function () {
          reject({
            status: xhr.status,
            statusText: xhr.statusText
          });
        };
        if (opts.headers) {
          Object.keys(opts.headers).forEach(function (key) {
            xhr.setRequestHeader(key, opts.headers[key]);
          });
        }
        xhr.send(opts.params);
      });
    },

    /**
     * @return {boolean}
     */
    showForm: function () {
      return this.customer && this.customer.signin_token !== undefined
    },
    validate: function () {
      let form = $('[name="resume-generate"]')
      if (!form.length) {
        return false
      }
      let validator = form.validate()
      let inputs = form.find('input')
      let selects = form.find('select')
      let textareas = form.find('textarea')
      let valid = true
      let element
      inputs.each(function () {
        valid &= validator.element(this);
        if (!element && !valid) {
          element = this
        }
      })
      selects.each(function () {
        valid &= validator.element(this);
        if (!element && !valid) {
          element = this
        }
      })
      textareas.each(function () {
        valid &= validator.element(this);
        if (!element && !valid) {
          element = this
        }
      })
      if (!valid && element) {
        element.scrollIntoView({block: "center", behavior: "smooth"});
      }
      return valid;
    }
  })
})
