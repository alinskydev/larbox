import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

import _ from 'lodash';

export default new Model({
    form: {
        0: {
            type: {
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: (context) => {
                            let types = context.booted.enums.user.notification.types;
                            types = _.pick(types, ['message', 'announcement']);
                            return context.booted.helpers.iterator.get(types, '*.label');
                        },
                    },
                },
                size: Enums.inputSizes.xl,
            },
            text: {
                type: Enums.inputTypes.textarea,
                size: Enums.inputSizes.xl,
                attributes: {
                    rows: 10,
                },
            },
        },
    },
});
