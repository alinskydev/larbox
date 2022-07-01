import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    form: {
        username: {
            type: Enums.inputTypes.text,
            size: Enums.inputSizes.xl,
            attributes: {
                'autofocus': true,
            },
        },
        password: {
            type: Enums.inputTypes.text,
            size: Enums.inputSizes.xl,
            attributes: {
                'type': 'password',
            },
        },
    },
});