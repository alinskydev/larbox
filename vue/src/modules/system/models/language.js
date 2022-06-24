import { CrudModel } from '@/app/core/models/model';

import * as crudEnums from '@/app/enums/crud';
import * as inputEnums from '@/app/enums/input';

export default new CrudModel({
    list: {
        image: {
            value: 'image.w_100',
            type: crudEnums.valueTypes.image,
            options: {
                hideLabel: true,
            },
        },
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name',
            type: crudEnums.valueTypes.text,
        },
        code: {
            value: 'code',
            type: crudEnums.valueTypes.text,
        },
        is_active: {
            value: 'is_active',
            type: crudEnums.valueTypes.httpSwitcher,
            options: {
                path: 'system/language/:id/set-active/:value',
                onSuccess: (context, value) => {
                    context.booted.components.app.$data.appChildKey++;
                    context.$router.push(context.$router.currentRoute);

                    toastr.success(context.__('Изменено'));
                },
            },
        },
        is_main: {
            value: 'is_main',
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
                    context.booted.components.app.$data.appChildKey++;
                    context.$router.push(context.$router.currentRoute);

                    toastr.success(context.__('Изменено'));
                },
            },
        },
        created_at: {
            value: 'created_at',
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: inputEnums.types.text,
        },
        name: {
            type: inputEnums.types.text,
        },
        code: {
            type: inputEnums.types.text,
        },
        is_active: {
            type: inputEnums.types.select,
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
            type: inputEnums.types.select,
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
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name',
            type: crudEnums.valueTypes.text,
        },
        code: {
            value: 'code',
            type: crudEnums.valueTypes.text,
        },
        image: {
            value: 'image.w_100',
            type: crudEnums.valueTypes.image,
        },
        is_active: {
            value: 'is_active',
            type: crudEnums.valueTypes.boolean,
        },
        is_main: {
            value: 'is_main',
            type: crudEnums.valueTypes.boolean,
        },
        created_at: {
            value: 'created_at',
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
    },

    form: {
        'Информация': {
            name: {
                type: inputEnums.types.text,
            },
            image: {
                type: inputEnums.types.file,
                options: {
                    previewPath: 'original',
                    downloadPath: 'original',
                },
                wrapperSize: inputEnums.wrapperSizes.xl,
            },
        },
    },
});