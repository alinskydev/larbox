import { CrudModel } from '@/app/core/models/model';

import * as crudEnums from '@/app/enums/crud';
import * as inputEnums from '@/app/enums/input';

export default new CrudModel({
    form: {
        'Информация': {
            username: {
                type: inputEnums.types.text,
            },
            email: {
                type: inputEnums.types.text,
            },
            'profile.full_name': {
                type: inputEnums.types.text,
            },
            'profile.phone': {
                type: inputEnums.types.text,
            },
            'profile.image': {
                type: inputEnums.types.file,
                options: {
                    previewPath: 'original',
                    downloadPath: 'original',
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