import Vue from 'vue'
window._ = require('lodash');
window.Popper = require('popper.js').default;

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Event = new class {
  constructor() {
    this.vue = new Vue;
  }

  fire(event, data = null) {
    this.vue.$emit(event, data)
  }

  listen(event, callback) {
    this.vue.$on(event, callback);
  }
}

Vue.directive('hs-tab', {
  inserted: function (el) {
    el.classList.add('tab-border-0');
  }
})

Vue.directive('hs-valid', {
  inserted: function (el, stat) {
    var status = stat.value;
    if (status === true) {
      el.classList.add('is-valid');
    } else if (status === false) {
      el.classList.add('is-invalid');
    } else {
      return false;
    }
  }
})

export const isInViewPort = {
  isLiteral: true,
  inserted: (el, binding, vnode) => {
    let func = () => {
      let rect = el.getBoundingClientRect();
      let inView = (
          rect.width > 0 &&
          rect.height > 0 &&
          rect.top >= 0 &&
          rect.bottom <=(window.innerHeight || document.documentElement.clientHeight)
      );
      if (inView) {
        setTimeout(function () {
          binding.value()
        }, 1000)
        window.removeEventListener('scroll', func);
      }
    };
    window.addEventListener('scroll', func);

    func();
  },
};

Vue.directive('is-in-view-port', isInViewPort);

try {
  window.$ = window.jQuery = require('jquery');
} catch (e) {}

export  class Errors {
  /**
   * Create a new Errors instance.
   */
  constructor() {
    this.errors = {};
  }


  /**
   * Determine if an errors exists for the given field.
   *
   * @param {string} field
   */
  has(field) {
    return this.errors.hasOwnProperty(field);
  }


  /**
   * Determine if we have any errors.
   */
  any() {
    return Object.keys(this.errors).length > 0;
  }


  /**
   * Retrieve the error message for a field.
   *
   * @param {string} field
   */
  get(field) {
    if (this.errors[field]) {
      return this.errors[field][0];
    }
  }


  /**
   * Record the new errors.
   *
   * @param {object} errors
   */
  record(errors) {
    this.errors = errors;
  }


  /**
   * Clear one or all error fields.
   *
   * @param {string|null} field
   */
  clear(field) {
    if (field) {
      delete this.errors[field];

      return;
    }

    this.errors = {};
  }
}

