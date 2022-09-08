import { Model } from '@/core/base/model';
import * as Enums from '@/core/base/enums';

export default new Model({
    form: {
        username: {
            type: Enums.inputTypes.text,
            size: Enums.inputSizes.xl,
            attributes: {
                autofocus: true,
            },
        },
        password: {
            type: Enums.inputTypes.text,
            size: Enums.inputSizes.xl,
            attributes: {
                type: 'password',
            },
        },
    },
});
