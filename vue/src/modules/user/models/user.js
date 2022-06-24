import { CrudModel } from '@/app/core/models/model';

import * as crudEnums from '@/app/enums/crud';
import * as inputEnums from '@/app/enums/input';

export default new CrudModel({
    list: {
        image: {
            value: 'profile.image.w_100',
            type: crudEnums.valueTypes.image,
            options: {
                hideLabel: true,
            },
        },
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        username: {
            value: 'username',
            type: crudEnums.valueTypes.text,
        },
        email: {
            value: 'email',
            type: crudEnums.valueTypes.text,
        },
        role: {
            value: 'role',
            type: crudEnums.valueTypes.text,
            options: {
                onComplete: (context, value) => context.booted.enums.user.role[value].label,
            },
        },
        full_name: {
            value: 'profile.full_name',
            type: crudEnums.valueTypes.text,
        },
        phone: {
            value: 'profile.phone',
            type: crudEnums.valueTypes.text,
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
        username: {
            type: inputEnums.types.text,
        },
        email: {
            type: inputEnums.types.text,
        },
        role: {
            type: inputEnums.types.select,
            options: {
                items: (context) => {
                    return Object.fromEntries(
                        Object.entries(context.booted.enums.user.role).map((entry) => {
                            entry[1] = entry[1].label;
                            return entry;
                        }),
                    );
                },
                withPrompt: true,
            },
        },
        'profile.full_name': {
            type: inputEnums.types.text,
        },
        'profile.phone': {
            type: inputEnums.types.text,
        },
    },

    sortings: [
        'id',
        'username',
    ],

    show: {
        image: {
            value: 'profile.image.w_500',
            type: crudEnums.valueTypes.image,
            options: {
                hideLabel: true,
            },
        },
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        username: {
            value: 'username',
            type: crudEnums.valueTypes.text,
        },
        email: {
            value: 'email',
            type: crudEnums.valueTypes.text,
        },
        role: {
            value: 'role',
            type: crudEnums.valueTypes.text,
            options: {
                onComplete: (context, value) => context.booted.enums.user.role[value].label,
            },
        },
        full_name: {
            value: 'profile.full_name',
            type: crudEnums.valueTypes.text,
        },
        phone: {
            value: 'profile.phone',
            type: crudEnums.valueTypes.text,
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
            username: {
                type: inputEnums.types.text,
            },
            email: {
                type: inputEnums.types.text,
            },
            role: {
                type: inputEnums.types.select,
                options: {
                    items: (context) => {
                        return Object.fromEntries(
                            Object.entries(context.booted.enums.user.role).map((entry) => {
                                entry[1] = entry[1].label;
                                return entry;
                            }),
                        );
                    },
                },
                wrapperSize: inputEnums.wrapperSizes.md,
            },
            'profile.full_name': {
                type: inputEnums.types.text,
                wrapperSize: inputEnums.wrapperSizes.md,
            },
            'profile.phone': {
                type: inputEnums.types.text,
                wrapperSize: inputEnums.wrapperSizes.md,
            },
            'profile.image': {
                type: inputEnums.types.file,
                options: {
                    previewPath: 'original',
                    downloadPath: 'original',
                    deletePath: 'user/user/:id/delete-file/image',
                },
                wrapperSize: inputEnums.wrapperSizes.xl,
            },
            new_password: {
                type: inputEnums.types.password,
            },
            new_password_confirmation: {
                type: inputEnums.types.password,
            },
        },
    },
});