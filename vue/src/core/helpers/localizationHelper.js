import iteratorHelper from '@/core/helpers/iteratorHelper';

import messagesRu from '@/lang/ru';
import messagesUz from '@/lang/uz';
import messagesEn from '@/lang/en';

export class LocalizationHelper {
    static locale;

    static messages = {
        ru: messagesRu,
        uz: messagesUz,
        en: messagesEn,
    };
}

export function __(sourceMessage, replacements = {}) {
    let message = iteratorHelper.get(LocalizationHelper.messages, LocalizationHelper.locale + '->' + sourceMessage, '->');

    if (message === undefined) return sourceMessage;

    for (let key in replacements) {
        message = message.replace(':' + key, replacements[key]);
    }

    return message;
}
