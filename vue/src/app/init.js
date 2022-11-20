import { LocalizationHelper } from '@/core/helpers/localizationHelper';
import lodash from 'lodash';

export default function (context) {
    // Setting options

    let locale,
        url = context.booted.config.http.url;

    let requestOptions = {
        method: 'GET',
        headers: context.booted.config.http.headers,
    };

    // Sending system request

    return fetch(url + '/../common/system?show-all=1', requestOptions)
        .then((response) => response.json())
        .then((data) => {
            context.booted.languages = data.languages;
            context.booted.settings = data.settings;
            context.booted.enums = data.enums;

            // Setting locale

            let mainLocale = context.booted.languages.main.code,
                routeLocale = context.$route.params.locale;

            if (routeLocale !== undefined && routeLocale in context.booted.languages.active) {
                locale = routeLocale;
            } else {
                locale = mainLocale;
            }

            context.booted.locale = locale;
            context.booted.config.http.headers['Accept-Language'] = locale;

            // Setting locale

            LocalizationHelper.locale = locale;
            LocalizationHelper.messages = lodash.merge(LocalizationHelper.messages, data.translations);
        });
}
