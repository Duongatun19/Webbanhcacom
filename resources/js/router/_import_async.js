module.exports = file => () => {
    var context = require.context('../componentExtends/', true, /.vue$/).keys();
    var temp = context.filter(s => s.indexOf(file) > -1);
    if (window.extComponent.indexOf(";"+ file +";") > -1) {
        if ((temp + '').split('/')[1] == window.appSettings.CompanyId)
            return import(`../componentExtends/${window.appSettings.CompanyId}/${file}.vue`)
        else {
            context = require.context('../components/', true, /.vue$/).keys();
            temp = context.filter(s => s.indexOf(file) > -1);
            if (temp && temp.length > 0)
                return import(`../components/${file}.vue`)
        }
    }
    else {
        context = require.context('../components/', true, /.vue$/).keys();
        temp = context.filter(s => s.indexOf(file) > -1);
        if (temp && temp.length > 0) {
            return import(`../components/${file}.vue`)
        }
    }
};
