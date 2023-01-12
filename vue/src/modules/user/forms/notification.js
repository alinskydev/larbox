import lodash from 'lodash';

import * as Enums from '@/core/enums';
import { Model } from '@/core/model';

export default new Model({
    config: {
        form: {
            0: {
                type: {
                    type: Enums.inputTypes.select,
                    options: {
                        select: {
                            items: (context) => {
                                let types = context.booted.enums.user_notification.types;
                                types = lodash.pick(types, ['message', 'announcement']);
                                return types;
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
    },
});
