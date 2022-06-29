import iteratorHelper from '@/app/helpers/iteratorHelper';

export class LocalizationHelper {
    static locale;
    static messages = {};
}

export function __(sourceMessage, replacements = []) {
    let locale = LocalizationHelper.locale;
    let message = iteratorHelper.get(LocalizationHelper.messages, locale + '->' + sourceMessage, '->');

    if (message === undefined) {
        return sourceMessage;
    }

    for (let r in replacements) {
        message = message.replace(':' + r, replacements[r]);
    }

    return message;
}