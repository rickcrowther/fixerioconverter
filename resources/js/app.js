require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all.js');
require('@fortawesome/fontawesome-free/js/v4-shims.js');
require('bootstrap-datepicker');
require('./components/formpickers');

try {
    window.moment = require('moment');
    window.moment.locale('en');
} catch (e) {}

