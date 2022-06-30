import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    list: {
        image: {
            label: null,
            value: 'image.w_100',
            type: crudEnums.valueTypes.image,
        },
        id: {
            type: crudEnums.valueTypes.text,
        },
        name: {
            type: crudEnums.valueTypes.text,
        },
        code: {
            type: crudEnums.valueTypes.text,
        },
        is_active: {
            type: crudEnums.valueTypes.httpSwitcher,
            options: {
                path: 'system/language/:id/set-active/:value',
                onSuccess: (context, value) => {
                    context.booted.components.app.$data.childKey++;
                    context.$router.push(context.$router.currentRoute);
                },
            },
        },
        is_main: {
            type: crudEnums.valueTypes.httpSelect,
            options: {
                items: (context, value) => {
                    if (value === 0) {
                        return {
                            0: context.__('Нет'),
                            1: context.__('Да'),
                        };
                    } else {
                        return {
                            1: context.__('Да'),
                        };
                    }
                },
                path: 'system/language/:id/set-main/:value',
                isBoolean: true,
                onSuccess: (context, value) => {
                    context.booted.components.app.$data.childKey++;
                    context.$router.push(context.$router.currentRoute);
                },
            },
        },
        created_at: {
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            type: crudEnums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: crudEnums.inputTypes.text,
            attributes: {
                'type': 'number',
            },
        },
        name: {
            type: crudEnums.inputTypes.text,
        },
        code: {
            type: crudEnums.inputTypes.text,
        },
        is_active: {
            type: crudEnums.inputTypes.select,
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
            type: crudEnums.inputTypes.select,
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
            type: crudEnums.valueTypes.text,
        },
        name: {
            type: crudEnums.valueTypes.text,
        },
        code: {
            type: crudEnums.valueTypes.text,
        },
        image: {
            label: null,
            value: 'image.w_100',
            type: crudEnums.valueTypes.image,
        },
        is_active: {
            type: crudEnums.valueTypes.boolean,
        },
        is_main: {
            type: crudEnums.valueTypes.boolean,
        },
        created_at: {
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            type: crudEnums.valueTypes.text,
        },
    },

    form: {
        'Информация': {
            name: {
                type: crudEnums.inputTypes.text,
            },
            image: {
                type: crudEnums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                },
                size: crudEnums.inputSizes.xl,
            },
        },
    },
});