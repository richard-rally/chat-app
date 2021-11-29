import App from "./Components/App";

require('./bootstrap');
import Vue from "vue";

var app = new Vue({
    el: '#app',
    components: {
        App
    },
})
