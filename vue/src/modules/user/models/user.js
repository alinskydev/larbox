import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    hasSoftDelete: true,

    list: {
        image: {
            label: null,
            value: 'profile.image.w_100',
            type: crudEnums.valueTypes.image,
        },
        id: {
            type: crudEnums.valueTypes.text,
        },
        username: {
            type: crudEnums.valueTypes.text,
        },
        email: {
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
        username: {
            type: crudEnums.inputTypes.text,
        },
        email: {
            type: crudEnums.inputTypes.text,
        },
        role: {
            type: crudEnums.inputTypes.select,
            options: {
                items: (context) => context.booted.helpers.iterator.get(context.booted.enums.user.role, '*.label'),
                withPrompt: true,
            },
        },
        full_name: {
            name: 'profile.full_name',
            type: crudEnums.inputTypes.text,
        },
        phone: {
            name: 'profile.phone',
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
            type: crudEnums.valueTypes.text,
        },
        username: {
            type: crudEnums.valueTypes.text,
        },
        email: {
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
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
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
                    items: (context) => context.booted.helpers.iterator.get(context.booted.enums.user.role, '*.label'),
                },
                size: crudEnums.inputSizes.md,
            },
            full_name: {
                name: 'profile[full_name]',
                value: 'profile.full_name',
                type: crudEnums.inputTypes.text,
                size: crudEnums.inputSizes.md,
            },
            phone: {
                name: 'profile[phone]',
                value: 'profile.phone',
                type: crudEnums.inputTypes.text,
                size: crudEnums.inputSizes.md,
            },
            image: {
                name: 'profile[image]',
                value: 'profile.image',
                type: crudEnums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                    deleteUrl: 'user/user/:id/delete-file/image',
                },
                size: crudEnums.inputSizes.xl,
            },
            new_password: {
                type: crudEnums.inputTypes.text,
                attributes: {
                    'type': 'password',
                },
            },
            new_password_confirmation: {
                type: crudEnums.inputTypes.text,
                attributes: {
                    'type': 'password',
                },
            },
        },
    },
});