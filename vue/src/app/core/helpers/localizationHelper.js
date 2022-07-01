import iteratorHelper from '@/app/core/helpers/iteratorHelper';

export class LocalizationHelper {
    static locale;
    static messages = {};
}

export function __(sourceMessage, replacements = {}) {
    let locale = LocalizationHelper.locale;
    let message = iteratorHelper.get(LocalizationHelper.messages, locale + '->' + sourceMessage, '->');

    if (message === undefined) {
        return sourceMessage;
    }

    for (let key in replacements) {
        message = message.replace(':' + key, replacements[key]);
    }

    return message;
}