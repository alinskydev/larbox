import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    form: {
        0: {
            username: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
                attributes: {
                    autofocus: true,
                },
                value: (context, item) => import.meta.env.VITE_CREDENTIALS_USERNAME,
            },
            password: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
                attributes: {
                    type: 'password',
                },
                value: (context, item) => import.meta.env.VITE_CREDENTIALS_PASSWORD,
            },
        },
    },
});
