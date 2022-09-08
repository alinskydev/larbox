import { Model } from '@/core/base/model';
import * as Enums from '@/core/base/enums';

export default new Model({
    list: {
        image: {
            label: null,
            value: 'image.w_100',
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
        is_active: {
            type: Enums.valueTypes.httpSwitcher,
            options: {
                path: 'system/language/:id/set-active/:value',
                onSuccess: (context, value) => {
                    context.booted.components.app.childKey++;
                    context.$router.push(context.$router.currentRoute);
                },
            },
        },
        is_main: {
            type: Enums.valueTypes.httpSwitcher,
            options: {
                path: 'system/language/:id/set-main/:value',
                onSuccess: (context, value) => {
                    context.booted.components.app.childKey++;
                    context.$router.push(context.$router.currentRoute);
                },
            },
            attributes: (context) => {
                return {
                    readonly: context.item.value,
                };
            },
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
    },

    filters: {
        common: {
            label: 'Общий поиск',
            hint: (context) => {
                let fields = ['name', 'code'];

                return context.__('Поиск по полям: :fields', {
                    fields: fields.map((value) => context.__('fields->' + value)).join(' | '),
                });
            },
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
        is_main: {
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

    sortings: ['id', 'name'],

    show: {
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
            value: 'image.w_100',
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

    form: {
        Информация: {
            name: {
                type: Enums.inputTypes.text,
            },
            image: {
                type: Enums.inputTypes.file,
                options: {
                    file: {
                        previewPath: 'w_500',
                        downloadPath: 'original',
                    },
                },
                size: Enums.inputSizes.xl,
            },
        },
    },
});
