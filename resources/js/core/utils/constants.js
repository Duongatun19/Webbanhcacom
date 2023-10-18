let mode = 'development';
let suffix = '';
if (!process.env.VUE_ENV && window && window.appSettings) {
    mode = window.appSettings.mode;
    suffix = '_' + mode;
}
const CONSTANTS = {
    ACCESS_TOKEN: 'AUTH_TOKEN' + suffix,
    CURRENT_VERSION: 'CURRENT_VERSION' + suffix,
    MENU_MODE: 'MENU_MODE' + suffix,
}
export default CONSTANTS;
