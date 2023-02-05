import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    config: {
        form: {
            'Информация': {
                username: {
                    type: Enums.inputTypes.text,
                },
                email: {
                    type: Enums.inputTypes.text,
                },
                'profile.full_name': {
                    name: 'profile[full_name]',
                    type: Enums.inputTypes.text,
                },
                'profile.phone': {
                    name: 'profile[phone]',
                    type: Enums.inputTypes.phone,
                },
                'profile.image': {
                    name: 'profile[image]',
                    type: Enums.inputTypes.file,
                    options: {
                        file: {
                            previewPath: 'widen_500.webp',
                            downloadPath: 'original.raw',
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
