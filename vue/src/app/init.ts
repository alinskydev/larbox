import App from '@/core/app';

export default function () {
    return App.helpers.http
        .send({
            method: 'GET',
            path: '../common/system?show-all=1',
        })
        .then((response: any) => {
            if (response.statusType === 'success') {
                let urlLocale = location.pathname.split('/')[1],
                    data = response.data,
                    translations = {};

                App.enums = data.enums;
                App.languages = data.languages;
                App.settings = data.settings;

                App.locale = urlLocale in App.languages.active ? urlLocale : App.languages.main.code;
                translations[App.locale] = data.translations;

                App.localization.translations = App.helpers.lodash.merge(App.localization.translations, translations);
                App.config.http.headers['Accept-Language'] = App.locale;
            }
        });
}
