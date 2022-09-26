import { LocalizationHelper } from '@/core/helpers/localizationHelper';

export default function (context) {
    // Setting options

    let locale,
        url = context.booted.config.http.url;

    let requestOptions = {
        method: 'GET',
        headers: context.booted.config.http.headers,
    };

    // Sending system request

    return fetch(url + '/../common/system/information', requestOptions)
        .then((response) => response.json())
        .then((data) => {
            context.booted.languages = data.languages;
            context.booted.settings = data.settings;

            // Setting locale

            let mainLocale = context.booted.languages.main.code;
            let routeLocale = context.$route.params.locale;

            if (routeLocale !== undefined && routeLocale in context.booted.languages.active) {
                locale = routeLocale;
            } else {
                locale = mainLocale;
            }

            context.booted.locale = locale;
            context.booted.config.http.headers['Accept-Language'] = locale;

            // Setting locale

            LocalizationHelper.locale = locale;
        });
}
