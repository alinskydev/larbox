import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    config: {
        index: {
            id: {
                type: Enums.valueTypes.text,
            },
            type: {
                value: (record) => App.enums.User.NotificationType[record.type],
                type: Enums.valueTypes.text,
            },
            is_seen: {
                type: Enums.valueTypes.boolean,
            },
            created_at: {
                type: Enums.valueTypes.datetime,
            },
        },

        filters: {
            id: {
                type: Enums.inputTypes.text,
                attributes: {
                    type: 'number',
                },
            },
            type: {
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: App.enums.User.NotificationType,
                        hasPrompt: true,
                    },
                },
            },
            is_seen: {
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: {
                            0: App.t('Нет'),
                            1: App.t('Да'),
                        },
                        hasPrompt: true,
                    },
                },
            },
        },

        sortings: ['id'],

        show: {
            'Информация': {
                id: {
                    type: Enums.valueTypes.text,
                },
                type: {
                    value: (record) => App.enums.User.NotificationType[record.type],
                    type: Enums.valueTypes.text,
                },
                is_seen: {
                    type: Enums.valueTypes.boolean,
                },
                created_at: {
                    type: Enums.valueTypes.datetime,
                },
                text: {
                    type: Enums.valueTypes.text,
                },
            },
        },
    },
});
