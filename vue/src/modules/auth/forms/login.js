import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    hasUpdatedAtConflictCheck: false,

    config: {
        form: {
            0: {
                username: {
                    type: Enums.inputTypes.text,
                    size: Enums.inputSizes.xl,
                    attributes: {
                        autofocus: true,
                    },
                    value: (record) => import.meta.env.VITE_USER_ADMIN_USERNAME,
                },
                password: {
                    type: Enums.inputTypes.text,
                    size: Enums.inputSizes.xl,
                    attributes: {
                        type: 'password',
                    },
                    value: (record) => import.meta.env.VITE_USER_ADMIN_PASSWORD,
                },
            },
        },
    },
});
