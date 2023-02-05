import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    hasSoftDelete: true,

    config: {
        index: {
            id: {
                type: Enums.valueTypes.text,
            },
            full_name: {
                type: Enums.valueTypes.text,
            },
            phone: {
                type: Enums.valueTypes.text,
            },
            status: {
                type: Enums.valueTypes.httpSelect,
                options: {
                    httpSelect: {
                        path: 'feedback/callback/:pk/set-status/:value',
                        items: App.enums.feedback.statuses,
                    },
                },
            },
            created_at: {
                type: Enums.valueTypes.datetime,
            },
        },

        filters: {
            common: {
                label: App.t('Общий поиск'),
                hint: App.t('Поиск по полям: :fields', {
                    fields: ['full_name', 'phone'].map((value) => App.t('fields->' + value)).join(' | '),
                }),
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
            },
            id: {
                type: Enums.inputTypes.text,
                attributes: {
                    type: 'number',
                },
            },
            status: {
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: App.enums.feedback.statuses,
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
                full_name: {
                    type: Enums.valueTypes.text,
                },
                phone: {
                    type: Enums.valueTypes.text,
                },
                message: {
                    type: Enums.valueTypes.text,
                },
                status: {
                    value: (record) => App.enums.feedback.statuses[record.status],
                    type: Enums.valueTypes.text,
                },
                created_at: {
                    type: Enums.valueTypes.datetime,
                },
                updated_at: {
                    type: Enums.valueTypes.datetime,
                },
            },
        },
    },
});
