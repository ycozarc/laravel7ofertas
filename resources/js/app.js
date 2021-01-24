import Vue from 'vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueSweetalert2 from 'vue-sweetalert2';

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.use(VueSweetalert2);
Vue.config.ignoredElements = ['trix-editor', 'trix-toolbar'];
Vue.component('fecha-chollo', require('./components/FechaChollo.vue').default);
Vue.component('eliminar-chollo', require('./components/EliminarChollo.vue').default);
Vue.component('eliminar-chollo-admin', require('./components/EliminarCholloAdmin.vue').default);
Vue.component('estado-chollo', require('./components/EstadoChollo.vue').default);
Vue.component('eliminar-user', require('./components/EliminarUser.vue').default);
Vue.component('megusta-chollo', require('./components/LikeChollo.vue').default);
Vue.component('seguir-chollo', require('./components/FollowChollo.vue').default);
Vue.component('moderar-chollo', require('./components/ModerarChollo.vue').default);
Vue.component('eliminar-categoria', require('./components/EliminarCategoria.vue').default);
Vue.component('eliminar-tienda', require('./components/EliminarTienda.vue').default);
Vue.component('eliminar-rol', require('./components/EliminarRol.vue').default);
Vue.component('eliminar-comentario', require('./components/EliminarComentario.vue').default);
Vue.component('copiar-cupon', require('./components/CopiarCupon.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

jQuery(document).ready(function() {
    $("#tipodescuento").change(function() {
        if ($(this).val() == 1) {

            $("#precio_anterior").css('display', 'block');
            $("#precio_actual").css('display', 'block');

        } else {
            $("#precio_anterior").css('display', 'none');
            $("#precio_actual").css('display', 'none');
        }

        if ($(this).val() == 2) {

            $("#descuento").css('display', 'block');

        } else {
            $("#descuento").css('display', 'none');
        }
        if ($(this).val() == 3) {

            $("#gratis").css('display', 'block');

        } else {
            $("#gratis").css('display', 'none');
        }
    });
});