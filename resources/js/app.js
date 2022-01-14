/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios').default;
let Fire= new Vue();
window.Fire= Fire ;
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDDmW4TvEDf8aQNS8JZ_1VntGa6ON-en4Q',
        libraries: 'places', // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)

        //// If you want to set the version, you can do so:
        // v: '3.26',
    },
});


require('./sweet-alert');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

require('./components');

import Multiselect from 'vue-multiselect'

// register globally
Vue.component('multiselect', Multiselect)

// validation form package
import Form from 'vform'
window.Form= Form;

const app = new Vue({
    el: '#app',
});
