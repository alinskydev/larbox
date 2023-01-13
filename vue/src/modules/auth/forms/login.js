import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    config: {
        form: {
            0: {
                username: {
                    type: Enums.inputTypes.text,
                    size: Enums.inputSizes.xl,
                    attributes: {
                        autofocus: true,
                    },
                    value: (record) => import.meta.env.VITE_CREDENTIALS_USERNAME,
                },
                password: {
                    type: Enums.inputTypes.text,
                    size: Enums.inputSizes.xl,
                    attributes: {
                        type: 'password',
                    },
                    value: (record) => import.meta.env.VITE_CREDENTIALS_PASSWORD,
                },
            },
        },
    },
});
