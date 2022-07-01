import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

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
                    'disabled': context.item.value,
                };
            },
        },
        created_at: {
            type: Enums.valueTypes.text,
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: Enums.inputTypes.text,
            attributes: {
                'type': 'number',
            },
        },
        name: {
            type: Enums.inputTypes.text,
        },
        code: {
            type: Enums.inputTypes.text,
        },
        is_active: {
            type: Enums.inputTypes.select,
            options: {
                items: (context) => {
                    return {
                        0: context.__('Нет'),
                        1: context.__('Да'),
                    };
                },
                withPrompt: true,
            },
        },
        is_main: {
            type: Enums.inputTypes.select,
            options: {
                items: (context) => {
                    return {
                        0: context.__('Нет'),
                        1: context.__('Да'),
                    };
                },
                withPrompt: true,
            },
        },
    },

    sortings: [
        'id',
        'name',
    ],

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
            label: null,
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
        'Информация': {
            name: {
                type: Enums.inputTypes.text,
            },
            image: {
                type: Enums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                },
                size: Enums.inputSizes.xl,
            },
        },
    },
});