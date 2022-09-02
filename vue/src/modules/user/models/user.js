import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    list: {
        image: {
            label: null,
            value: 'profile.image.w_100',
            type: Enums.valueTypes.image,
        },
        id: {
            type: Enums.valueTypes.text,
        },
        username: {
            type: Enums.valueTypes.text,
        },
        email: {
            type: Enums.valueTypes.text,
        },
        role: {
            value: (context, item) => context.booted.enums.user.roles[item.role].label,
            type: Enums.valueTypes.text,
        },
        full_name: {
            value: 'profile.full_name',
            type: Enums.valueTypes.text,
        },
        phone: {
            value: 'profile.phone',
            type: Enums.valueTypes.text,
        },
        created_at: {
            type: Enums.valueTypes.text,
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
    },

    filters: {
        common: {
            label: 'Общий поиск',
            hint: (context) => {
                let fields = ['username', 'email', 'profile.full_name', 'profile.phone'];

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
                'type': 'number',
            },
        },
        role: {
            type: Enums.inputTypes.select,
            options: {
                items: (context) => context.booted.helpers.iterator.get(context.booted.enums.user.roles, '*.label'),
                withPrompt: true,
            },
        },
    },

    sortings: [
        'id',
        'username',
    ],

    show: {
        image: {
            value: 'profile.image.w_500',
            type: Enums.valueTypes.image,
        },
        id: {
            type: Enums.valueTypes.text,
        },
        username: {
            type: Enums.valueTypes.text,
        },
        email: {
            type: Enums.valueTypes.text,
        },
        role: {
            value: (context, item) => context.booted.enums.user.roles[item.role].label,
            type: Enums.valueTypes.text,
        },
        full_name: {
            value: 'profile.full_name',
            type: Enums.valueTypes.text,
        },
        phone: {
            value: 'profile.phone',
            type: Enums.valueTypes.text,
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
            username: {
                type: Enums.inputTypes.text,
            },
            email: {
                type: Enums.inputTypes.text,
            },
            role: {
                type: Enums.inputTypes.select,
                options: {
                    items: (context) => context.booted.helpers.iterator.get(context.booted.enums.user.roles, '*.label'),
                },
                size: Enums.inputSizes.md,
            },
            full_name: {
                name: 'profile[full_name]',
                value: 'profile.full_name',
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.md,
            },
            phone: {
                name: 'profile[phone]',
                value: 'profile.phone',
                type: Enums.inputTypes.phone,
                size: Enums.inputSizes.md,
            },
            image: {
                name: 'profile[image]',
                value: 'profile.image',
                type: Enums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                    deleteUrl: 'user/user/:id/delete-file/image',
                },
                size: Enums.inputSizes.xl,
            },
            new_password: {
                type: Enums.inputTypes.text,
                attributes: {
                    'type': 'password',
                },
            },
            new_password_confirmation: {
                type: Enums.inputTypes.text,
                attributes: {
                    'type': 'password',
                },
            },
        },
    },
});