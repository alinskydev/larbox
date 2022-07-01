import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    form: {
        'Информация': {
            username: {
                type: Enums.inputTypes.text,
            },
            email: {
                type: Enums.inputTypes.text,
            },
            full_name: {
                name: 'profile[full_name]',
                value: 'profile.full_name',
                type: Enums.inputTypes.text,
            },
            phone: {
                name: 'profile[phone]',
                value: 'profile.phone',
                type: Enums.inputTypes.text,
            },
            image: {
                name: 'profile[image]',
                value: 'profile.image',
                type: Enums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
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