import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    form: {
        'Информация': {
            username: {
                type: crudEnums.inputTypes.text,
            },
            email: {
                type: crudEnums.inputTypes.text,
            },
            full_name: {
                name: 'profile[full_name]',
                value: 'profile.full_name',
                type: crudEnums.inputTypes.text,
            },
            phone: {
                name: 'profile[phone]',
                value: 'profile.phone',
                type: crudEnums.inputTypes.text,
            },
            image: {
                name: 'profile[image]',
                value: 'profile.image',
                type: crudEnums.inputTypes.file,
                options: {
                    previewPath: 'w_500',
                    downloadPath: 'original',
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