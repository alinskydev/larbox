import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

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
        role_id: {
            value: 'role.name.:locale',
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
            value: (context, item) => Object.values(item.id ?? {}),
            type: Enums.inputTypes.select2Array,
            size: Enums.inputSizes.xl,
        },
        role_id: {
            type: Enums.inputTypes.select2Ajax,
            options: {
                select2Ajax: {
                    path: 'user/role',
                    field: 'name.:locale',
                },
            },
        },
    },

    sortings: ['id', 'username'],

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
        role_id: {
            value: 'role.name.:locale',
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
        Информация: {
            username: {
                type: Enums.inputTypes.text,
            },
            email: {
                type: Enums.inputTypes.text,
            },
            role_id: {
                type: Enums.inputTypes.select2Ajax,
                options: {
                    initValue: 'role.name.:locale',
                    select2Ajax: {
                        path: 'user/role',
                        field: 'name.:locale',
                        hasPrompt: true,
                    },
                },
                attributes: (context, item) => {
                    return {
                        disabled: context.$route.params.id === '1',
                    };
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
                    file: {
                        previewPath: 'w_500',
                        downloadPath: 'original',
                        deleteUrl: 'user/user/:id/delete-file/image',
                    },
                },
                size: Enums.inputSizes.xl,
            },
            new_password: {
                type: Enums.inputTypes.text,
                attributes: {
                    type: 'password',
                },
            },
            new_password_confirmation: {
                type: Enums.inputTypes.text,
                attributes: {
                    type: 'password',
                },
            },
        },
    },
});
