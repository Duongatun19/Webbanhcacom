'use strict';
const CONFIG = require('./env/' + (process.env.NODE_ENV || 'development'));
const ENUM = require('./enum');
CONFIG.Enum = ENUM;
module.exports = CONFIG;
