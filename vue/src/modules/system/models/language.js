import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    config: {
        index: {
            image: {
                label: null,
                value: 'image.widen_100.webp',
                type: Enums.valueTypes.image,
            },
            id: {
                type: Enums.valueTypes.text,
            },
            name: {
                type: Enums.valueTypes.text,
            },
            code: {
                type: Enums.valueTypes.text,
            },
            // is_active: {
            //     type: Enums.valueTypes.httpSwitcher,
            //     options: {
            //         httpSwitcher: {
            //             path: 'system/language/:pk/set-active/:value',
            //             onSuccess: (value) => {
            //                 toastr.success(App.t('Успешно изменено'));
            //                 App.components.app.refresh();
            //             },
            //         },
            //     },
            // },
            // is_main: {
            //     type: Enums.valueTypes.httpSwitcher,
            //     options: {
            //         httpSwitcher: {
            //             path: 'system/language/:pk/set-main/:value',
            //             onSuccess: (value) => {
            //                 toastr.success(App.t('Успешно изменено'));
            //                 App.components.app.refresh();
            //             },
            //         },
            //     },
            //     attributes: (record) => {
            //         return {
            //             readonly: record.is_main,
            //         };
            //     },
            // },
            is_active: {
                type: Enums.valueTypes.boolean,
            },
            is_main: {
                type: Enums.valueTypes.boolean,
            },
            updated_at: {
                type: Enums.valueTypes.text,
            },
        },

        filters: {
            common: {
                label: App.t('Общий поиск'),
                hint: App.t('Поиск по полям: :fields', {
                    fields: ['name', 'code'].map((value) => App.t('fields->' + value)).join(' | '),
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
            is_active: {
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
            is_main: {
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

        sortings: ['id', 'name'],

        show: {
            'Информация': {
                id: {
                    type: Enums.valueTypes.text,
                },
                name: {
                    type: Enums.valueTypes.text,
                },
                code: {
                    type: Enums.valueTypes.text,
                },
                image: {
                    value: 'image.widen_100.webp',
                    type: Enums.valueTypes.image,
                },
                is_active: {
                    type: Enums.valueTypes.boolean,
                },
                is_main: {
                    type: Enums.valueTypes.boolean,
                },
                created_at: {
                    type: Enums.valueTypes.text,
                },
                updated_at: {
                    type: Enums.valueTypes.text,
                },
            },
        },

        form: {
            'Информация': {
                name: {
                    type: Enums.inputTypes.text,
                },
                image: {
                    type: Enums.inputTypes.file,
                    options: {
                        file: {
                            previewPath: 'widen_500.webp',
                            downloadPath: 'original.raw',
                        },
                    },
                    size: Enums.inputSizes.xl,
                },
            },
        },
    },
});
