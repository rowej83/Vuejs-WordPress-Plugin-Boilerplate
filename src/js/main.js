var Vue = require('vue')
var App = require('./app.vue')


new Vue({
  el: '#vueapp',
  render(createElement) {
    return createElement(App)
  }
})