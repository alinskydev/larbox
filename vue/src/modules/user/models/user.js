import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    showDeleted: true,

    list: {
        image: {
            label: null,
            value: 'profile.image.w_100',
            type: crudEnums.valueTypes.image,
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
            value: (context, item) => context.booted.enums.user.role[item.role].label,
            type: crudEnums.valueTypes.text,
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
            type: crudEnums.inputTypes.text,
        },
        username: {
            type: crudEnums.inputTypes.text,
        },
        email: {
            type: crudEnums.inputTypes.text,
        },
        role: {
            type: crudEnums.inputTypes.select,
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
            type: crudEnums.inputTypes.text,
        },
        'profile.phone': {
            type: crudEnums.inputTypes.text,
        },
    },

    sortings: [
        'id',
        'username',
    ],

    show: {
        image: {
            label: null,
            value: 'profile.image.w_500',
            type: crudEnums.valueTypes.image,
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
            value: (context, item) => context.booted.enums.user.role[item.role].label,
            type: crudEnums.valueTypes.text,
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
                type: crudEnums.inputTypes.text,
            },
            email: {
                type: crudEnums.inputTypes.text,
            },
            role: {
                type: crudEnums.inputTypes.select,
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
                size: crudEnums.inputSizes.md,
            },
            'profile.full_name': {
                type: crudEnums.inputTypes.text,
                size: crudEnums.inputSizes.md,
            },
            'profile.phone': {
                type: crudEnums.inputTypes.text,
                size: crudEnums.inputSizes.md,
            },
            'profile.image': {
                type: crudEnums.inputTypes.file,
                options: {
                    previewPath: 'original',
                    downloadPath: 'original',
                    deletePath: 'user/user/:id/delete-file/image',
                },
                size: crudEnums.inputSizes.xl,
            },
            new_password: {
                type: crudEnums.inputTypes.password,
            },
            new_password_confirmation: {
                type: crudEnums.inputTypes.password,
            },
        },
    },
});