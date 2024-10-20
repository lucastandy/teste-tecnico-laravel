// Importando o framework Boostrap
import 'bootstrap';

// import jQuery from 'jquery';
// window.$ = jQuery;

import axios from 'axios';
window.axios = axios;

import Swal from 'sweetalert2';
window.Swal = Swal;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
