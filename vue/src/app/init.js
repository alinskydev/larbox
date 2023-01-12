import Larbox from '@/core/larbox';
import { LocalizationHelper } from '@/core/helpers/localizationHelper';
import lodash from 'lodash';

export default function (context) {
    return context.booted.helpers.http
        .send(context, {
            method: 'GET',
            path: '../common/system?show-all=1',
        })
        .then((response) => {
            if (response.statusType === 'success') {
                let data = response.data;

                context.booted.languages = data.languages;
                context.booted.settings = data.settings;
                context.booted.enums = data.enums;

                // Setting locale

                let mainLocale = context.booted.languages.main.code,
                    routeLocale = context.$route.params.locale;

                if (routeLocale !== undefined && routeLocale in context.booted.languages.active) {
                    context.booted.locale = routeLocale;
                } else {
                    context.booted.locale = mainLocale;
                }

                context.booted.config.http.headers['Accept-Language'] = context.booted.locale;

                Larbox.locale = context.booted.locale;

                // Setting locale

                LocalizationHelper.locale = context.booted.locale;
                LocalizationHelper.messages = lodash.merge(LocalizationHelper.messages, data.translations);
            }
        });
}
