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
            'profile.full_name': {
                type: crudEnums.inputTypes.text,
            },
            'profile.phone': {
                type: crudEnums.inputTypes.text,
            },
            'profile.image': {
                type: crudEnums.inputTypes.file,
                options: {
                    previewPath: 'original',
                    downloadPath: 'original',
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