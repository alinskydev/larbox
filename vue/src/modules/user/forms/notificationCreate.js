import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    config: {
        form: {
            0: {
                type: {
                    type: Enums.inputTypes.select,
                    options: {
                        select: {
                            items: App.helpers.lodash.pick(App.enums.user_notification.types, ['message', 'announcement']),
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
