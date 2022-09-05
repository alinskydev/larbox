import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    form: {
        type: {
            type: Enums.inputTypes.select,
            options: {
                items: (context) => context.booted.helpers.iterator.get(context.booted.enums.user_notification.types, '*.label'),
            },
            size: Enums.inputSizes.xl,
        },
        message: {
            type: Enums.inputTypes.textarea,
            size: Enums.inputSizes.xl,
            attributes: {
                'rows': 10,
            },
        },
    },
});