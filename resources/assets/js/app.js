
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function(){
  $('.modal').modal();
});

$('.timepicker').pickatime({
  default: '10:00', // Set default time
  fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
  twelvehour: false, // Use AM/PM or 24-hour format
  donetext: 'OK', // text for done-button
  cleartext: 'Clear', // text for clear-button
  canceltext: 'Cancel', // Text for cancel-button
  autoclose: false, // automatic close timepicker
  ampmclickable: true, // make AM PM clickable
  aftershow: function(){} //Function for after opening timepicker
});
