import { LocalizationHelper } from './localizationHelper';

export default {
    localizedTypedFile(config, types = ['desktop', 'tablet', 'mobile']) {
        let languages = Object.keys(LocalizationHelper.messages),
            result = [];

        types.forEach((size) => {
            languages.forEach((language) => {
                let key = config.key + '_' + size;

                result[key + '_' + language] = {
                    ...config,
                    ...{
                        label: (context) => {
                            return [
                                context.__('fields->' + key),
                                ' | ',
                                '<img src="' + context.booted.languages.all[language].image?.w_30 + '" class="align-text-bottom ml-1">',
                            ].join('');
                        },
                        name: key + '[' + language + ']',
                        value: key + '.' + language,
                    },
                };
            });
        });

        return result;
    },
};