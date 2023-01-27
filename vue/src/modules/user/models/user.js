import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    hasSoftDelete: true,

    config: {
        index: {
            image: {
                label: null,
                value: 'profile.image.widen_100.webp',
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
                label: App.t('Общий поиск'),
                hint: App.t('Поиск по полям: :fields', {
                    fields: ['username', 'email', 'profile.full_name', 'profile.phone']
                        .map((value) => App.t('fields->' + value))
                        .join(' | '),
                }),
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
            },
            id: {
                type: Enums.inputTypes.select2,
                options: {
                    isMultiple: true,
                },
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
            'Информация': {
                image: {
                    value: 'profile.image.widen_500.webp',
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
        },

        form: {
            'Информация': {
                username: {
                    type: Enums.inputTypes.text,
                },
                email: {
                    type: Enums.inputTypes.text,
                },
                role_id: {
                    type: Enums.inputTypes.select2Ajax,
                    options: {
                        select2Ajax: {
                            path: 'user/role',
                            field: 'name.:locale',
                            initValue: 'role.name.:locale',
                            hasPrompt: true,
                        },
                    },
                    attributes: (record) => {
                        return {
                            disabled: record.id === 1,
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
                            previewPath: 'widen_500.webp',
                            downloadPath: 'original.raw',
                            showDelete: true,
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
    },
});
