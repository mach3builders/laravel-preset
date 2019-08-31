/**
 * Here we bootstrap the Mach3Builders UI and specific scripts.
 * When the document is loaded we run these scripts, which do not "clash" with Vue.
 */
import '@mach3builders/ui/src/js/ui-bootstrap'
import Layout from '@mach3builders/ui/src/js/core/Layout'
import Notifier from '@mach3builders/ui/src/js/core/Notifier'
import Table from '@mach3builders/ui/src/js/core/Table'


/**
 * Import Vue and make it globally accessible.
 */
import Vue from 'vue'
window.Vue = Vue


/**
 * Global component registration.
 * Uncomment lines below when you want all components in the folder to be registered or just a single one.
 */
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// import ExampleComponent from './components/ExampleComponent'
// Vue.component('example-component', ExampleComponent)


/**
 * Run these scripts when the document is done loading.
 */
$(() => {
    new Layout()
    new Notifier()
    new Table()

    new Vue({
        el: '#app',
    })
})
