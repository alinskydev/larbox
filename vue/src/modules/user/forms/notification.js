import { Model } from '@/core/base/model';
import * as Enums from '@/core/base/enums';

export default new Model({
    form: {
        0: {
            type: {
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: (context) => context.booted.helpers.iterator.get(context.booted.enums.user_notification.types, '*.label'),
                    },
                },
                size: Enums.inputSizes.xl,
            },
            message: {
                type: Enums.inputTypes.textarea,
                size: Enums.inputSizes.xl,
                attributes: {
                    rows: 10,
                },
            },
        },
    },
});
