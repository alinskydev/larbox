import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    config: {
        index: {
            id: {
                type: Enums.valueTypes.text,
            },
            type: {
                value: (context, record) => context.booted.enums.user_notification.types[record.type],
                type: Enums.valueTypes.text,
            },
            is_seen: {
                type: Enums.valueTypes.boolean,
            },
            created_at: {
                type: Enums.valueTypes.text,
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
                        items: (context) => context.booted.enums.user_notification.types,
                        hasPrompt: true,
                    },
                },
            },
            is_seen: {
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: (context) => {
                            return {
                                0: context.__('Нет'),
                                1: context.__('Да'),
                            };
                        },
                        hasPrompt: true,
                    },
                },
            },
        },

        sortings: ['id'],

        show: {
            Информация: {
                id: {
                    type: Enums.valueTypes.text,
                },
                type: {
                    value: (context, record) => context.booted.enums.user_notification.types[record.type],
                    type: Enums.valueTypes.text,
                },
                is_seen: {
                    type: Enums.valueTypes.boolean,
                },
                created_at: {
                    type: Enums.valueTypes.text,
                },
                text: {
                    type: Enums.valueTypes.text,
                },
            },
        },
    },
});
