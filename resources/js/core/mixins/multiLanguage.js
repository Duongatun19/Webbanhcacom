export default {
    methods: {
        $i(key) {
            var me = this;
            if (this.currentLanguage) {
                if (this.appSettings && this.appSettings.staticTexts) {
                    let obj = _.find(this.appSettings.staticTexts, (o) => {
                        return o.info.languageKey == key;
                    });
                    if (obj) {
                        return obj.lang[this.currentLanguage] || key;
                    }
                }
            }
            return key;
        }
    }
}
