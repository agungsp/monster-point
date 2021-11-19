window._ = require('lodash');
window.Popper = require("@popperjs/core").default;
window.$ = window.jQuery = require("jquery");
window.bootstrap = require("bootstrap");
require("devextreme/dist/js/dx.all.js");
window.Swal = require("sweetalert2/dist/sweetalert2.js");
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

require('select2');
window.CodeMirror = require('codemirror');
require('codemirror/mode/javascript/javascript.js');
require('cleave.js');
require('cleave.js/dist/addons/cleave-phone.id.js');

window.JSConfetti = require('js-confetti/dist/js-confetti.min.js');
window.JsonViewer = require('json-viewer-js');
