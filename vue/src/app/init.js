import App from '@/core/app';
import Lodash from 'lodash';

export default function () {
    return App.helpers.http
        .send({
            method: 'GET',
            path: '../common/system?show-all=1',
        })
        .then((response) => {
            if (response.statusType === 'success') {
                let data = response.data,
                    urlLocale = location.pathname.split('/')[1];

                App.enums = data.enums;
                App.languages = data.languages;
                App.settings = data.settings;

                App.locale = urlLocale in App.languages.active ? urlLocale : App.languages.main.code;
                App.localization.translations = Lodash.merge(App.localization.translations, data.translations);

                App.config.http.headers['Accept-Language'] = App.locale;
            }
        });
}
